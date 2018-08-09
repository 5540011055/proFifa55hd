<?php

    /* Fake class */


    class System{}
    
    
    function isLogedin(){
        if( isset($_SESSION['system-login'])    &&  $_SESSION['system-login'] ){
            return true;
        }
        return false;
    }
    
    
    function loadAllMenu(){
        $db             = getDBO();
        $db->setQuery(" SELECT          * 
                        FROM            ".Database::$prefix."menu
                        ORDER BY        sort_order ASC, menuname ASC");
        $rs             = $db->loadAssocList();
        $len            = count($rs);
        for( $i=0;  $i<$len;  $i++ ){
            $menuName           = ucfirst($rs[$i]['menuname']);
            $controller         = trim($rs[$i]['controller']);
            $param              = $rs[$i]['parameter'];
            $controllPath       = "./application/controllers/{$controller}.php";
            $xmlPath            = "./application/controllers/{$controller}.xml";
            if(!file_exists($controllPath) ){
                echo '  <li>
                            <a  title="ไม่มี controller '.$controller.'" 
                                href="javascript:;" 
                                class="nav-top-item no-submenu" 
                                style="padding-right:15px; color:#C92500; font-weight:bold;">
                                   Not found &rsaquo;&rsaquo; '.$controller.'
                            </a>       
                        </li>';
            }
            // Found controller
            else{
                if(!file_exists($xmlPath)){
                    echo '  <li>
                                <a  title="ไม่มีไฟล์ '.$controller.'.xml" 
                                    href="javascript:;" 
                                    class="nav-top-item no-submenu" 
                                    style="padding-right:15px; color:#C92500; font-weight:bold;">
                                        Error &rsaquo;&rsaquo; '.$controller.'
                                </a>       
                            </li>';
                }
                // Found config
                else{
                    $xml                = simplexml_load_file($xmlPath);
                    $subMenu            = $xml->menu;     
                    /*
                     * $output             = '  
                        <li>
                            <a  href="'.base_url().$controller.'" 
                                class="nav-top-item '.(ucfirst(getParam(1,'dashboard'))==$menuName?'current':'').'" 
                                style="padding-right: 15px; ">
                                    '.  lang($menuName, $menuName).'
                            </a> ';
                     */
                    $menuId             = 'tab-'.$menuName;
                    /* Count not Approve  */
                    $total              = Array();
                    for( $apIndex=0;  $apIndex<count($subMenu);  $apIndex++ ){
                        $table              = @$subMenu[$apIndex]->table?$subMenu[$apIndex]->table:'';
                        $where              = @$subMenu[$apIndex]->where?' AND '.$subMenu[$apIndex]->where:'';                        
                        if( $table!='' ){
                            $db->setQuery("SELECT count(id) AS total FROM {$table} WHERE  checked='0' {$where} ");
                            $total_buf      = $db->loadAssocList();
                            $total[]        = '<span onClick="$(this).parent().parent().attr(\'href\', \''.base_url().strtolower($menuName).'/'.@$subMenu[$apIndex]->method.'\')" 
                                                  style="font-size:18px;" 
                                                  >'
                                                .$total_buf[0]['total'].
                                              '</span>';
                        }
                    }  
                    if(count($total)>0){
                        $total              = '&nbsp;
                                               <div style=" color:brown;
                                                            font-size:14px;
                                                            font-weight:bold;
                                                            float:right;
                                                            display:block;
                                                            width:auto;">
                                                ('. implode(', ', $total). ')
                                               </div>';
                    }else{
                        $total              = '';
                    }
                    /* END Count not Approve  */
                    
                    $output             = '  
                        <li>
                            <a  href="'.base_url().strtolower($menuName).'" 
                                class="nav-top-item '.(strtolower(getParam(1,'dashboard'))==strtolower($menuName)?'current':'').'" 
                                style="padding-right:15px;  "
                                id="'.$menuId.'">
                                    '.lang($menuName, $menuName).$total.'
                            </a> ';
                    $len_subMenu        = count($subMenu);
                    if($len_subMenu>0){
                        $submenuId      = "tab-{$menuName}-sub";
                        $output         .='<ul  style="display:'.(ucfirst(getParam(1,'dashboard'))==$menuName?'':'none').'; z-index:999;" 
                                                id="'.$submenuId.'" 
                                                >';
                        for( $subMenuIndex=0;  $subMenuIndex<$len_subMenu;  $subMenuIndex++ ){
                            $buf        = $subMenu[$subMenuIndex];
                            $attr       = $buf->attributes();
                            $className  = ( 
                                            strtolower($rs[$i]['menuname'])==strtolower(getParam(1))    &&  
                                            strtolower(getParam(2))==strtolower($attr->module)
                                            ) == $attr->module  ? 'current' : '' ;
                            if( !isset($_ENV['system-menu-sub']) ){
                                $_ENV['system-menu-sub']        = array();
                            }
                            $_ENV['system-menu-sub'][strtolower($rs[$i]['menuname'])][]         = $buf;
                        }
                        $output         .='</ul>';
                        unset($attr);
                        unset($buf);
                    }
                    $output             .='                                  
                        </li>';                    
                    unset($subMenu);
                    unset($xml);
                    echo $output;
                    unset($output);
                }
            }
        }
    }
    
    
    function loadAllTabs(){
//        $_ENV['system-menu-sub']
//        <li><a href="#" rel="#default" class="selected">Tab dffffffffffffdffffffffffffdffffffffffff1</a></li>
//                    <li><a href="external2.htm" rel="#iframe" 	>Tab 2</a></li>
//                    <li><a href="external3.htm" rel="#iframe" class="">Tab 3</a></li>
//                    <li><a href="external4.htm" rel="#iframe" class="">Tab 4</a></li>
        $output         = '';
        $controller     = getParam(1);
        $method         = getParam(2,'showList');
        if( isset($_ENV['system-menu-sub'][$controller]) ){
            $tab        = $_ENV['system-menu-sub'][$controller];        
            $len        = count($tab);
            $output         = '
                <ul id="maintabs" class="shadetabs" style="margin:0px; height:21px; min-height:21px;">';
            $focused    = false;
            $usr            = getLogedInUser();
            for( $i=0;  $i<$len;  $i++ ){          
                $class      = '';
                if(!$focused){
                    if (@$_ENV['alias-tab-number']==$i+1){
                        $_ENV['alias-tab-name']     = @$tab[$i]->attributes()->name;
                        $_ENV['alias-tab-module']   = @$tab[$i]->attributes()->module;
                        $class  = 'rel="#default" class="selected" style="font-size:14px;" ';
                        $focused= true;
                    }else if($len==1){
                        $class  = 'rel="#default" class="selected" style="font-size:14px;" ';
                        $focused= true;
                    }else if(strtolower($method)==  strtolower($tab[$i]->attributes()->module)){
                        $class  = 'rel="#default" class="selected" style="font-size:14px;" ';
                        $focused= true;
                    }
                    /*
                    else if(@$tab[$i]->attributes()->default=='true'){
                        $class  = 'rel="#default" class="selected" style="font-size:14px;" ';
                        $focused= true;
                    }
                     * 
                     */
                    else{
                        $class  = ' style="font-weight:normal;font-size:12px; border: 1px solid #ccc; border-bottom:none; color:gray" ' ;
                    }
                }else{
                    $class  = ' style="font-weight:normal;font-size:12px; border: 1px solid #ccc; border-bottom:none; color:gray" ' ;
                }
                $output     .=' <li>
                                    <a  href="'.base_url().$controller.'/'.$tab[$i]->attributes()->module.'" '.$class.' 
                                        style="padding: 3px 7px;">
                                        '.lang($tab[$i]->attributes()->name).'
                                    </a>
                                </li>';
            }// End For
            $output         .=        '
                </ul>
                
                <script type="text/javascript">
                    /*$(function(){
                        var countries=new ddajaxtabs("maintabs", "content-box")
                        countries.setpersist(true)
                        countries.setselectedClassTarget("link") //"link" or "linkparent"
                        countries.init()
                    });*/
                </script>
                ';
        }else{
            $output         = ' <ul id="maintabs" class="shadetabs" style="margin:0px; height:22px; min-height:22px;">';
            $output         .=' <li>
                                    <a  href="'.base_url().'" rel="#default" class="selected" style="font-size:14px;"  
                                        style="padding: 3px 7px;">
                                        ข้อมูลทั่วไปของระบบ
                                    </a>
                                </li>';
            $output         .=        '
                                </ul>';
        }
        return $output;
    }
    
    
    
    
    function loadBody_with_subMenu_tab($menuName){
        $search         = '';
        if( @$showMainSearch ){
            $search     = '
                <form name="frm-search" method="post">
                    <b>Search</b>:&nbsp;<input type="text" name="search" id="search" value="'.request('search').'" style="width:250px;" />&nbsp;
                    <button class="button button-blue" type="submit">'.lang('Search', 'Search').'</button>&nbsp;
                    <!--<button class="button" type="button" onClick="$(\'#search\').val(\'\');$(\'form[name=frm-search]\').submit();">'.lang('Clear', 'Clear').'</button>-->
                </form>
            ';
        }
        $output         = '
            <div class="content-box" style="width:100%; ">
                    <div class="content-box-header" >
                        <h3>'.lang($menuName).'</h3>
                        <span style="float:right;padding:4px;">
                            '.$search.'
                        </span>
                    </div>
                    <div class="content-box-content"  style="min-height:700px; height:auto; ">
                        <?=$body?>
                    </div>
                </div>
        ';
        
        return $output;
    }
    
    
    
    function countFromStatus($tableName, $status='0', $condition=''){
        if($condition!=''){
            $condition      = ' AND '. $condition;
        }
        $db                 = getDBO();
        $db->setQuery("SELECT COUNT(id) AS count FROM {$tableName} WHERE status='{$status}' {$condition} ");
        $rs                 = $db->loadAssocList();
        return $rs[0]['count'];
    }
    
    
    
    function getUserName(&$id){
        $db             = getDBO();
        $db->setQuery("SELECT fullname, status FROM users WHERE id='{$id}' ");
        $rs             = $db->loadAssocList();
        if($rs){
            $rs             = $rs[0];
            $id             = $rs['fullname'];
            if($rs['status']=='2'){
                $id         .=' (ลบแล้ว)';
            }
        }else{
            $id         = '-';
        }
            
    }
    
    
    
    function getStatus(&$status){
        switch($status){
            case 0      :
                $status             = '<span style="color:orange;font-weight:bold;">'.lang('Draft', 'Draft').'</span>';
                break;
            case 1      :
                $status             = '<span style="color:green;font-weight:bold;">'.lang('Public', 'Public').'</span>';
                break;
            case 2      :
                $status             = '<span style="color:red;font-weight:bold;">'.lang('Deleted', 'Deleted').'</span>';
                break;
            default     :
                $status             = '<span style="color:red;font-weight:bold;">'.lang('-', '-').'</span>';
                break;
        }
    }
    
    
    
    function lang($key, $default=null){
        $key                = strtolower($key);
        return @$_ENV['language'][$key] ? $_ENV['language'][$key] : ($default!=null?$default:$key);
    }
    
    
    
    function getGridTable(  $rs, 
                            $showField, 
                            $tool=Array(), 
                            $multiCheck=true,
                            $innerBtn=Array(
                                Array(
                                    'name'          => 'Create new topic',
                                    'method'        => 'add'
                                )
                            ))
    {
        $arr_key                    = array_keys($showField);
        $len_key                    = count($arr_key);
        $output                     = '';
        $hasTool                    = count($tool)>0 ? true : false;
        $currentKey                 = request('key', 'id');
        $currentOrderBy             = request('order_by', 'DESC');
        /*------------------------------------------------------------------
         *  Header Button */
        $addBtn                     = '';
        $len_btn                    = count($innerBtn);
        for( $i=0;  $i<$len_btn;  $i++ ){
            if( @$innerBtn[$i]['group'] ){
                $id                 = random_string();
                $menu               = Array();
                for( $g=0;  $g<count($innerBtn[$i]['group']);  $g++ ){
                    if($innerBtn[$i]['group'][$g]){
                        /*
                        $target             = ' $(\'form[name=Adminform]\').attr(\'action\',\''.base_url().getParam(1).'/'.$innerBtn[$i]['method'].'\');
                                            $(\'form[name=Adminform]\').attr(\'method\', \'post\');
                                            $(\'form[name=Adminform]\').submit()';
                         */
                        $menu[$g]       = json_encode($innerBtn[$i]['group'][$g]);      
                        $menuLen        = strlen($menu[$g]);
                        $menu[$g]       = substr($menu[$g], 0, $menuLen-1);
                        $menu[$g]       .=",action:function(){ 
                                                $('form[name=Adminform]').attr('action', '".base_url().getParam(1)."/".$innerBtn[$i]['group'][$g]['method']."'); 
                                                $('form[name=Adminform]').attr('method', 'post');
                                                $('form[name=Adminform]').submit();
                                                return false;
                                            }";
                        $menu[$g]       .="}";
                    }else{
                        $menu[$g]       = "null";
                    }
                }
                $menu               = implode(",", $menu);
                $title              = @$innerBtn[$i]['group']['title'] ? $innerBtn[$i]['group']['title'] : ' ';
                $addBtn             .='                    
                    <span id="'.$id.'" class="button" style="width:auto; height:28px; position:relative; ">
                       <span class="ui-icon ui-icon-carat-1-s" style="margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;"></span> 
                        '.$innerBtn[$i]['name'].'
                    </span>
                    <script>
                        $(function(){
                            $("#'.$id.'").contextPopup({
                                title: "'.$title.'",
                                targetId: "'.$id.'",
                                //items: '.json_encode($innerBtn[$i]['group']).'
                                items:['.$menu.']
                            });
                        });
                    </script>
                ';
            }
            else{
                $target                 = '';
                if(@$innerBtn[$i]['submit']){
                    $target             = ' $(\'form[name=Adminform]\').attr(\'action\',\''.base_url().getParam(1).'/'.$innerBtn[$i]['method'].'\');
                                            $(\'form[name=Adminform]\').attr(\'method\', \'post\');
                                            $(\'form[name=Adminform]\').submit()';
                }else{
                    $target             = 'window.location=\''.base_url().  getParam(1).'/'.$innerBtn[$i]['method'].'\';';
                }
                $id                     = random_string();
                $addBtn                 .='
                    <span class="" style="padding:5px; vertical-align:middle;">          
                        <button class="button" 
                                id="'.$id.'" 
                                type="button" 
                                style="width:auto; min-width:110px; height:30px;" 
                                onClick="'.$target.'">
                            '.lang($innerBtn[$i]['name'], $innerBtn[$i]['name']).'
                        </button>
                    </span>
                ';
            }
            
        }
        /* END Header Button 
         * ______________________________________________________________
         */
        $output                     .='
            <div    class="content-box-header" 
                    style="padding:3px;padding-top:5px;">
                '.$addBtn.'
                <span style="float:right; vertical-align:middle; ">
                    '.lang('order by', 'order by').': 
                    <select name="key" style="" title="เลือกวิธีการจัดเรียงข้อมูลตามที่กำหนด">';
        for( $i=0;  $i<$len_key;  $i++){
			$fieldName			= @$showField[@$arr_key[$i]]['fieldname']?$showField[@$arr_key[$i]]['fieldname']:$arr_key[$i];
            $selected               = $currentKey==$fieldName?' selected="selected" ':'';			
            $output                 .='
                        <option value="'.$fieldName.'" '.$selected.' >'.  lang($fieldName, $fieldName).'</option>
            ';
        }
        $output                     .=' 
                    </select>
                    &raquo;
                    <select name="order_by" style="" title="เลือกวิธีแสดงลำดับการแสดงผลของข้อมูลในแบบต่างๆ">
                        <option value="DESC" '.($currentOrderBy=="DESC"?'selected="selected"':'').' >'.  lang('DESC', 'DESC').'</option>
                        <option value="ASC" '.($currentOrderBy=="ASC"?'selected="selected"':'').'>'.  lang('ASC', 'ASC').'</option>
                    </select>
                    <input class="button" type="submit" value="'.lang('OK', 'OK').'" style="width:60px;height:24px;cursor:pointer;" />
                </span>
            </div>
            <br />';
        $output                     .='
            <div id="datagrid">
            <table border="0" cellpadding="0" cellspacing="0" class="admintable" width="99%">
                <tbody>
                    <tr>';       
        /* Table Header */
        if($multiCheck){
            $output         .='
                <td class="key" style="text-align:center" width="10" >
                    <input type="checkbox" onClick="multiSelected(this);" />
                </td>
            ';
        }
        if($hasTool){            
            $output     .='  
                        <td class="key" style="text-align:center;width:70px;min-width:70px;"  >
                            '.  lang('Tool', 'Tool').'
                        </td>';
        }
        for( $i=0;  $i<$len_key;  $i++){
            $align                      = @$showField[@$arr_key[$i]]['align']?@$showField[@$arr_key[$i]]['align']:'left';
            $width			= @$showField[@$arr_key[$i]]['width']?@$showField[@$arr_key[$i]]['width']:'';
			$fieldName	= @$showField[@$arr_key[$i]]['fieldname']?$showField[@$arr_key[$i]]['fieldname']:$arr_key[$i];
            if($width){
                $width  = ' width:'.$width.'; ';
            }
            $output     .='
                        <td class="key" align="center" style="'.$width.'" >
                            '.lang($fieldName, $fieldName).'
                        </td>
                        ';
        }
        $output         .='
                    </tr>
                ';
        $len            = count($rs);
        /* Table body */        
        for( $i=0;  $i<$len;  $i++){
            $output         .='  
                    <tr>';
            if($multiCheck){
                $output         .='
                    <td class="key" style="text-align:center; vertical-align:middle;" width="10" >
                        <input type="checkbox" class="chk-topic" name="id[]" value="'.@$rs[$i]['id'].'"  />
                    </td>
                ';
            }
            
            /* Generate admin tools */
            if($hasTool){
                $output     .='<td class="sub_key" style="text-align:center;width:70px;min-width:70px;vertical-align:middle;"  >';
                $len_tool   = count($tool);
                $tool_key   = array_keys($tool);
                for($toolIndex=0;  $toolIndex<$len_tool;  $toolIndex++){
                    $keyName= $tool_key[$toolIndex];
                    $url    = getPrepareText($tool[$keyName]['url'], $rs[$i]);
                    $confirm= @$tool[$keyName]['confirm'] ? $tool[$keyName]['confirm'] : false;
                    $image  = @$tool[$keyName]['image'] ? '<img src="'.base_url().$tool[$keyName]['image'].'" />' : false;  
                    if(!$image){
                        $image      = lang($keyName, $keyName);                        
                    }
                    $toolId     = 'tool-'.@$rs[$i]['id'].$keyName;
                    $eventOnClick   = "window.location='".$url."';";
                    if($confirm){
                        $eventOnClick   = "if(confirm('".lang("Do you want to delete.")."')){{$eventOnClick}};";
                    }
                    $image  = '
                        <a href="javascript:;" onClick="'.$eventOnClick.'" id="'.$toolId.'" title="'.lang($keyName).'" style="'. @$tool[$keyName]['style'].'" >'.$image.'</a>';    
                    $output .="{$image}";
                    $output .="&nbsp;";
                }
                $output     .='</td>';
            }
            /* Generate each body column */
            for( $key=0;  $key<$len_key;  $key++){
                $fieldName  = @$arr_key[$key];
                $align      = @$showField[$fieldName]['align']?@$showField[$fieldName]['align']:'left';
                $width      = @$showField[$fieldName]['width']?@$showField[$fieldName]['width']:'';
                $style      = @$showField[$fieldName]['style']?@$showField[$fieldName]['style']:'';
                $eval       = @$showField[$fieldName]['eval']?@$showField[$fieldName]['eval']:'';
                $value      = strip_tags(@$rs[$i][$arr_key[$key]]);
                /*if( strlen($value)>$width ){
                    $value  = utf8_substr($value, 0, $width);
                }*/
                if($eval!=""){
                    eval("$eval(\$value);");
                }
                if($width){
                    $width  = ' width="'.$width.'" ';
                }else{
                    if(strlen($value)<120){
                        $value  = utf8_substr($value, 0, 120);
                    }                    
                }
                if(request('search')!='' ){
                    $value  = str_replace(request('search'), '<span style="color:red;font-weight:bold">'.request('search').'</span>', $value);
                }
                $output     .='
                            <td class="sub_key" align="'.$align.'" '.$width.' style="padding:5px;">
                                <span style="'.$style.'">'.$value.'</span>
                            </td>
                            ';
            }
            $output     .='
                    </tr>';
            
        }
        $output         .='
                </tbody>
            </table>
        </div>
        <br />
        ';
        
        return $output;
    }
    
        
    /*
     * function getPaginate($totalRow, $pageURL, $limitPerPage=20, $currentPage=1, $displaypage=10 ){     
        try{
            $pageURL            = explode('&page', $pageURL);
            $pageURL            = $pageURL[0];
            $pageURL            = explode('page', $pageURL);
            $pageURL            = $pageURL[0];
            if($pageURL!=""){
                $pageURL        = $pageURL.'&page=';
            }
            $output                             = '';
            if( $totalRow>1 ){
                $totalPage          = ceil(($totalRow/$limitPerPage));
                $currentPage--;
                if($currentPage<0){
                    $currentPage    = 1;
                }
                $pageURL            = explode('&page', $pageURL);
                $pageURL            = $pageURL[0];
                $pageURL            = explode('page', $pageURL);
                $pageURL            = $pageURL[0];
                if($pageURL!=""){
                    $pageURL        = $pageURL.'&page=';
                }
                $id                 = md5('paginate'.time());
                $childForPlugin     = '';
                for( $i=0;  $i<$totalRow;  $i++ ){
                    $childForPlugin.='<li></li>';
                }
                $output                         .='
                    <div id="'.$id.'" class="container" style="min-width:650px;width:650px;">
                        <div style="float:right;padding-left:5px;padding-top:4px;font-weight:bold;">
                            &raquo;'.lang('Page', 'Page').' <input class="paginate-current-page" type="text" value="'.($currentPage+1).'" onChange="if(isNumber(this.value)){$(\'#Adminform #page\').val(this.value);$(\'#Adminform\').submit();}"  />/'.$totalPage.'
                            <br />
                            &raquo;<span style="">ข้อมูลทั้งหมด '.  number_format($totalRow).' รายการ</span>
                        </div>
                        <div class="page_navigation" style="float:right;"></div>
                        <ul class="content" style="display:none;">
                            '.$childForPlugin.'
                        </ul>
                    </div>                
                    <script>
                        var paginate = null;
                        $(function(){
                            $("#'.$id.'").pajinate({
                                num_page_links_to_display   : '.$displaypage.',
                                items_per_page              : '.$limitPerPage.',
                                start_page                  : 15,
                                nav_label_prev              : "&laquo;",
                                nav_label_next              : "&raquo;",
                                nav_label_first             : "'.lang('First page', 'First page').'",
                                nav_label_last              : "'.lang('Last page', 'Last page').'"
                            });
                            paginate                    = $(".page_navigation a.page_link");     
                            for( i=0;  i<paginate.length;  i++ ){
                                var id                  = "paginat"+i;
                                $(paginate[i]).attr("id", id);
                                $(paginate[i]).attr("title", "Go to page "+$(paginate[i]).text());
                                $(paginate[i]).attr("onClick", "gotoPage(\'"+id+"\');");
                            }
                            $(".page_navigation a.first_link").attr("title", "First page");
                            $(".page_navigation a.first_link").click(function(){
                                $("#Adminform #page").val(1);
                                $("#Adminform").submit();
                            });
                            $(".page_navigation a.last_link").attr("title", "Last page");
                            $(".page_navigation a.last_link").click(function(){
                                $("#Adminform #page").val('.$totalPage.');
                                $("#Adminform").submit();
                            });
                            $(".page_navigation a.previous_link").attr("title", "Previous scroll");
                            $(".page_navigation a.next_link").attr("title", "Next scroll");
                        });
                        function gotoPage(pageId){
                            var currentPage         = $("#"+pageId).text();
                            $("#Adminform #page").val(currentPage);
                            $("#Adminform").submit();
                        }
                    </script>
                ';
            }
            return $output;
        }
        catch (Exception $e){
            return "";
        }
        
    }
     */
    
    function getPaginate($totalRow, $pageURL, $limitPerPage=20, $currentPage=1, $displaypage=10 ){     
        try{
            $totalPage          = ceil($totalRow/$limitPerPage);
            if($totalPage<2){
                return '';
            }
            $pageURL            = str_replace('index.php/', '', current_url()).'/';
            if(!strstr($pageURL, '?') ){
                $pageURL        = $pageURL.'?';
                $queryString    = getQueryString();
                $queryString    = explode('&', $queryString);
                if($queryString){
                    $buf        = Array();
                    foreach($queryString AS $v){
                        if($v && !strstr($v, 'page')){
                            $buf[]  = $v;
                        }
                    }
                    $queryString= implode('&', $buf);
                }
                $pageURL        = $pageURL.$queryString;
            }
            $tool               = '
                <div class="pagination" style="border:none;">
                    <a href="#" class="first" data-action="first" style="">&laquo;</a>
                    <a href="#" class="previous" data-action="previous">&lsaquo;</a>
                    <input type="text" readonly="readonly" data-max-page="'.$totalPage.'" style="width:180px;background:none;" />
                    <a href="#" class="next" data-action="next">&rsaquo;</a>
                    <a href="#" class="last" data-action="last">&raquo;</a>
                </div>
            ';
            if(isShowTooltip() ){
                $tool           = '
                    <div class="pagination" style="border:none;">
                        <a href="#" class="first" data-action="first" style="" title="'.lang('Go to first page').'">&laquo;</a>
                        <a href="#" class="previous" data-action="previous" title="'.lang('Go to previous page').'">&lsaquo;</a>
                        <span>
                            <input type="text" readonly="readonly" data-max-page="'.$totalPage.'" style="width:180px;background:none;" title="'.lang('Click here for set page number').'" />
                        </span>
                        <a href="#" class="next" data-action="next" title="'.lang('Go to next page').'">&rsaquo;</a>
                        <a href="#" class="last" data-action="last" title="'.lang('Go to last page').'">&raquo;</a>
                    </div>
                ';
            }
            $output             = '
                '.$tool.'
                <div style="float:right;padding-righ:5px;padding-top:0px;font-weight:bold;display:block;">
                    &raquo;<span style="color:gray">ข้อมูลทั้งหมด <u>'.  number_format($totalRow).'</u> รายการ</span>
                </div>
                <script>
                    $(function(){
                        $(".pagination").jqPagination({
                            current_page        : '.$currentPage.',
                            max_page            : '.$totalPage.',
                            page_string         : "หน้า {current_page} จากทั้งหมด {max_page}",
                            paged: function(page) {
                                $("#Adminform #page").val(page);
                                $("#Adminform").submit();
                            }
                        });
                    });
                </script>
            ';
            
            return $output;
        }
        catch (Exception $e){
            return "";
        }
        
    }
    
    
    
    
    
    
        
    
    function getUserData($userId){
        $db                         = getDBO();
        $db->setQuery("SELECT * FROM users WHERE id='{$userId}' AND status='1' ;");
        $rs                         = $db->loadAssocList();        
        return @$rs[0];
    }
    
    
    
    
    function getLogedInUser(){
        return getUserData($_SESSION['system-login-id']);
    }
    
    
    
    
    function getLogedInUserId(){
        return @$_SESSION['system-login-id'];
    }
    
    
    
    
    function checkSID(){
        $db                 = getDBO();
        $sid                = request('sid');
        $db->setQuery(" SELECT id FROM users WHERE sid='{$sid}' ");
        $rs                 = $db->loadAssocList();        
        if( count($rs)>0 ){
            return true;
        }
        return false;
    }
    
    
    
    
    function getConfig($key){
        $db                 = getDBO();
        //$db->setQuery("SELECT {$key} FROM _".Site::$priv."_configuration WHERE local_id='".Site::$local_id."' ");
        $db->setQuery("SELECT {$key} FROM cpanel_configuration WHERE local_id='".Site::$local_id."' ");
        $rs                 = $db->loadAssocList();
        return @$rs[0][$key];
    }
    
    
    
    
    function getGeneralConfig($key){
        $db                 = getDBO();
        //$db->setQuery("SELECT {$key} FROM _".Site::$priv."_configuration_general WHERE local_id='".Site::$local_id."' ");
        $db->setQuery("SELECT {$key} FROM cpanel_configuration_general WHERE local_id='".Site::$local_id."' ");
        $rs                 = $db->loadAssocList();
        return @$rs[0][$key];
    }
	
    /**
     * 
     * @param Boolean $show Set for show text tooltip
     */
    function setShowTooltip($show=true){
        $_ENV['SYSTEM-TOOLTIP-SHOW']        = $show;
    }
    /**
     * 
     * @return Boolean return showable text tooltip
     */
    function isShowTooltip(){
        return @$_ENV['SYSTEM-TOOLTIP-SHOW']?$_ENV['SYSTEM-TOOLTIP-SHOW']:false;
    }
    
    
	function getAlertFooter($forWB,$forComplain){

		$db = getDBO();
						
						if(($forWB == '1') && ($forComplain == '1')){
						 
							$db->setQuery(" SELECT              count(i.id) AS num
											FROM                network_webboard_topic      AS i
											WHERE               i.status='1'
											AND                 i.checked ='0'
											AND                 i.status_spam ='0'
											AND					i.local_id='".Site::$local_id." '                                    
							");
		
						$rsNum = $db->loadAssocList(); 
						
	                     
						 //  check answer webboard
						 $db->setQuery(" SELECT                 count(j.id) AS numAns
											FROM                network_webboard_topic      AS i,
																network_webboard_answer     AS j
											WHERE               j.status='1'
											AND                 j.checked ='0'
											AND                 j.status_spam ='0'
											AND					i.local_id='".Site::$local_id."' 
											AND                 i.status='1'
											AND                 i.id = j.tid                                   
							");
		
						$rsAns = $db->loadAssocList();
						
						$countWebboard = intval($rsNum[0]['num']) +  intval($rsAns[0]['numAns']);
						
						
						
						
						
						// alert for Contactus Complain

						 $db->setQuery(" SELECT                 count(id) AS numContact
											FROM                contact_information
											WHERE               status = '0'                
											AND                 local_id = '".Site::$local_id."'                                 
							");
		
						$rsAnsCon = $db->loadAssocList();
						
						
						
						$alert = $countWebboard +  intval(@$rsAnsCon[0]['numContact']);
							
							
							
						}
						else if(($forWB == '1') && ($forComplain == '0')){
							 //  check topic webboard
						$db->setQuery(" SELECT              count(i.id) AS num
											FROM                network_webboard_topic      AS i
											WHERE               i.status='1'
											AND                 i.checked ='0'
											AND                 i.status_spam ='0'
											AND					i.local_id='".Site::$local_id." '                                    
							");
		
						$rsNum = $db->loadAssocList(); 
						
	                     
						 //  check answer webboard
						 $db->setQuery(" SELECT                 count(j.id) AS numAns
											FROM                network_webboard_topic      AS i,
																network_webboard_answer     AS j
											WHERE               j.status='1'
											AND                 j.checked ='0'
											AND                 j.status_spam ='0'
											AND					i.local_id='".Site::$local_id."' 
											AND                 i.status='1'
											AND                 i.id = j.tid                                   
							");
		
						$rsAns = $db->loadAssocList();
						
						$countWebboard = intval($rsNum[0]['num']) +  intval($rsAns[0]['numAns']);
						$alert = $countWebboard;
						}
						else if(($forWB == '0') && ($forComplain == '1')){
						  $db->setQuery(" SELECT              count(i.id) AS numcom
											FROM                complain_topic      AS i
											WHERE               i.status='1'
											AND                 i.checked ='0'
											AND                 i.status_spam ='0'
											AND					i.local_id='".Site::$local_id." '                                    
							");
		
						$rsNumCom = $db->loadAssocList(); 
						
	                     
						 //  check answer webboard
						 $db->setQuery(" SELECT                 count(j.id) AS numAnscom
											FROM                complain_topic      AS i,
																complain_answer     AS j
											WHERE               j.status='1'
											AND                 j.checked ='0'
											AND                 j.status_spam ='0'
											AND					i.local_id='".Site::$local_id."' 
											AND                 i.status='1'
											AND                 i.id = j.tid                                   
							");
		
						$rsAnsCom = $db->loadAssocList();
						
						$countComplain = intval($rsNumCom[0]['numcom']) +  intval($rsAnsCom[0]['numAnscom']);
						$alert = $countComplain;
						}else{
							$alert = 'error';
						}
						
						return @$alert;
    }
    
    
    
    
    function pagination($limit,$adjacents,$rows,$page,$search="",$cid=""){
    
    
    
    	$pagination='';
    	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
    	$prev = $page - 1;							//previous page is page - 1
    	$next = $page + 1;							//next page is page + 1
    	$prev_='';
    	$first='';
    	$lastpage = ceil($rows/$limit);
    	$next_='';
    	$last='';
    	
    	$search = ($search) ? "&search=$search" : "" ;
    	$cid    = ($cid) ? "&cid=$cid" : "" ;
    
    	$param_url = getParam('1');
    
    	if($lastpage > 1)
    	{
    
    
    		//previous button
    		if ($page > 1){
    			$prev_.= "<li><a href='".$param_url."/?page=".$prev.@$search.@$cid."' >«</a></li>";
    
    		}
    		else{
    			//$pagination.= "<span class=\"disabled\">previous</span>";
    				
    		}
    
    		//pages
    		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
    		{
    				
    				
    			$first='';
    				
    				
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    			if ($counter == $page)
    				$pagination.= "<li class='active'>".$counter."</li>";
    						else
    							$pagination.= "<li><a href='".$param_url."/?page=".$counter.@$search.@$cid."' >".$counter."</a></li>";
    			}
    				
    			$last='';
    			}
    			elseif($lastpage > (3 + ($adjacents * 2)))	//enough pages to hide some
    			{
    			//close to beginning; only hide later pages
    				$first='';
    					
    					
    				if($page < 1 + ($adjacents * 2))
    				{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    				if ($counter == $page)
    					$pagination.= "<li class='active'>".$counter."</li>";
 					else
    				$pagination.= "<li><a href='".$param_url."/?page=".$counter.@$search.@$cid."' >".$counter."</a></li>";
    					
    				}
    				$last.= "<li><a href='".$param_url."/?page=".$lastpage.@$search.@$cid."' >Last</a></li>";
 			}
    
 			//in middle; hide some front and some back
    				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    				{
    
    				$first.= "<li><a href='".$param_url."/?page=1&search=".@$search.@$cid."' >First</a></li>";
    
    
 				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
     				{
     				if ($counter == $page)
    
     					$pagination.= "<li class='active'>".$counter."</li>";
 			
     							else
    
 						$pagination.= "<li><a href='".$param_url."/?page=".$counter.@$search.@$cid."' >".$counter."</a></li>";
 				}
    
     								$last.= "<li><a href='".$param_url."/?page=".$lastpage.@$search.@$cid."' >Last</a></li>";
    
 			}
 			//close to end; only hide early pages
     					else
     					{
    
     					$first.= "<li><a  href='".$param_url."/?page=1&search=".@$search."&cid=".@$cid."' >First</a></li>";
    
    
     					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
     					{
     					if ($counter == $page)
    
     						$pagination.= "<li class='active'>".$counter."</li>";
 			
 					else
    
     					$pagination.= "<li><a href='".$param_url."/?page=".$counter.@$search.@$cid."' >".$counter."</a></li>";
    
 				}
 				$last='';
     					}
    
     					}
     					if ($page < $counter - 1)
    
     						$next_.= "<li><a href='".$param_url."/?page=".$next.@$search.@$cid."' >»</a></li>";
    
    
 		else{
 			//$pagination.= "<span class=\"disabled\">next</span>";
     						}
     						$pagination = '<br><ul class="paginate pag2 clearfix"><li class="single"> '.@$rows.' Items | Page  '.@$page.' /'.@$lastpage.'</li>'.$first.$prev_.$pagination.$next_.$last.'</ul>';
    
    		}
    
    		return $pagination;
    		}
    		
    		
    		
    		
    		
    		function nextPage($limit,$adjacents,$rows,$page,$search="",$cid=""){
    		
    		
    		
    			$pagination='';
    			if ($page == 0) $page = 1;					//if no page var is given, default to 1.
    			$prev = $page - 1;							//previous page is page - 1
    			$next = $page + 1;							//next page is page + 1
    			$prev_='';
    			$first='';
    			$lastpage = ceil($rows/$limit);
    			$next_='';
    			$last='';
    			 
    			$search = ($search) ? "&search=$search" : "" ;
    			$cid    = ($cid) ? "&cid=$cid" : "" ;
    		
    			$param_url = getParam('1');
    		
    			if($lastpage > 1)
    			{
    		
    		
    				//previous button
    				if ($page > 1){
    					$prev_.= "<li><a href='".$param_url."/?page=".$prev.@$search.@$cid."' >«</a></li>";
    		
    				}
    				else{
    					//$pagination.= "<span class=\"disabled\">previous</span>";
    		
    				}
    		
    				//pages
    				if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
    				{
    		
    		
    					$first='';
    		
    		
    					for ($counter = 1; $counter <= $lastpage; $counter++)
    					{
    						if ($counter == $page)
    							$pagination.= "<li class='active'>".$counter."</li>";
    							else
    								$pagination.= "<li><a href='".$param_url."/?page=".$counter.@$search.@$cid."' >".$counter."</a></li>";
    					}
    		
    					$last='';
    				}
    				elseif($lastpage > (3 + ($adjacents * 2)))	//enough pages to hide some
    				{
    					//close to beginning; only hide later pages
    					$first='';
    						
    						
    					if($page < 1 + ($adjacents * 2))
    					{
    						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    						{
    							if ($counter == $page)
    								$pagination.= "<li class='active'>".$counter."</li>";
    								else
    									$pagination.= "<li><a href='".$param_url."/?page=".$counter.@$search.@$cid."' >".$counter."</a></li>";
    										
    						}
    						$last.= "<li><a href='".$param_url."/?page=".$lastpage.@$search.@$cid."' >Last</a></li>";
    					}
    		
    					//in middle; hide some front and some back
    					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    					{
    		
    						$first.= "<li><a href='".$param_url."/?page=1&search=".@$search.@$cid."' >First</a></li>";
    		
    		
    						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    						{
    							if ($counter == $page)
    		
    								$pagination.= "<li class='active'>".$counter."</li>";
    		
    								else
    		
    									$pagination.= "<li><a href='".$param_url."/?page=".$counter.@$search.@$cid."' >".$counter."</a></li>";
    						}
    		
    						$last.= "<li><a href='".$param_url."/?page=".$lastpage.@$search.@$cid."' >Last</a></li>";
    		
    					}
    					//close to end; only hide early pages
    					else
    					{
    		
    						$first.= "<li><a  href='".$param_url."/?page=1&search=".@$search."&cid=".@$cid."' >First</a></li>";
    		
    		
    						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    						{
    							if ($counter == $page)
    		
    								$pagination.= "<li class='active'>".$counter."</li>";
    		
    								else
    		
    									$pagination.= "<li><a href='".$param_url."/?page=".$counter.@$search.@$cid."' >".$counter."</a></li>";
    		
    						}
    						$last='';
    					}
    		
    				}
    				if ($page < $counter - 1){
    		
    					$next_.= "<button class='paginate'><a href='".$param_url."/?page=".$next.@$search.@$cid."' >อ่านข้อมูลทั้งหมด </a></button>";
    		
    		
    				}else{
    						//$pagination.= "<span class=\"disabled\">next</span>";
    					}
    					$pagination = $next_;
    		
    			}
    		
    			return $pagination;
    		}
    
    
    
    
?>

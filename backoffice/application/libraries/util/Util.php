<?php
    class Util{  
    	
    	public function getWriteFileLang(){
    		$filename_th = "../application/language/english/th_lang.php";
    		$filename_en = "../application/language/english/en_lang.php";
    	
    		if (!file_exists($filename_th)){
    	
    			$thfile = fopen($filename_th, "w") or die("Unable to open file!");
    	
    			$db_file = getDBO();
    			$db_file->setQuery("SELECT keyword,th_lang FROM cpanel_languages");
    			$rs_file = $db_file->loadAssocList();
    			$txt_th = "<?php\n\n ";
    	
    			for($i=0;$i<count($rs_file);$i++){
    				$txt_th.= "\$lang['".$rs_file[$i]['keyword']."'] = '".$rs_file[$i]['th_lang']."'; \n";
    			}
    	
    			$txt_th.= " \n?>";
    	
    			fwrite($thfile,$txt_th);
    			fclose($thfile);
    		}
    	
    	
    		if (!file_exists($filename_en)){
    	
    			$enfile = fopen($filename_en, "w") or die("Unable to open file!");
    	
    			$db_file = getDBO();
    			$db_file->setQuery("SELECT keyword,en_lang FROM cpanel_languages");
    			$rs_file = $db_file->loadAssocList();
    			$txt_en = "<?php\n";
    	
    			for($i=0;$i<count($rs_file);$i++){
    				$txt_en.= "\$lang['".$rs_file[$i]['keyword']."'] = '".$rs_file[$i]['en_lang']."'; \n";
    			}
    	
    			$txt_en.= " \n?>";
    	
    			fwrite($enfile,$txt_en);
    			fclose($enfile);
    	
    		}
    	}
    	
    	public function getRemoveFileLang(){
    		$filename_th = "../application/language/english/th_lang.php";
    		$filename_en = "../application/language/english/en_lang.php";
    		
    		unlink($filename_th);
    		unlink($filename_en);
    		
    	}
    	
    	
    	
        public function compareDate($date,$age){
            $age = intval($age);
            $age = intval($age*86400);
            $datenow = strtotime("now");
            $datepost = strtotime($date);
            $compair = intval($datenow - $datepost);
            $result = ($compair < $age || $datenow<$datepost )?true:false;
            return $result;
        }
        public function getNewImage($create_date, $comparedDay=15){
            if($this->compareDate($create_date, $comparedDay)){
                return '<img src="'.Site::$fullURL.'images/new.gif" />';
            }
        }
        
        
        public function eventDisplayDate($startDate,$endDate)
	{
		$m = array("","มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		$startDateArr=split('-',$startDate,3);
		$endDateArr=split('-',$endDate,3);
		$startmonth = $m[intval($startDateArr[1])];
		$endmonth = $m[intval($endDateArr[1])];
		$startyear = intval($startDateArr[0]+543);
		$endyear = intval($endDateArr[0]+543);
		$startyear = substr($startyear,2,2);
		$endyear = substr($endyear,2,2);
		$startDateArr[2] = intval($startDateArr[2]);
		$endDateArr[2] = intval($endDateArr[2]);
		if($startDateArr[0]<>$endDateArr[0]){
			return "{$startDateArr[2]} {$startmonth} {$startyear} - {$endDateArr[2]} {$endmonth} {$endyear}";
		}
		if($startDateArr[1]<>$endDateArr[1]){
			return "{$startDateArr[2]} {$startmonth} - {$endDateArr[2]} {$endmonth} {$endyear}";
		}
		if($startDateArr[2]<>$endDateArr[2]){
			return "{$startDateArr[2]} - {$endDateArr[2]} {$endmonth} {$endyear}";
		}
		if($startDateArr[2]==$endDateArr[2]){
			return "{$startDateArr[2]} {$startmonth} {$startyear}";
		}
		return "Invalid date input";
	}
	
	
	public function eventDisplayDateShort($startDate,$endDate)
	{
		$m = array("","ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
		$startDateArr=split('-',$startDate,3);
		$endDateArr=split('-',$endDate,3);
		$startmonth = $m[intval($startDateArr[1])];
		$endmonth = $m[intval($endDateArr[1])];
		$startyear = intval($startDateArr[0]+543);
		$endyear = intval($endDateArr[0]+543);
		$startyear = substr($startyear,2,2);
		$endyear = substr($endyear,2,2);
		$startDateArr[2] = intval($startDateArr[2]);
		$endDateArr[2] = intval($endDateArr[2]);
		if($startDateArr[0]<>$endDateArr[0]){
			return "{$startDateArr[2]} {$startmonth} {$startyear} - {$endDateArr[2]} {$endmonth} {$endyear}";
		}
		if($startDateArr[1]<>$endDateArr[1]){
		return "{$startDateArr[2]} {$startmonth} - {$endDateArr[2]} {$endmonth} {$endyear}";
		}
		if($startDateArr[2]<>$endDateArr[2]){
		return "{$startDateArr[2]} - {$endDateArr[2]} {$endmonth} {$endyear}";
		}
		if($startDateArr[2]==$endDateArr[2]){
		return "{$startDateArr[2]} {$startmonth} {$startyear}";
		}
		return "Invalid date input";
	}
	
	
	public function eventDisplayDate_eng($startDate,$endDate)
	{
		$m = array("","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		$startDateArr=split('-',$startDate,3);
		$endDateArr=split('-',$endDate,3);
		$startmonth = $m[intval($startDateArr[1])];
		$endmonth = $m[intval($endDateArr[1])];
		$startyear = intval($startDateArr[0]);
		$endyear = intval($endDateArr[0]);
		$startyear = substr($startyear,2,2);
		$endyear = substr($endyear,2,2);
		$startDateArr[2] = intval($startDateArr[2]);
		$endDateArr[2] = intval($endDateArr[2]);
		
		if($startDateArr[0]<>$endDateArr[0]){
			return "{$startmonth} {$startDateArr[2]}, {$startyear} - {$endmonth} {$endDateArr[2]}, {$endyear}";
		}
		if($startDateArr[1]<>$endDateArr[1]){
			return "{$startmonth} {$startDateArr[2]} - {$endmonth} {$endDateArr[2]}, {$endyear}";
		}
		if($startDateArr[2]<>$endDateArr[2]){
			return "{$endmonth} {$startDateArr[2]} - {$endDateArr[2]}, {$endyear}";
		}
		if($startDateArr[2]==$endDateArr[2]){
			return "{$startmonth} {$startDateArr[2]}, {$startyear}";
		}
		return "Invalid date input";
	}
        
        
    }
    
    
    /**
     * @return Util 
     */
    function getUtilObject(){
        if(!isset($_ENV['system-util'])){
            $obj                    = new Util();
            $_ENV['system-util']    = &$obj;
        }
        return $_ENV['system-util'];
    }
    
    
    /**
     *
     * @param DATETIME $date
     * @param Int $age
     * @return String 
     */
    function compareDate($date,$age){
        $obj                    = getUtilObject();
        return $obj->compareDate($date,$age);
    }
    
    
    /**
     *
     * @param DATETIME $create_date
     * @param int $comparedDay
     * @return String HTML
     * @example <img src="news.gif" /> 
     */
    function getNewImage($create_date, $comparedDay=15){
        $obj                    = getUtilObject();
        return $obj->getNewImage($create_date, $comparedDay);
    }
    
    
    
    function eventDisplayDate($startDate,$endDate){
        $obj                    = getUtilObject();
        return $obj->eventDisplayDate($startDate,$endDate);
    }
    
    function eventDisplayDateShort($startDate,$endDate){
    	$obj                    = getUtilObject();
    	return $obj->eventDisplayDateShort($startDate,$endDate);
    }
    
    
    
    function eventDisplayDate_eng($startDate,$endDate){
        $obj                    = getUtilObject();
        return $obj->eventDisplayDate_eng($startDate,$endDate);
    }
    
    
    
    function utf8_substr($str,$start_p,$len_p) { 
        if(strlen($str) < $len_p){
                return $str;	
        }
        preg_match_all("/./u", $str, $ar); 
        if(func_num_args() >= 3) { 
            $end = func_get_arg(2); 
            return join("",array_slice($ar[0],$start_p,$len_p)) . "..."; 
        } else { 
            return join("",array_slice($ar[0],$start_p)) . "..."; 
        } 
    } 
    
    
    
    function substr_utf8( $str, $start_p , $len_p){
        $ret =  preg_replace(   '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start_p.'}'.
                                '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len_p.'}).*#s',
                                '$1' , 
                                $str );
        if(strlen($str) > $len_p){
                $ret .= "...";
        }
        return $ret;
    };
    
    
    
    function getQueryString(){
        return $_SERVER['QUERY_STRING'];
    }
    
    
    
    /**
     *
     * @param String $haystack
     * @param Array $replacementArray 
     * @return String
     */
    function getPrepareText( $haystack, $replacementArray=Array() ){
        $len                = count($replacementArray);
        $key                = array_keys($replacementArray);
        for( $i=0;  $i<$len;  $i++ ){
            $haystack       = str_replace("@{$key[$i]}", $replacementArray[$key[$i]], $haystack);
        }
        return $haystack;
    }
    
    
    function is_iOS(){
        $userAgent                          = strtolower($_SERVER['HTTP_USER_AGENT']);
        if(strstr($userAgent, 'iphone') || strstr($userAgent, 'ipad') || strstr($userAgent, 'ipod') ){
            return true;
        }
        return false;
    }

	
    function showCategoryName(&$id){
        $id					= explode("-", $id);
        $tableName				= $id[1];
        $id                                 = $id[0];
        $db					= getDBO();
        $db->setQuery(" SELECT cate_name FROM {$tableName} WHERE id='{$id}' ");
        $rs					= $db->loadAssocList();
        $id					= @$rs[0]['cate_name']?$rs[0]['cate_name']:'-';
    }

    function countContentViaCategory($cateId, $tblName){
            $db													= getDBO();
            $db->setQuery(" SELECT count(id) AS total FROM {$tblName} WHERE status='1' AND cid='{$cateId}'  ");
            $rs													= $db->loadAssocList();
            return $rs[0]['total'];
    }


    function getAllCategory( $currentId, $tableName, $currentParentId=-1, $cateId=-1){  
	      
        $db					= getDBO();
        $db->setQuery("SELECT id FROM  {$tableName} WHERE status='1' AND parent_id='{$currentId}'  ORDER BY id DESC ");
        $rs					= $db->loadAssocList();
        $len					= count($rs);
        if(count($len)){
            $output				= Array();
            $store				= Array();
            for( $i=0;  $i<$len;  $i++ ){
                    $store[]			= Array(
                            'id'	=> $rs[$i]['id'],
                            'level'	=> 1
                    );
            }
            while( count($store)>0 ){
                    $buf				= array_pop($store);
                    $output[]		= $buf;
                    $db->setQuery("SELECT id FROM  {$tableName} WHERE status='1' AND parent_id='{$buf['id']}'   ORDER BY id DESC ");
                    $rs					= $db->loadAssocList();
                    $len					= count($rs);
                    
                    for( $i=0;   $i<$len;  $i++ ){
                            $row			= Array(
                                    'id'	=> $rs[$i]['id'],
                                    'level'	=> ($buf['level']+1)
                            );
                            array_push($store, $row );
                    }
            }
            $html				= "";
            $len				= count($output);
            $html				.='
                    <select name="cid" class="form-control input-sm">
                            <option  value=""> --- '.lang('select category', 'select category').' --- </option>
            ';
            for(  $i=0;   $i<$len;   $i++  ){
                $db->setQuery("SELECT id, cate_name FROM {$tableName}  WHERE id='{$output[$i]['id']}' ");
                $rs				= $db->loadAssocList();
                $rs				= $rs[0];
                $tab				= '';
                for($loop=0;$loop<($output[$i]['level']-1);$loop++){$tab.='&mdash;';}
                $selected			= $rs['id']==$currentParentId ? ' selected="selected" ' : '' ;
                $disabled			= $rs['id']==$cateId ? ' disabled="disabled" ' : '' ;
                if($rs['cate_name']=='main'){
                    $rs['cate_name']            = 'หมวดหลัก';
                }
                $html					.='
                        <option value="'.$rs['id'].'" '.$selected.' '.$disabled.'  >&nbsp;'.$tab.' '.$rs['cate_name'].'</option>
                ';		
            }
            return $html;
        }else{
            return "";
        }
    }



 function getAllCategory2( $currentId, $tableName, $currentParentId=-1, $cateId=-1){  
	      
        $db					= getDBO();
        $db->setQuery("SELECT id FROM  {$tableName} WHERE status='1' AND parent_id='{$currentId}'  ORDER BY id DESC ");
        $rs					= $db->loadAssocList();
        $len					= count($rs);
        if(count($len)){
            $output				= Array();
            $store				= Array();
            for( $i=0;  $i<$len;  $i++ ){
                    $store[]			= Array(
                            'id'	=> $rs[$i]['id'],
                            'level'	=> 1
                    );
            }
            while( count($store)>0 ){
                    $buf				= array_pop($store);
                    $output[]		= $buf;
                    $db->setQuery("SELECT id FROM  {$tableName} WHERE status='1' AND parent_id='{$buf['id']}'   ORDER BY id DESC ");
                    $rs					= $db->loadAssocList();
                    $len					= count($rs);
                    
                    for( $i=0;   $i<$len;  $i++ ){
                            $row			= Array(
                                    'id'	=> $rs[$i]['id'],
                                    'level'	=> ($buf['level']+1)
                            );
                            array_push($store, $row );
                    }
            }
            $html				= "";
            $len				= count($output);
            $html				.='
                    <select name="cid" class="input-sm input-cid" onchange="if(this.value){this.form.submit();}else{ window.location.href=\''.base_url().getParam("1").'\';}">
                            <option  value=""> --- ประเภททั้งหมด --- </option>
            ';
            for(  $i=0;   $i<$len;   $i++  ){
                $db->setQuery("SELECT id, cate_name FROM {$tableName}  WHERE id='{$output[$i]['id']}' ");
                $rs				= $db->loadAssocList();
                $rs				= $rs[0];
                $tab				= '';
                for($loop=0;$loop<($output[$i]['level']-1);$loop++){$tab.='&mdash;';}
                $selected			= $rs['id']==$currentParentId ? ' selected="selected" ' : '' ;
                $disabled			= $rs['id']==$cateId ? ' disabled="disabled" ' : '' ;
                if($rs['cate_name']=='main'){
                    $rs['cate_name']            = 'หมวดหลัก';
                }
                $html					.='
                        <option value="'.$rs['id'].'" '.$selected.' '.$disabled.'  >&nbsp;'.$tab.' '.$rs['cate_name'].'</option>
                ';		
            }
            return $html;
        }else{
            return "";
        }
    }

    
    function getAllCategory3( $currentId, $tableName, $currentParentId=-1, $cateId=-1){
    
    
    	 
    	$db					= getDBO();
    	$db->setQuery("SELECT id FROM  {$tableName} WHERE status='1' AND parent_id='{$currentId}' ORDER BY id DESC ");
    	$rs					= $db->loadAssocList();
    	$len					= count($rs);
    	if(count($len)){
    		$output				= Array();
    		$store				= Array();
    		for( $i=0;  $i<$len;  $i++ ){
    			$store[]			= Array(
    					'id'	=> $rs[$i]['id'],
    					'level'	=> 1
    			);
    		}
    		while( count($store)>0 ){
    			$buf				= array_pop($store);
    			$output[]		= $buf;
    			$db->setQuery("SELECT id FROM  {$tableName} WHERE status='1' AND parent_id='{$buf['id']}' AND id IN ('8','16')   ORDER BY id DESC ");
    			$rs					= $db->loadAssocList();
    			$len					= count($rs);
    			for( $i=0;   $i<$len;  $i++ ){
    				$row			= Array(
    						'id'	=> $rs[$i]['id'],
    						'level'	=> ($buf['level']+1)
    				);
    				array_push($store, $row );
    			}
    		}
    		$html				= "";
    		$len				= count($output);
    		$html				.='
                    <select name="parent_id" id="parent_id" style="min-width:300px;" class="required">
                            <option  value="">'.lang('select category', 'select category').'</option>
            ';
    		for(  $i=0;   $i<$len;   $i++  ){
    			$db->setQuery("SELECT id, cate_name FROM {$tableName}  WHERE id='{$output[$i]['id']}' ");
    			$rs				= $db->loadAssocList();
    			$rs				= $rs[0];
    			$tab				= '';
    			for($loop=0;$loop<($output[$i]['level']-1);$loop++){$tab.='&mdash;';}
    			$selected			= $rs['id']==$currentParentId ? ' selected="selected" ' : '' ;
    			$disabled			= $rs['id']==$cateId ? ' disabled="disabled" ' : '' ;
    			if($rs['cate_name']=='main'){
    				$rs['cate_name']            = 'หมวดหลัก';
    			}
    			$html					.='
                        <option value="'.$rs['id'].'" '.$selected.' '.$disabled.'  >&nbsp;'.$tab.' '.$rs['cate_name'].'</option>
                ';
    		}
    		return $html;
    	}else{
    		return "";
    	}
    }
    
    
    

    function getAllCID( $currentId, $tableName, $cateId=-1){        
        return str_replace('parent_id', 'cid', getAllCategory($currentId, $tableName, $cateId));
    }


    function getAllCID2( $currentId, $tableName, $cateId=-1){        
        return str_replace('parent_id', 'cid', getAllCategory2($currentId, $tableName, $cateId));
    }


    /* Webboard  */
    function getSubDetail(&$detail){
        $detail                 = utf8_substr(strip_tags($detail), 0, 60);
    }

    
    
        
    
    function getMonthName(&$index, $lang='th'){
        $month 			= array(    0	=>	array(	"th"	=> 	"มกราคม",
                                                                "en"	=> 	"January"),
                                            1	=>	array(	"th"    =>	"กุมภาพันธ์"	,
                                                                "en"	=>	"February"),
                                            2	=>	array(	"th"	=>	"มีนาคม",
                                                                "en"	=>	"March"),
                                            3	=>	array(	"th"	=>	"เมษายน",
                                                                "en"	=>	"April"),
                                            4	=>	array(	"th"	=>	"พฤษภาคม",
                                                                "en"	=>	"May"),
                                            5	=>	array(	"th"	=>	"มิถุนายน",
                                                                "en"	=>	"June"),
                                            6	=>	array(	"th"	=>	"กรกฎาคม",
                                                                "en"	=>	"July"),
                                            7	=>	array(	"th"	=>	"สิงหาคม",
                                                                "en"	=>	"August"),
                                            8	=>	array(	"th"	=>	"กันยายน",
                                                                "en"	=>	"September"),
                                            9	=>	array(	"th"	=>	"ตุลาคม",
                                                                "en"	=>	"October"),
                                            10	=>	array(	"th"	=>	"พฤศจิกายน",
                                                                "en"	=>	"November"),
                                            11	=>	array(	"th"	=>	"ธันวาคม",
                                                                "en"	=>	"December")
                                            );
        $index =   $month[$index-1][strtolower($lang)];
    }

    
    function getRecommend(&$val){
        if($val==1){
            $val        = '<span style="color:blue">ข่าวเด่น</span>';
        }else{
            $val        = '-';
        }
    }
    
    
    
    function dumpAll($value='', $file='output.txt'){
        $f              = fopen($file, 'w');
        ob_start();
        echo "VALUE";
        echo "\n";
        var_dump($value);
        echo "REQUEST";
        echo "\n";
        var_dump($_REQUEST);
        echo "FILES";
        echo "\n";
        var_dump($_FILES);
        echo "SERVER";
        echo "\n";
        var_dump($_SERVER);
        $output         = ob_get_clean();
        fwrite($f, $output);
        fclose($f);
    }
    
    
    function setCurrentAdminTab( $index ){
        $_ENV['alias-tab-number']           = $index;
    }
    
    
    function getTemplate_jquery(){
        $db                 = getdbo();
        $db->setQuery(" SELECT      jquery 
                        FROM        cpanel_template
                        WHERE       local_id='".Site::$local_id."'
                        ");
        $rs                 = $db->loadAssocList();
        return @$rs[0]['jquery']?$rs[0]['jquery'] : 'blitzer' ;
    }
    
    
    function isShowMenuIcon(){
        return @$_ENV['user-config']['showMenuIcon'] ? $_ENV['user-config']['showMenuIcon'] : false;
    }
    
    
    function getSystemConfig($configName){
        $db             = getDBO();
        $db->setQuery("SELECT value FROM cpanel_system WHERE name='{$configName}' ");
        $rs             = $db->loadAssocList();
        return @$rs[0]['value'];
    }
    
/* ---------------------- select box AJAX ----------------------------------------*/
	
      function getContentCID( $parentId, $tableName, $cateId=-1,$selId){    
    		   
        return str_replace('parent_id', 'cid', getContentCategory($parentId, $tableName, $cateId, $cateId, $selId));
    }
    
        function getContentCategory( $parentId, $tableName, $currentId=-1, $cateId=-1,$selId=""){  

        $db					= getDBO();
        $db->setQuery("SELECT id FROM  {$tableName} WHERE status='1' AND parent_id='{$parentId}' ORDER BY id DESC ");
        $rs					= $db->loadAssocList();
        $len					= count($rs);
        if(count($len)){
            $output				= Array();
            $store				= Array();
            for( $i=0;  $i<$len;  $i++ ){
                    $store[]			= Array(
                            'id'	=> $rs[$i]['id'],
                            'level'	=> 1
                    );
            }
			
            while( count($store)>0 ){
                    $buf				= array_pop($store);
                    $output[]		= $buf;
                    $db->setQuery("SELECT id FROM  {$tableName} WHERE status='1' AND parent_id='{$buf['id']}' AND id in $selId   ORDER BY id DESC ");

                    $rs					= $db->loadAssocList();
                    $len					= count($rs);
                    for( $i=0;   $i<$len;  $i++ ){
                            $row			= Array(
                                    'id'	=> $rs[$i]['id'],
                                    'level'	=> ($buf['level']+1)
                            );
                            array_push($store, $row );
                    }
            }
            $html				= "";
            $len				= count($output);
            $html				.='
                    <select name="parent_id" id="parent_id" style="min-width:300px;" class="required">
                            <option  value="">'.lang('select category', 'select category').'</option>
            ';
            for(  $i=0;   $i<$len;   $i++  ){
                $db->setQuery("SELECT id, cate_name FROM {$tableName}  WHERE id='{$output[$i]['id']}' ");
                $rs				= $db->loadAssocList();
                $rs				= $rs[0];
                $tab				= '';
                for($loop=0;$loop<($output[$i]['level']-1);$loop++){$tab.='&mdash;';}
                $selected			= $rs['id']==$currentId ? ' selected="selected" ' : '' ;
                $disabled			= $rs['id']==$cateId ? ' disabled="disabled" ' : '' ;
                if($rs['cate_name']=='main'){
                    $rs['cate_name']            = 'หมวดหลัก';
                }
                $html					.='
                        <option value="'.$rs['id'].'" '.$selected.' '.$disabled.'  >&nbsp;'.$tab.' '.$rs['cate_name'].'</option>
                ';		
            }
            return $html;
        }else{
            return "";
        }
    }
    
    
function getCategoryMain( $currentId, $tableName, $currentParentId=-1, $cateId=-1){  ?>        
        

        <script type="text/javascript">
           $(document).ready(function(){
			   $("#parent").change(function()
			   { var id=$(this).val();
				$.ajax({
                type: "POST",
                url: "<?=base_url()?>service_group/selecbox_sub",
                data:{id:id},
                cache: false,
                success: function(html){
					
                $("#chil").html(html);} 
                });
                
                });
                
                });
        </script>
	
    	  
<?PHP		  
        $db					= getDBO();
        $db->setQuery("SELECT id,cate_name FROM  {$tableName} WHERE status='1' AND parent_id='1' ORDER BY id ASC ");
        $rs					= $db->loadAssocList();
        $len					= count($rs);
		
		
	/*	echo "<pre>";
		print_r($rs);
		echo "</pre>";
		exit();
	*/	
	
        if(count($len)>0){
			$html				= "";

            $html				.='
                    <select name="parent_id" id="parent" style="min-width:300px;" class="required">
                            <option  value="">'.lang('select category', 'select category').'</option>
            ';
            for(  $i=0;   $i<$len;   $i++  ){
               $html					.='
                        <option value="'.$rs[$i]['id'].'" '.$selected.' '.$disabled.'  >&nbsp;'.$tab.' '.$rs[$i]['cate_name'].'</option>
                ';		
            }
			$html .= "</select>";
			
			
			 $html	.='<div id="chil"></div>';
			
			
            return $html;
        }else{
            return "";
        }
    }
	
    
    
    
    function getShotDetail(&$str) {
      $str = strip_tags($str);

		$l = strlen($str);
		$len = 0;
		
		for ($i = 0; $i < $l; ++$i)
			if ((ord($str[$i]) & 0xC0) != 0x80) ++$len;

				if($len > 120){
				// echo $str;
					$str = iconv_substr($str,0,120,"UTF-8")."...";
				// $str = substr($str,0,$length)."...";
				}
		return $str;
    }
	
	
    
    function showRangeDate(&$date){
    	$Arrdate = explode(" ",$date);
    	
    	$date = eventDisplayDateShort($Arrdate[0],$Arrdate[1]);
    }
    
    
    
    
    
    function create_preview_images($file_path,$file_name) {
    
    	// Strip document extension
    	/*	$file_name = basename($file_name, '.pdf'); */
    
    	// Convert this document
    	// Each page to single image
    
    	$img = new imagick($file_path);
    
    	// Set background color and flatten
    	// Prevents black background on objects with transparency
    	$img->setImageBackgroundColor('white');
    	// $img = $img->flattenImages();
    
    	// Set image resolution
    	// Determine num of pages
    	$img->setResolution(300,300);
    	$num_pages = $img->getNumberImages();
    
    	// Compress Image Quality
    	$img->setImageCompressionQuality(100);
    
    	// Convert PDF pages to images
    	for($i = 0;$i < $num_pages; $i++) {
    
    		// Set iterator postion
    		$img->setIteratorIndex($i);
    
    		// Set image format
    		$img->setImageFormat('jpeg');
    
    
    		$file_new =  "../../../../files/com_journal/".date('Y-m')."/".$file_name."-".$i.".jpg";
    
    		$img->writeImage($file_new);
    	}
    
    	$img->destroy();
    }
    
    
    function shortThDateYearlong($data){
    	if(!$data){
    		$data = "-";
    	}
    	else if($data == "0000-00-00 00:00:00"){
    		$data = "-";
    	}
    	else if($data == "0000-00-00"){
    		$data = "-";
    	}
    	else if($data == "00:00:00"){
    		$data = "-";
    	}
    	else {

            $time = explode(" ",$data);
            $time[1] = substr($time[1],0,5)." น.";

    		$m = array( "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." );
    		$day = date("d",strtotime($data));
    		$month = date("m",strtotime($data));
    		$year = date("Y",strtotime($data));
    		$year = ceil($year+543);
    		$month = $m[ceil($month-1)];
    		$data = sprintf("%d %s %s - %s",$day,$month,$year,@$time[1]);
    	}
    	 
    	return $data;
    	 
    }
    
    
    
    function shortThDateYearlongY($data){
    if(!$data){
    		$data = "-";
    	}
    	else if($data == "0000-00-00 00:00:00"){
    		$data = "-";
    	}
    	else if($data == "0000-00-00"){
    		$data = "-";
    	}
    	else if($data == "00:00:00"){
    		$data = "-";
    	}
    	else {

            $time = explode(" ",$data);
            $time[1] = substr($time[1],0,5);

    		$m = array( "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." );
    		$day = date("d",strtotime($data));
    		$month = date("m",strtotime($data));
    		$year = date("Y",strtotime($data));
    		$year = ceil($year+543);
    		$month = $m[ceil($month-1)];
    		$data = sprintf("%d %s %s - %s",$day,$month,substr($year,2,2),@$time[1]);
    	}
    
    	return $data;
    
    }
    
    
    
    function shortThDateYearlongYAdmin(&$data){
    	if(!$data){
    		$data = "-";
    	}
    	else if($data == "0000-00-00 00:00:00"){
    		$data = "-";
    	}
    	else if($data == "0000-00-00"){
    		$data = "-";
    	}
    	else if($data == "00:00:00"){
    		$data = "-";
    	}
    	else {
    
    		$time = explode(" ",$data);
    		$time[1] = substr($time[1],0,5);
    
    		$m = array( "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." );
    		$day = date("d",strtotime($data));
    		$month = date("m",strtotime($data));
    		$year = date("Y",strtotime($data));
    		$year = ceil($year+543);
    		$month = $m[ceil($month-1)];
    		$data = sprintf("%d %s %s - %s",$day,$month,substr($year,2,2),@$time[1]);
    	}
    
    
    }
    
    function chThaiDate($dat){
    	
    	$arrD = explode("/",$dat);
    	$day  = $arrD[0];
    	$mon  = $arrD[1];
    	$year = $arrD[2];
    	
    	return $year."-".$mon."-".$day;
    	
    }
    
    
    function chEngDate($dat){
    	 
    	$arrD = explode("-",$dat);
    	$day  = $arrD[2];
    	$mon  = $arrD[1];
    	$year = $arrD[0];
    	 
    	return $day."/".$mon."/".$year;
    	 
    }
    
    
    function chEngDate2($data){
    
    	if(!$data){
 		$data = "-";
	 	}
	 	else if($data == "0000-00-00 00:00:00"){
	 		$data = "-";
	 	}
	 	else if($data == "0000-00-00"){
	 		$data = "-";
	 	}
	 	else if($data == "00:00:00"){
	 		$data = "-";
	 	}
	 	else {
	 		$m = array( "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" );
	 		$day = date("d",strtotime($data));
	 		$month = date("m",strtotime($data));
	 		$year = date("Y",strtotime($data));
	 		$year = ceil($year);
	 		$month = $m[ceil($month-1)];
	 		$data = sprintf("%s/%s/%s",$day,$month,$year);
	 	}
	 	 
	 	return $data;
    
    }
    
    
    function chEngDate3(&$data){
    
    if(!$data){
    		$data = "-";
    	}
    	else if($data == "0000-00-00 00:00:00"){
    		$data = "-";
    	}
    	else if($data == "0000-00-00"){
    		$data = "-";
    	}
    	else if($data == "00:00:00"){
    		$data = "-";
    	}
    	else {

            $time = explode(" ",$data);
            $time[1] = substr($time[1],0,5);

    		$m = array( "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." );
    		$day = date("d",strtotime($data));
    		$month = date("m",strtotime($data));
    		$year = date("Y",strtotime($data));
    		$year = ceil($year+543);
    		$month = $m[ceil($month-1)];
    		$data = sprintf("%d %s %s - %s",$day,$month,substr($year,2,2),@$time[1]);
    	}
    
    
    }
    
   function getCreateData(&$para){
    	
	   	if($para){
	   		$exp = explode("__",$para);
	   		 
	   		$db = getDBO();
	   		$db->setQuery("SELECT fullname FROM users WHERE id = '".$exp[1]."' ");
	   		$rs = $db->loadAssocList();
	   		@$rs = $rs[0];
	   		 
	   		$para = $rs['fullname']."<br>".shortThDateYearlongY($exp[0]);
	   	}else{
	   		$para = "-";
	   	}
    
    }
    
    
    function getCIPData(&$para){
    	 
    	if($para){
    		$exp = explode("__",$para);
    		 
    		$db = getDBO();
    		 
    		$para = "<font><b>".shortThDateYearlongY(@$exp[0])."</b></font><br><font style='color: #757575;font-size:11px;'>IP Address: ".@$exp[1]."</font>";
    	}else{
    		$para = "-";
    	}
    
    }
    
    
     function getRemark(&$remark){
    	$db = getDBO();
    	$db->setQuery("SELECT remark_serial FROM remark_history WHERE regist_id = '".$remark."' AND status = '1' ORDER BY id DESC LIMIT 1");
    	$rs = $db->loadAssocList();

    	$arr = unserialize($rs[0]["remark_serial"]);
    	
    	$str = "";
    	$ccho = "";
    	$i = 0;
    	$des="";

    	foreach ($arr as $key => $val) {
    		
    		if($key=="remark_des"){
    			$des = $val;
    		}else{
    			
    			$str.= ($i==0) ? "'".$val."'" : ",'".$val."'";
    			
    		}
    		
    		$i++;
    	}
    	
    	$db->setQuery("SELECT name FROM remark_napprove WHERE id IN (".$str.") AND status = '1' " );
    	$res = $db->loadAssocList();
    	
        for($i=0,$j=1;$i<count($res);$i++,$j++){
        	
        	$ccho .= ($i<>0) ? "<br>".$j.". ".$res[$i]["name"] : $j.". ".$res[$i]["name"];
        }
        
        $replace = '<font style="color: #003A6B;font-size: 13px;">'.$ccho.'</font>';
        
        $remark  = str_replace("อื่นๆ ระบุ",(($des) ? "อื่นๆ (".$des.")" : "อื่นๆ "),$replace);

    }
    
    
    function chkRemark($remark,$txt){
    	
    	$db = getDBO();
    	$db->setQuery("SELECT remark_serial FROM remark_history WHERE regist_id = '".$remark."' AND status = '1' ORDER BY id DESC LIMIT 1");
    	$rs = $db->loadAssocList();

    	$arr = unserialize($rs[0]["remark_serial"]);
    	
    	$str = "";
    	$ccho = "";
    	$des="";
    	
    	
    	foreach ($arr as $key => $val) {
    		
    		if($key==$txt){
    			$chk = true;
    			break;
    		}else{
    			$chk = false;
    		}
    	}
    	
    	return ($chk) ? "/" : "";
    	
    	
    }
    
    function getPeriodNow(){
    	
    	$db = getDBO();
    	
    	$db->setQuery("SELECT period FROM period WHERE status = '1' ORDER BY id DESC LIMIT 1 ");
    	$rs = $db->loadAssocList();
    	
    	$period = $rs[0]["period"];
    	
    	return $period;
    	
    }
    
    
    function getBtn(&$Param){
    	
    	$db = getDBO();
    	 
    	$db->setQuery("SELECT status FROM statement WHERE id = '".$Param."' ");
    	$rs = $db->loadAssocList();
    	
    	$link = base_url().getParam("1").'/edit/'.$Param;
    	
    	if($rs[0]["status"]=="0"){
    	    $Param = '<a href="'.$link.'"><img src="images/icons/bbb.png"></a>';
    	}else{
    		$Param = '<a href="'.$link.'"><img src="images/icons/aaa.png"></a>';
    	}
    }
    
    
    function getCustID($param){
    	$db = getDBO();
    	
    	$db->setQuery("SELECT customer_id FROM register_information_approve WHERE id = '".$param."' LIMIT 1 ");
    	$rs = $db->loadAssocList();
    	
    	return $rs[0]["customer_id"];
    }
    
    
    function getCustName($param){
    	$db = getDBO();
    	 
    	$db->setQuery("SELECT customer_main_prename,customer_main_name FROM register_information_approve WHERE id = '".$param."' LIMIT 1 ");
    	$rs = $db->loadAssocList();
    	 
    	return $rs[0]["customer_main_prename"].$rs[0]["customer_main_name"];
    	  
    }
    
    
    function getStoreName($param){
    	$db = getDBO();
    
    	$db->setQuery("SELECT store_name FROM register_information_approve WHERE id = '".$param."' LIMIT 1 ");
    	$rs = $db->loadAssocList();
    
    	return $rs[0]["store_name"];
    	 
    }
    
    
    function getMemID($param){
    	$db = getDBO();
    	 
    	$db->setQuery("SELECT member_id FROM register_information_approve WHERE id = '".$param."' LIMIT 1 ");
    	$rs = $db->loadAssocList();
    	 
    	return $rs[0]["member_id"];
    }
    
    function getPrintBtn(&$id){
    	
    	$id = '<a class="btn btn-block btn-social btn-bitbucket" href="'.base_url().getParam("1")."/printstate?id_print=".$id.'" target="_blank"><i class="fa fa-print"></i> พิมพ์ใบรายการ</a>';
    }
    
    function getYesscore($param){
    	$db = getDBO();
    	
    	$db->setQuery("SELECT count(id) As cc FROM statement WHERE period = '".$param."' AND status = '2' ");
    	$rs = $db->loadAssocList();
    	
    	return $rs[0]["cc"];
    }
    
    
    function getYesscore_period($param){
    	$db = getDBO();
    	 
    	$db->setQuery("SELECT count(id) As cc FROM statement WHERE period = '".$param."' AND status = '1' ");
    	$rs = $db->loadAssocList();
    	 
    	return $rs[0]["cc"];
    }
    
    
    
    function getNoscore($param){
    	$db = getDBO();
    	 
    	$db->setQuery("SELECT count(id) As cc FROM statement WHERE period = '".$param."' AND status = '0' ");
    	$rs = $db->loadAssocList();
    	 
    	return $rs[0]["cc"];
    }
    
    
    
    function getCustActive($para){
    	
    	$db = getDBO();
    	
    	$db->setQuery("SELECT count(id) As cc FROM register_information_approve WHERE status = '1' ");
    	$rs = $db->loadAssocList();
    	
    	
    	return $rs[0]["cc"];
    }
    
    
    function getCustActive_period($para){
    	
    	$db = getDBO();
    
    	$db->setQuery("SELECT count(id) As cc FROM register_information_approve WHERE period = '".$para."' AND status = '1'  ");
    	$rs = $db->loadAssocList();
    	 
    	//echo $db->getQuery();
    
    	return $rs[0]["cc"];
    }
    
    
    function getPeriodPrev($periods){
    
    	$period =  $periods;
    
    	$arr  = explode("/",$period);
    	$mon  = $arr[0];
    	$year = $arr[1];
    
    
    	if($mon=="01"){
    		$year = $year-1;
    		$prev = "12"."/".$year;
    	}else if($mon=="02"){
    		$prev = "01"."/".$year;
    	}else if($mon=="03"){
    		$prev = "02"."/".$year;
    	}else if($mon=="04"){
    		$prev = "03"."/".$year;
    	}else if($mon=="05"){
    		$prev = "04"."/".$year;
    	}else if($mon=="06"){
    		$prev = "05"."/".$year;
    	}else if($mon=="07"){
    		$prev = "06"."/".$year;
    	}else if($mon=="08"){
    		$prev = "07"."/".$year;
    	}else if($mon=="09"){
    		$prev = "08"."/".$year;
    	}else if($mon=="10"){
    		$prev = "09"."/".$year;
    	}else if($mon=="11"){
    		$prev = "10"."/".$year;
    	}else if($mon=="12"){
    		$prev = "11"."/".$year;
    	}
    
    	return $prev;
    
    }
    
    
 
    
    function getDeptname(&$para){
    	
    	$dbCenter                   = getDBO_center();
    	$dbcen                      = Database::$dbName_center;
    	
    	$dept = $para;
    	
    	
    	$dbCenter->setQuery("SELECT deptname FROM tbl_dept_utf8  WHERE id = '".$dept."'  LIMIT 1 ");
    	$rs = $dbCenter->loadAssocList();
    	 
    	$dept = @$rs[0]["deptname"];
    	 
    	$para = $dept;
    }
    
    function ch_date_sap($param){
    	
    	$arr = explode(".",$param);
    	
    	$dat  = @$arr[0];
    	$mon  = @$arr[1];
    	$year = @$arr[2];
    	
    	return $year."-".$mon."-".$dat;
    	
    }
    
    
    function ch_date_sap_con(&$param){
    	 
    	$arr = explode("-",$param);
    	 
    	$dat  = @$arr[2];
    	$mon  = @$arr[1];
    	$year = @$arr[0];
    	 
    	$param = $dat.".".$mon.".".$year;
    	 
    }
    
    
    function replace_comma($param){
    	
      $str	= str_replace(",","",$param);
      
      return @$str;
    	
    }
    
    
    function formatType(&$param){
    	
    	$param = number_format($param,2);
    }
    
    
    function getMonthPeriod($param){
    	
    	$arr = explode("/",$param); 
    	return $arr[1];
    }
    
    function getProvinceName($id){
    	$db = getDBO();
    	 
    	$db->setQuery(" SELECT province_name FROM cpanel_province WHERE province_id = '".$id."' ");
    	$rs = $db->loadAssocList();
    	 
    	return @$rs[0]["province_name"];
    	 
    }
    
    
    function getDistrictName($id){
    	$db = getDBO();
    
    	$db->setQuery(" SELECT amphur_name FROM cpanel_amphur WHERE amphur_id = '".$id."' ");
    	$rs = $db->loadAssocList();
    
    	return @$rs[0]["amphur_name"];
    
    }
    
    
    function getSubDistrictName($id){
    	$db = getDBO();
    
    	$db->setQuery(" SELECT district_name FROM cpanel_district WHERE district_id = '".$id."' ");
    	$rs = $db->loadAssocList();
    
    	return @$rs[0]["district_name"];
    }
    
    
    function check_exits_table($param){
    	
    	$db = getDBO();
    	
    	$result = mysql_query("SHOW TABLES LIKE '".$param."' ");
    	$tableExists = mysql_num_rows($result) > 0;
    	
    	if($tableExists){
    		
    	}else{
    		$db->setQuery("CREATE TABLE ".$param." LIKE temp_data");
    		$db->Query();
    		
    		$db->setQuery("ALTER TABLE ".$param." ADD create_date datetime after period");
    		$db->Query();
    		
    		$db->setQuery("ALTER TABLE ".$param." ADD create_by int(11) after create_date");
    		$db->Query();
    		
    		$db->setQuery("ALTER TABLE ".$param." ADD create_ip char(100) after create_by");
    		$db->Query();
    	}

  }
  
  
  function getYear($date) {	
     $year = substr($date,0,4);  
  	 return $year;	
  }
    
    
    
?>
<?php
    class Util{
    	
    	public function getWriteFileLang(){
    		$filename_th = "./application/language/english/th_lang.php";
    		$filename_en = "./application/language/english/en_lang.php";
    		
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
                return '<img src="'.base_url().'images/new.gif" />';
            }
        }
        
        
        public function eventDisplayDate($startDate,$endDate)
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
	
	
	
function get_subString($subject,$max_length=false)
{
	$subject = strip_tags($subject);			
	
	if($max_length){
		if(iconv_strlen($subject) > $max_length){
					$subject = iconv_substr($subject,0,$max_length,"UTF-8")."...";
	}else{
		$subject=$subject;
	  }
	}	
		
	return $subject;

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
    
    
    function getExtImage($extension){
        return base_url().'images/files_icon/'.$extension.'.png';
    }
	
 
	 // create date 08-07-56
	function strsub_message($str,$length){
		$str = strip_tags($str);

		$l = strlen($str);
		$len = 0;
		
		for ($i = 0; $i < $l; ++$i)
			if ((ord($str[$i]) & 0xC0) != 0x80) ++$len;

				if($len > $length){
				// echo $str;
					$str = iconv_substr($str,0,$length,"UTF-8")."...";
				// $str = substr($str,0,$length)."...";
				}
		return $str;
}

    
    
    
    function eventDisplayDate($startDate,$endDate){
        $obj                    = getUtilObject();
        return $obj->eventDisplayDate($startDate,$endDate);
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
    
    
    
    
    function setPicContent($number){
        @$_ENV['system-pic-content']            = $number;
    }
    function getPicContent(){
        return @$_ENV['system-pic-content'];
    }
	
	function thaifullmonth($month){
	
		switch($month){
			case 1 :
				$month = "มกราคม";
				break;
			case 2 :
				$month = "กุมภาพันธ์";
				break;
			case 3 :
				$month = "มีนาคม";
				break;
			case 4 :
				$month = "เมษายน";
				break;
			case 5 :
				$month = "พฤษภาคม";
				break;
			case 6 :
				$month = "มิถุนายน";
				break;
			case 7 :
				$month = "กรกฎาคม";
				break;
			case 8 :
				$month = "สิงหาคม";
				break;
			case 9 :
				$month = "กันยายน";
				break;
			case 10 :
				$month = "ตุลาคม";
				break;
			case 11 :
				$month = "พฤศจิกายน";
				break;
			case 12 :
				$month = "ธันวาคม";
				break;
			default :
				$month = "มกราคม";
				break;
		}
		return $month;
	}
	
	
	function englifullmonth($month){
	
		switch($month){
			case 1 :
				$month = "January";
				break;
			case 2 :
				$month = "Febuary";
				break;
			case 3 :
				$month = "March";
				break;
			case 4 :
				$month = "April";
				break;
			case 5 :
				$month = "May";
				break;
			case 6 :
				$month = "June";
				break;
			case 7 :
				$month = "July";
				break;
			case 8 :
				$month = "August";
				break;
			case 9 :
				$month = "September";
				break;
			case 10 :
				$month = "October";
				break;
			case 11 :
				$month = "November";
				break;
			case 12 :
				$month = "December";
				break;
			default :
				$month = "January";
				break;
		}
		return $month;
	}
	
	function getNewImg($_tmpDate,$_tmpChk){
			if (@compareDate($_tmpDate,$_tmpChk )) {
				  $img_new = '<img src="images/new.png" width="53" height="53" />';	
			}else{ 
				  $img_new = '';
			}
		return $img_new;
	}
	
	
	function getRecomendImg($recomend){
		
		if ($recomend=="1") {
			$img_recomend = '<img src="images/special.png" width="72" height="72" />';
		}else{
			$img_recomend = '';
		}
		return $img_recomend;
		
	}
	
	
  
  function changeFormatDateThaiAc($tempDate2){
  
  $temp = explode('-',$tempDate2);
  $day = $temp[2];
  $mon = $temp[1];
  $year = intval($temp[0]) + 543;
  	
  return $day."/".$mon."/".$year;
  	
  }
  

  
  
  function shortThDate($data){
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
  		$m = array( "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." );
  		$day = date("d",strtotime($data));
  		$month = date("m",strtotime($data));
  		$year = date("Y",strtotime($data));
  		$year = ceil($year+543);
  		$month = $m[ceil($month-1)];
  		$data = sprintf("%d %s %s",$day,$month,$year);
  	}
  	
  	return $data;
  	
  }
  
  
  function shortEnDate($data){
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
  		$m = array( "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" );
  		$day = date("d",strtotime($data));
  		$month = date("m",strtotime($data));
  		$year = date("Y",strtotime($data));
  		$year =$year;
  		$month = $m[ceil($month-1)];
  		$data = sprintf("%d %s %s",$day,$month,$year);
  	}
  	 
  	return $data;
  	 
  }
  
    function checkSpamText($text){
        if( !@$_ENV['system-validate-spam'] ){
            $db                 = getDBO();
            $db->setQuery(" SELECT          * 
                            FROM            cpanel_spam_filter 
                            WHERE           checked='1'
                            ");
            $filter             = $db->loadAssocList();
            $word               = Array();
            if( $filter ){
                foreach($filter AS      $v){
                    $v['subject']           = trim($v['subject']);
                    $word[]         = Array(
                        'subject'           => $v['subject'],
                        'found'             => $v['found'],
                        'insensitive'       => $v['insensitive'],
                        'check_by_detail'   => $v['check_by_detail'],
                        'check_by_name'     => $v['check_by_name']
                    );
                }
                $_ENV['system-validate-spam']   = &$word;
            }
        }
        $spam                   = $_ENV['system-validate-spam'];
        $len                    = count($spam);
        if( $len>0 ){
            foreach( $spam  AS      $v){
                $word           = $v['subject'];
                $found          = '';
                if( $v['insensitive'] ){
                    $found      = @stristr($text, $word);
                }else{
                    $found      = @strstr($text, $word);
                }
                if($found){
                    return true;
                }
                
            }
        }
        return false;
    }
    
    

/*######################### Phuwanart 0808/2016 ######################*/
    
    function select_lang_th($lang){
    
    	$sel_lang = ($lang=="th") ? 'images/header/thai-select.png' : 'images/header/thai.png';
    	return @$sel_lang;
    }
    
    
    function select_lang_en($lang){
    
    	$sel_lang = ($lang=="en") ? 'images/header/english-select.png' : 'images/header/english.png';
    	return @$sel_lang;
    }
    
    function getTitle($title) {
    	return $title." ...";
    }
    
    function getImgVDO($url){
    	
    	$arr = explode("v=",$url);
    	$arr2 = explode("&",$arr[1]);
    	
    	$img = 'http://img.youtube.com/vi/'.@$arr2[0].'/hqdefault.jpg';
    	
    	return $img;
    	
    }
    
    function getYear($date) {
    	$year = substr($date,0,4);
    	return $year;
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
    
    
    function getVideoPaht($_table,$_upKey){
    	$db = getDBO();
    	$db->setQuery("SELECT filepath FROM {$_table} WHERE uploadKey = '".$_upKey."' AND status = '1' ORDER BY id DESC LIMIT 1 ");
    	$files = $db->loadAssocList();
    	 
    	return $files[0]["filepath"];
    }
    
    
    function getTotalinCart(){
    	
    	$total_items = 0;
    	
    	if(@$_SESSION["cart"]){
	    	foreach ($_SESSION["cart"] as $value) {
	    			$total_items += $value;
			}			
    	}
    	
    	return @$total_items;
    }
    
    
    function getOrderinCart(){
    	 
    	$total_items = 0;
    	 
    	if(@$_SESSION["cart"]){
    		$total_items = count($_SESSION["cart"]);
    	}
    	 
    	return @$total_items;
    }
    
    
    function getAmountinCart(){
    	 
    	$total = 0;
    	
    	$db = getDBO();
    	 
    	if(@$_SESSION["cart"]){
    		
    		foreach ($_SESSION["cart"] as $key => $value) {
    			
    			$db->setQuery("SELECT normal_price, special_price FROM product_information WHERE id = '".$key."' ");
    			$rs = $db->loadAssocList();
    			$rs = $rs[0];
    			
    			$price    = ($rs["special_price"]!=0) ? $rs["special_price"] : $rs["normal_price"] ;
    			$sumprice = $price * $value;
    			
    			$total += @$sumprice;
    		}
    		
    	}
    	 
    	return @$total;
    }
    
    
   function getTotalWeight(){
   	
   	$totalW = 0;
   	 
   	$db = getDBO();
   	
   	if(@$_SESSION["cart"]){
   	
   		foreach ($_SESSION["cart"] as $key => $value) {
   			 
   			$db->setQuery("SELECT weight FROM product_information WHERE id = '".$key."' ");
   			$rs = $db->loadAssocList();
   			$rs = $rs[0];
   			 
   			$weight    = ($rs["weight"]) ? $rs["weight"] : 0;
   			$sumw     = $weight * $value;
   			 
   			$totalW += @$sumw;
   		}
   	
   	}
   	
   	return @$totalW;
   	
   }
    
    
    
    
	function escape_str($str){
	
		$rs = str_replace("'","\'",$str);
	
		return $rs;
	}
	
	function getImageProduct($id,$img_w,$img_h){
		
		$db = getDBO();
		
		$db->setQuery("SELECT display_image FROM product_information WHERE id = '".$id."' ");
		$rs = $db->loadAssocList();
		
		$image = getImageRatio($rs[0]['display_image'],$img_w, $img_h);
		
		return @$image;	
	}
	
	function getProductDetail($id,$condition) {
		$db = getDBO();
		
		$db->setQuery("SELECT {$condition} FROM product_information WHERE id = '".$id."' ");
		$rs = $db->loadAssocList();
		
		return $rs[0][@$condition];
	}
	
	function getProductPrice($id){
		$db = getDBO();
		
		$db->setQuery("SELECT normal_price,special_price FROM product_information WHERE id = '".$id."' ");
		$rs = $db->loadAssocList();
		
		$price = (@$rs[0]["special_price"]!=0) ? $rs[0]["special_price"] : $rs[0]["normal_price"] ;
		
		return $price;
	}
	
	
	function get_vary_amount(){
		
		$db = getDBO();
		
		$price = 0;
		
		$db->setQuery("SELECT start_delivery,more_delivery FROM shipping_information WHERE ship_type = '3' AND status = '1' ");
		$rs = $db->loadAssocList();
		
		
		for($i=0,$j=1;$i<@getTotalinCart();$i++,$j++){
			
			if($i==0){
				$price +=  $rs[0]["start_delivery"];
			}else{
				$price +=  $rs[0]["more_delivery"];
			}
			
		}
		
		return @$price;
		
	}
	
	
	function get_vary_total($sh_id){
		/*
    --  Oparand --
		 
		 1 is <
		 2 is <=
		 3 is =
		 4 is >=
		 5 is >  */
		
		$db = getDBO();
		
		$price = 0;
		$total = getAmountinCart();
		
		$db->setQuery("SELECT oparator,total,total_price FROM shipping_cal WHERE cid = '4' AND shipping_id = '".$sh_id."' AND status = '1' ORDER BY id ASC");
		$rs = $db->loadAssocList();
		
		if($total>0){
				
			for($i=0;$i<count($rs);$i++){
					
				if($rs[$i]["oparator"]==1){
					if($total < $rs[$i]["total"]){
						$price = $rs[$i]["total_price"];
						break;
					}
				}else if($rs[$i]["oparator"]==2){
					if($total <= $rs[$i]["total"]){
						$price = $rs[$i]["total_price"];
						break;
					}	
				}else if($rs[$i]["oparator"]==3){
					if($total == $rs[$i]["total"]){
						$price = $rs[$i]["total_price"];
						break;
					}	
				}else if($rs[$i]["oparator"]==4){
					if($total >= $rs[$i]["total"]){
						$price = $rs[$i]["total_price"];
						break;
					}	
				}else if($rs[$i]["oparator"]==5){
					if($total > $rs[$i]["total"]){
						$price = $rs[$i]["total_price"];
						break;
					}	
				}
			
			}
			
		}
		
		
		
		return @$price;
	}
	
	
	
	function get_vary_weigth($sh_id){
		
		$db = getDBO();
		
		$weight = 0;
		$total = getTotalWeight();
		
		$db->setQuery("SELECT oparator,weight,weight_price FROM shipping_cal WHERE cid = '5' AND shipping_id = '".$sh_id."' AND status = '1' ORDER BY id ASC");
		$rs = $db->loadAssocList();
		
		if($total>0){
		
			for($i=0;$i<count($rs);$i++){
					
				if($rs[$i]["oparator"]==1){
					if($total < $rs[$i]["weight"]){
						$weight = $rs[$i]["weight_price"];
						break;
					}
				}else if($rs[$i]["oparator"]==2){
					if($total <= $rs[$i]["weight"]){
						$weight = $rs[$i]["weight_price"];
						break;
					}
				}else if($rs[$i]["oparator"]==3){
					if($total == $rs[$i]["weight"]){
						$weight = $rs[$i]["weight_price"];
						break;
					}
				}else if($rs[$i]["oparator"]==4){
					if($total >= $rs[$i]["weight"]){
						$weight = $rs[$i]["weight_price"];
						break;
					}
				}else if($rs[$i]["oparator"]==5){
					if($total > $rs[$i]["weight"]){
						$weight = $rs[$i]["weight_price"];
						break;
					}
				}
					
			}
				
		}

		return @$weight;
		
	}
	
	
	
	function getPriceShip($id){
		
		$db = getDBO();
		
		$sum = 0;
			
		$db->setQuery("SELECT i.id,i.subject,i.subject_en,i.ship_time,i.ship_type,i.price_delivery,c.id As cate_id,c.cate_name,c.cate_name_en FROM shipping_information i left join shipping_category c ON i.ship_type = c.id WHERE i.status = '1' AND i.id = '".$id."' ORDER by i.id ASC ");
		$ship = $db->loadAssocList();
			
		for($i=0;$i<count($ship);$i++){
			
			if($ship[$i]["cate_id"]=="1"){
				$sum = 0;
			}else if($ship[$i]["cate_id"]=="2"){
					
				$sum = $ship[$i]["price_delivery"];
					
			}else if($ship[$i]["cate_id"]=="3"){
					
				$sum = get_vary_amount();
			}else if($ship[$i]["cate_id"]=="4"){
					
				$sum = get_vary_total($ship[$i]["id"]);
					
			}else if($ship[$i]["cate_id"]=="5"){
					
				$sum = get_vary_weigth($ship[$i]["id"]);
			}
		}
		
		return @$sum;
		
	}
	
	
	function getShipDefault($id){
		
		$shipcost = 0;
		
		$sumamount        = getAmountinCart();
		$shipcost_per     = getPriceShip($id);
		
		$shipcost		  = $sumamount + $shipcost_per;
		
		return @$shipcost;		
	}
	
	function getShipPerDefault($id){
		$shipcost = 0;
		
		$shipcost = getPriceShip($id);
		
		return @$shipcost;
	}
	
	
	function checkShowWeight(){
		
		$db = getDBO();
		
		$db->setQuery("SELECT count(*) As chk FROM shipping_information WHERE ship_type = '5' AND status = '1' ");
		$rs = $db->loadAssocList();
		
		return @$rs[0]["chk"];
		
	}
	
	
	function getShipCostAllDefault($id){
	
		$shipcost = 0;
		
		$shipto  = $id;
		 
		$sumamount          = getAmountinCart();
		$shipcost_per       = getPriceShip($shipto);
	
		$shipcosttemp	= $sumamount + $shipcost_per;
		$shipcost		= number_format($shipcosttemp);
	
		return @$shipcost;
	}
	
	
	function getShipCostAll($id){
	
		$shipcost = 0;
	
		$shipto  = $id;
			
		$sumamount          = getAmountinCart();
		$shipcost_per       = getPriceShip($shipto);
	
		$shipcosttemp	= $sumamount + $shipcost_per;
		$shipcost		= $shipcosttemp;
	
		return @$shipcost;
	}
	
	
	function getNameShip($id){
		
		$db = getDBO();
		
		$db->setQuery("SELECT c.cate_name,c.cate_name_en FROM shipping_information i left join shipping_category c ON i.ship_type = c.id WHERE i.status = '1' AND i.id = '".$id."' ORDER by i.id ASC ");
		$ship = $db->loadAssocList();
		
		$subject = (@$_ENV['lang_type']=='th') ? @$ship[0]["cate_name"] : @$ship[0]["cate_name_en"] ;
		
		return @$subject;
	}
	
	
	function getShiptoName($id){
		
		$db = getDBO();
			
		$db->setQuery("SELECT subject,subject_en FROM shipping_information WHERE status = '1' AND id = '".$id."' ORDER by id ASC ");
		$ship = $db->loadAssocList();
		
		return (@$_ENV['lang_type']=='th') ? @$ship[0]["subject"] : @$ship[0]["subject_en"];
	}
	
	function getShiptoDeliTime($id){
		
		$db = getDBO();
			
		$db->setQuery("SELECT ship_time FROM shipping_information WHERE status = '1' AND id = '".$id."' ORDER by id ASC ");
		$ship = $db->loadAssocList();
		
		return @$ship[0]["ship_time"];
		
	}
	
	function getDueDate(){
		
		$db = getDBO();
			
		$db->setQuery("SELECT duedate FROM duedate_information WHERE status = '1' ");
		$ship = $db->loadAssocList();
		
		return @$ship[0]["duedate"];
	}
	
	function generateOrderID(){
		
		$today = date("dm");
		$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
		$unique = $today.$rand;
			
		return @$unique;
	}
	
	function TH2EN($date){
		
		$arr = explode("/", $date);
		
		return @$arr[2]."-".@$arr[1]."-".@$arr[0];
	}
	
	function TH2ENC($date){
	
		$arr = explode("/", $date);
		$year = @$arr[2] - 543;
	
		return $year."-".@$arr[1]."-".@$arr[0];
	}
    
    
function pre_test($rs){
	echo "<pre>";
	print_r($rs);
	echo "</pre>";
}
    
?>
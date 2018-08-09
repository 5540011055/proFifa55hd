<?php
  /* For Utility Funtion Adfd new */
  /*---- By phuwanart k. 27.05.2015 ------*/
    
class funcUtil{
	
	function getLoadMenu(){
		
		@$user  = getLogedInUser();
		$db = getDBO();
	
	    $sqlPriv = (@$user["userclass"]) ? " AND priv_".$user["userclass"]." = 'allow' " : "" ;

	    $db->setQuery("SELECT * FROM _menuadmin WHERE status = '1' AND sort_sub = '0' ".$sqlPriv." ORDER BY sort_main ASC");
	    $res = $db->loadAssocList();	
	    
	    
	    $menu = "";
	    
	    
			    /*################ Count For Alert ################*/

					    $db->setQuery("SELECT count(id) As notread FROM contact_information WHERE status = '0' ");
					    $notRead = $db->loadAssocList();
					    $notRead = $notRead[0];
			    
				    	$db->setQuery("SELECT count(id) As c_regis FROM register_information WHERE status = '0' ");
				    	$Cregis = $db->loadAssocList();
				    	$Cregis = $Cregis[0];
				    	

				    	$db->setQuery("SELECT count(id) As c_review FROM review_information WHERE status = '0' ");
				    	$Creview = $db->loadAssocList();
				    	$Creview = $Creview[0];
				    	
				    	
				    	$db->setQuery("SELECT count(id) As c_order FROM order_information WHERE status_order = '0' OR status_order = '6' ");
				    	$C_order = $db->loadAssocList();
				    	$C_order = $C_order[0];
				    	
				    	
				    	$db->setQuery("SELECT count(id) As c_orderpay FROM order_information WHERE status_order = '1' ");
				    	$C_orderPay = $db->loadAssocList();
				    	$C_orderPay = $C_orderPay[0];
				    	
				    	$db->setQuery("SELECT count(id) As c_orderwait FROM order_information WHERE status_order = '2' ");
				    	$c_orderwait = $db->loadAssocList();
				    	$c_orderwait = $c_orderwait[0];
				    	
				    	
			     /*################################*/

	    
	    for($i=0;$i<count($res);$i++){
	    	
	    	
	    	$active1  = ($res[$i]["controller"]==getParam(1)) ? "active treeview" : "" ;
	    	$ahref    = ($i==0) ? "dashboard" : "" ;
	    	$iconpoint  = ($res[$i]["sort_sub"]==0 && $res[$i]["controller"]!="dashboard") ? "fa fa-angle-left pull-right" : "";
	    
	    	
	    	/*################ Display For Alert ################*/
	    	if($res[$i]["controller"]=="contact_us" && (@$notRead["notread"]>0) ){
	    		$alerts = '<small class="label pull-right bg-red" style="right: 30px;">'.$notRead["notread"].'</small>';
	    			
	    	}else if($res[$i]["controller"]=="register" && (@$Cregis["c_regis"]>0) ){
	    		$alerts = '<small class="label pull-right bg-red" style="right: 30px;">'.$Cregis["c_regis"].'</small>';
	    	
	    	}else if($res[$i]["controller"]=="review" && (@$Creview["c_review"]>0) ){
	    		$alerts = '<small class="label pull-right bg-red" style="right: 30px;">'.$Creview["c_review"].'</small>';
	    	
	    	}else{
	    		$alerts = '';
	    	}
	    	/*################################*/
	    	
	    	
	    	$menu .= '<li class="'.$active1.'" style="font-size: 13px;">
	    			   <a href="'.$ahref.'">
	    			     <i class="'.$res[$i]["icon"].'"></i>
	    			     <span>'.$res[$i]["menuname"].'</span>
	    			     '.@$alerts.'
	    			     <i class="'.$iconpoint.'"></i>
	    			    </a>';
         
	    			$db->setQuery("SELECT * FROM _menuadmin WHERE status = '1' AND sort_main = '".$res[$i]["sort_main"]."' AND sort_sub <> '0' {$sqlPriv} ORDER BY sort_sub ASC");
	    			$res2 = $db->loadAssocList();
	    			
	    			
	    			if($res2){
	    				
	    				$parameter1 = (getParam('1')) ? getParam('1') : "dashboard";
	    				
	    			    $tabHieght	= funcUtil::getMenucontrol($parameter1);
	    			    
	    			    $active_block = ($tabHieght==$res[$i]['controller']) ? "display: block" : "";
	    			
	    			    
	    				$menu.= '<ul class="treeview-menu" style="'.$active_block.'">';   
	    		        
		    				for($j=0;$j<count($res2);$j++){
		    					
		    				
		    					$active2 = ($parameter1==$res2[$j]['parameter']) ? "active" : "";
		    					
		    					if($res2[$j]['parameter']=="order_list" && (@$C_order["c_order"]>0) ){
		    							$menu.= '<li class="'.$active2.'"><a href="'.$res2[$j]["parameter"].'" style="font-size: 13px;" id="menu-'.$res2[$j]["parameter"].'" ><i class="fa fa-circle-o text-aqua"></i></i>'.$res2[$j]["menuname"].'</a><small class="label pull-right bg-red" style=" margin-top: -21px; margin-right: 10px;">'.$C_order["c_order"].'</small></li>';
		    					
		    					}else if($res2[$j]['parameter']=="order_payment" && (@$C_orderPay["c_orderpay"]>0) ){
		    							$menu.= '<li class="'.$active2.'"><a href="'.$res2[$j]["parameter"].'" style="font-size: 13px;" id="menu-'.$res2[$j]["parameter"].'" ><i class="fa fa-circle-o text-aqua"></i></i>'.$res2[$j]["menuname"].'</a><small class="label pull-right bg-primary" style=" margin-top: -21px; margin-right: 10px;">'.$C_orderPay["c_orderpay"].'</small></li>';
		    					
		    					}else if($res2[$j]['parameter']=="order_wait" && (@$c_orderwait["c_orderwait"]>0) ){
		    							$menu.= '<li class="'.$active2.'"><a href="'.$res2[$j]["parameter"].'" style="font-size: 13px;" id="menu-'.$res2[$j]["parameter"].'" ><i class="fa fa-circle-o text-aqua"></i></i>'.$res2[$j]["menuname"].'</a><small class="label pull-right bg-yellow" style=" margin-top: -21px; margin-right: 10px;">'.$c_orderwait["c_orderwait"].'</small></li>';
		    					
		    					}else{
		    							$menu.= '<li class="'.$active2.'"><a href="'.$res2[$j]["parameter"].'" style="font-size: 13px;" id="menu-'.$res2[$j]["parameter"].'" ><i class="fa fa-circle-o text-aqua"></i></i>'.$res2[$j]["menuname"].'</a></li>';
		    					}
		    					
		    					 
		    				}
		    				
		    		    $menu.= '</ul>';
	    			}
	    			
	    	$menu .= '</li>';
	    }
	    
	    echo $menu;
	
	}
	
	
	function getMenuname($control){
       
		$db = getDBO();
		
		
		$db->setQuery("SELECT menuname FROM _menuadmin WHERE  parameter = '".$control."'  LIMIT 1");
		$rs = $db->loadAssocList();
		
		 return @($rs[0]['menuname']) ? $rs[0]['menuname'] : "Dashboard";
	}
	
	
	function getMenucontrol($para){
		 
		$db = getDBO();
	
		$db->setQuery("SELECT controller FROM _menuadmin WHERE  parameter = '".$para."' LIMIT 1 ");
		$rs = $db->loadAssocList();
		
		return @$rs[0]['controller'];
	}
	
	function getMenucontrolName($para){
			
		$db = getDBO();
	
		$db->setQuery("SELECT menuname FROM _menuadmin WHERE  parameter = '".$para."' LIMIT 1 ");
		$rs = $db->loadAssocList();
	
		return @$rs[0]['menuname'];
	}
	
	
	
	
	function page_permission(){
	   
		$db = getDBO();
		@$user  = getLogedInUser();
		
		@$parameters  = getParam('1');
	
		
		if(($parameters!="dashboard") && ($parameters!="") ){
			
			$sqlPriv = " AND priv_".$user["userclass"]." = 'allow' ";
			
			$db->setQuery("SELECT count(id) As permission FROM _menuadmin WHERE  parameter = '".$parameters."' AND status = '1' {$sqlPriv} ");
			$display = $db->loadAssocList();
			
			if(@$display[0]["permission"]){
				$set_permission = true;
			}else{
				$set_permission = false;
			}
				
			
		}else{
			$set_permission = true;
		}
		
		return @$set_permission;
	  
	}
	
	function getBreadcrumb($para){
      
	    $db = getDBO();
		
	    
		$db->setQuery("SELECT menuname  FROM _menuadmin WHERE controller = ( SELECT controller FROM _menuadmin WHERE  parameter = '".$para."' LIMIT 1 ) AND sort_sub = '0' LIMIT 1");
		$rs = $db->loadAssocList();
		
		
		 return @$rs[0]["menuname"];
	}
	
	

	function getSlideMenu(){
		 
		$db = getDBO();
	
		$control = getParam('1');
		
		$db->setQuery("SELECT sort_main FROM _menuadmin WHERE  parameter = '".@$control."'  LIMIT 1");
		$rs = $db->loadAssocList();
	
		if($rs[0]['sort_main']>=10){
			echo '<script>$("#navi").animate({ scrollTop: $("#menu-'.@$control.'").offset().top}, 1500);</script>';
		}
		
		
	}
	
}

function getStatusActive(&$param2) {
    
	if($param2=="0"){
		$param2 = '<span class="label label-warning" style="font-size: 14px;" data-original-title="" title="">รอการอนุมัติ</span>';
    }else if($param2=="1"){
    	$param2 = '<span class="label label-success" style="font-size: 14px;" data-original-title="" title="">อนุมัติลงทะเบียน</span>';
    }else if($param2=="3"){
    	$param2 = '<span class="label label-danger" style="font-size: 14px;" data-original-title="" title="">ไม่ผ่านอนุมัติ</span>';
    }
	
}


function getStatusActive2(&$param2) {

	if($param2=="0"){
		$param2 = '<span class="label label-danger" style="font-size: 14px;">InActive</span>';
	}else if($param2=="1"){
		$param2 = '<span class="label label-success" style="font-size: 14px;">Active</span>';
	}

}


function getStatusContactUs(&$param2) {

	if($param2=="0"){
		$param2 = '<span class="label label-warning" style="font-size: 14px;">Unread</span>';
	}else if($param2=="1"){
		$param2 = '<span class="label label-success" style="font-size: 14px;">Read</span>';
	}

}

function getStatusRegister(&$param) {

	if($param=="0"){
		$param = '<span class="label label-danger" style="font-size: 14px;">'.lang('t-pending','t-pending').'</span>';
	}else if($param=="1"){
		$param = '<span class="label label-success" style="font-size: 14px;">'.lang('t-approve','t-approve').'</span>';
	}

}



function getStatusActive3(&$param2) {

	if($param2=="0"){
		$param2 = '<span class="label label-danger" style="font-size: 14px;">InActive</span>';
	}else if($param2=="1"){
		$param2 = '<span class="label label-success" style="font-size: 14px;">Active</span>';
	}

}


function getAllowMenu(&$para) {

	$db = getDBO();
	$feild = "priv_".$para;
	
	$db->setQuery("SELECT count(id) As chk_allow FROM _menuadmin WHERE {$feild} = 'allow' AND controller <> 'dashboard' ");
	$rs = $db->loadAssocList();
	
	if(@$rs[0]["chk_allow"] == 0){
		$para = '<span class="label label-danger" style="font-size: 14px;">Disallowed</span>';
	}else{
		$para = '<span class="label label-success" style="font-size: 14px; width:95px; padding: 3px 18px;">Allowed</span>';
	}

}


function getProfile(&$img){
	
	$img = ($img) ? '<div class="img-zoom" data-original-title="" title=""><img src="../'.$img.'" width="40" height="40" data-pin-nopin="true"></div>' : '<img src="'.base_url().'images/nopic-personal.jpg" width="40" height="45" title="ไม่มีภาพประจำหัวข้อ">';
	
}

function getStatusRecomend(&$data) {

	@$data   = explode("_", $data);
	
	@$id     = @$data[1];
	@$data   = @$data[0];
	
	@$data = '<input type="checkbox" id="slider'.$id.'" value="0" '.(@$data== 1 ?  'checked': '').' data-toggle="toggle" data-size="mini"  data-on="Enabled" data-off="Disabled" data-style="ios"  data-onstyle="success3">';
	
	@$data .= '<script>
  				$(function() {
    				$("#slider'.$id.'").change(function() {
    					changedRecommended("'.$id.'", $(this).prop(\'checked\'));	
    				})
  				})
			 </script>
            ';
	
	// changedRecommended("'.$id.'", ui.value);
	
}



function getStatusStock(&$data) {

	@$data   = explode("_", $data);

	@$id     = @$data[1];
	@$data   = @$data[0];

	@$data = '<input type="checkbox" id="sliders'.$id.'" value="0" '.(@$data== 1 ?  'checked': '').' data-toggle="toggle" data-size="mini"  data-on="มีสินค้า" data-off="สินค้าหมด" data-style="ios"  data-onstyle="success3" data-offstyle="danger">';

	@$data .= '<script>
  				$(function() {
    				$("#sliders'.$id.'").change(function() {
    					changedStock("'.$id.'", $(this).prop(\'checked\'));
    				})
  				})
			 </script>
            ';

	// changedRecommended("'.$id.'", ui.value);

}

function chEnDate2($dat){
	$arr = explode("-",$dat);
	$dd = $arr[2];
	$mm = $arr[1];
	$yy = $arr[0] + 543;

	return $dd."/".$mm."/".$yy;
}


function ChangeTH2En($dat){
	$arr = explode("/",$dat);
	$dd = $arr[0];
	$mm = $arr[1];
	$yy = $arr[2];

	return $yy."-".$mm."-".$dd;
}


function ChangeEN2TH($dat){
	
	
	$arr = explode("-",$dat);
	$dd = $arr[2];
	$mm = $arr[1];
	$yy = $arr[0];

	return $dd."/".$mm."/".$yy;
}

function getNamecharset($charset){
	
	$text = $charset;
	
	if($charset=="utf-"){
		$text = "utf-8";
	}else if($charset=="tis-"){
		$text = "tis-620";
	}
	
	return $text;
	
}


function getNamecharsetRS($charset){

	$text = $charset;

	if($charset=="utf-8"){
		$text = "utf-";
	}else if($charset=="tis-620"){
		$text = "tis-";
	}

	return $text;

}



function getUserUpdateBy($para){
	
	$db = getDBO();
	$db->setQuery("SELECT fullname FROM users WHERE id = '".$para."' ");
	$rs = $db->loadAssocList();
	$rs = $rs[0];
	 
	return ($rs) ? $rs["fullname"] : "" ;
}


function getCatereward(&$param){
	$db = getDBO();
	$db->setQuery(" SELECT category_name FROM rewards_category WHERE id = '".$param."' ");
	$type = $db->loadAssocList();
	
	$param = $type[0]["category_name"];
	
}


function getLangImg($lang){
	
	if($lang=="en"){
		$set_lang = '<img src="images/en2.png" width="20" height="15" >';
	}else{
		$set_lang = '<img src="images/th2.png" width="20" height="15" >';
	}
	
	return $set_lang;
	
}

function getScoreReviewDetail($param){

	$img = "";
	$len = $param;

	for($i=0;$i<$len;$i++){
		$img .= ' <img src="img/stars.png" >';
	}

	$param = $img;
	
	return @$param;

}

function getProductName($id){
	$db = getDBO();

	$db->setQuery("SELECT subject FROM product_information WHERE id = '".$id."' ");
	$rs = $db->loadAssocList();

	$product = $rs[0]['subject'];

	return @$product;
}


function setStatusOrderUpdate(){
	
	$db = getDBO();
	
	$db->setQuery("SELECT id,duedate FROM order_information  WHERE status = '1' AND status_order = '0' ");
	$order_wait = $db->loadAssocList();
	
	$timeFirst  = strtotime(Date("Y-m-d H:i:s"));
	
		for($i=0;$i<count($order_wait);$i++){
			
			$timeSecond = strtotime($order_wait[$i]["duedate"]);
			$differenceInSeconds = $timeSecond - $timeFirst;
			
			
		if($differenceInSeconds < 0 ){
				$db->setQuery("UPDATE order_information SET status_order = '4' WHERE id = '".$order_wait[$i]["id"]."' ");
				$db->Query();
			} 
		}

		
}


function duration($begin,$end){
	$remain=intval(strtotime($end)-strtotime($begin));
	$wan=floor($remain/86400);
	$l_wan=$remain%86400;
	$hour=floor($l_wan/3600);
	$l_hour=$l_wan%3600;
	$minute=floor($l_hour/60);
	$second=$l_hour%60;
	
	$txt = ($wan==0) ? "วันนี้" : $wan." วันที่ผ่านมา " ;
	
	return $txt;
}


function getShiptoName($id){

	$db = getDBO();
		
	$db->setQuery("SELECT subject FROM shipping_information WHERE status = '1' AND id = '".$id."' ORDER by id ASC ");
	$ship = $db->loadAssocList();

	return @$ship[0]["subject"];
}

function getShiptoDeliTime($id){

	$db = getDBO();
		
	$db->setQuery("SELECT ship_time FROM shipping_information WHERE status = '1' AND id = '".$id."' ORDER by id ASC ");
	$ship = $db->loadAssocList();

	return @$ship[0]["ship_time"];

}


function getShipPerDefault($id){
	$shipcost = 0;

	$shipcost = getPriceShip($id);

	return @$shipcost;
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


function getImageProduct($id,$img_w,$img_h){

	$db = getDBO();

	$db->setQuery("SELECT display_image FROM product_information WHERE id = '".$id."' ");
	$rs = $db->loadAssocList();

	$image = getImageRatio("../".$rs[0]['display_image'],$img_w, $img_h);

	return @$image;
}


function totalprice2($param){

	$db = getDBO();

	$order_id = $param;

	$db->setQuery("SELECT SUM(price) As total_p FROM order_description WHERE status = '1' AND order_id = '".$order_id."' ");
	$rs = $db->loadAssocList();


	$db->setQuery("SELECT SUM(shipping_cost) As ship_cost FROM order_information WHERE status = '1' AND id = '".$order_id."' ");
	$rs2 = $db->loadAssocList();

	$price = $rs[0]["total_p"] + $rs2[0]["ship_cost"];

	$param = number_format($price);
	
	return  $param;

}


function get_num_format2($param) {

	$res = $param;

	if($res>0){
		$res = number_format(floatval($res));
	}else{
		$res = "";
	}
	
	return $res;

}


function getBankTranfer($param){

	$db = getDBO();

	$db->setQuery("SELECT i.account_number,i.subject,i.branch,c.cate_name FROM bank_information i LEFT JOIN bank_category c ON i.cid = c. id  WHERE i.id = '".$param."' ");
	$rs = $db->loadAssocList();
	$cate_name = $rs[0]["cate_name"];

	$res = $cate_name.'<br>'.$rs[0]["account_number"]."<br>".$rs[0]["subject"]."<br>สาขา ".$rs[0]["branch"];
	
	return $res;
}


function getTranferImg($para){
	
 	$img = '<a href="javascript:void(0);" onclick="getshowIMG(\'../'.$para.'\')"><img src="../'.$para.'" width="80" height="80" data-pin-nopin="true"></a>';
	
	return $img;
}



/* ############## Function For admin ############### */

function getImgTopic(&$img) {
	$img = ($img) ? '<div class="img-zoom" data-original-title="" title=""><img src="../'.$img.'" width="40" height="40" data-pin-nopin="true"></div>' : '<img src="'.base_url().'images/noPhoto-icon.png" width="40" height="40" title="ไม่มีภาพประจำหัวข้อ">';
}


function escape_str($str){

	$rs = str_replace("'","\'",$str);

	return $rs;
}

function  change_subject(&$data) {
	
	
	$exp = explode("__",$data);
	
	$id    = $exp[0];
	$table = $exp[1];

	$db = getDBO ();
	$query = "SELECT subject,subject_en FROM {$table} WHERE id = '{$id}' LIMIT 1 ";

	$db->setQuery ($query);
	$frm = $db->loadAssocList();
	$frm = $frm [0];

	if ($frm ['subject'] && $frm ['subject_en']) {
		$data = "<img src='images/th1.png' width='16' height='12'>&nbsp;" . $frm['subject']."<br>"."<img src='images/en1.png' width='16' height='12'>&nbsp;" .$frm ['subject_en'] . "";
			
	}else if ($frm ['subject']) {
		$data = $frm ['subject'];

	}else if ($frm ['subject_en']) {
		$data = $frm ['subject_en'];

	}
}

function getusersClassName($param){
	$db = getDBO();
	$db->setQuery("SELECT class_name FROM users_class WHERE class_value = '{$param}' ");
	$frm = $db->loadAssocList();

	return @$frm[0]["class_name"];
}


function  change_cate_name(&$data) {


	$exp = explode("__",$data);

	$id    = $exp[0];
	$table = $exp[1];

	$db = getDBO ();
	$query = "SELECT cate_name,cate_name_en FROM {$table} WHERE id = '{$id}' LIMIT 1 ";

	$db->setQuery ($query);
	$frm = $db->loadAssocList();
	$frm = $frm [0];

	if ($frm ['cate_name'] && $frm ['cate_name_en']) {
		$data = "<img src='images/th1.png' width='16' height='12'>&nbsp;" . $frm['cate_name']."<br>"."<img src='images/en1.png' width='16' height='12'>&nbsp;" .$frm ['cate_name_en'] . "";
			
	}else if ($frm ['cate_name']) {
		$data = $frm ['cate_name'];

	}else if ($frm ['cate_name_en']) {
		$data = $frm ['cate_name_en'];

	}
}


function getCateName(&$cate){
	
	$exp = explode("__",$cate);
	
	$cid     = $exp[0];
	$table  =  $exp[1];
	
	
	$db = getDBO();
	$db->setQuery("SELECT cate_name FROM {$table} WHERE id = '{$cid}' LIMIT 1 ");
	$frm = $db->loadAssocList();
	$frm = $frm [0];
	
	$cate = $frm["cate_name"];
}


function getVdoSource(&$para){
	$para = (@$para=="1") ? '<font color="#dd4b39">Youtube</font>' : '<font color="#4CAF50">Upload Video</font>';
}

function setSeqCircle(&$para){
	$para = '<div class="numberCircle">'.$para.'</div>';
}

function getusersClass(&$param){
	$db = getDBO();
	$db->setQuery("SELECT class_name FROM users_class WHERE class_value = '{$param}' ");
	$frm = $db->loadAssocList();
	
	$param = @$frm[0]["class_name"];
}

function getusersPriv(&$param){
	$db = getDBO();
	$db->setQuery("SELECT priv_name FROM users_priv WHERE priv_value = '{$param}' ");
	$frm = $db->loadAssocList();

	$param = @$frm[0]["priv_name"];
}

function getScoreReview(&$param){
	
	$img = "";
	$len = $param;
	
	for($i=0;$i<$len;$i++){
		$img .= ' <img src="img/stars.png" >';
	}
	
	$param = $img;
	
}


function get_num_format(&$param) {
	
	$res = $param;
	
	if($res>0){
		$param = number_format(floatval($res));
	}else{
		$param = "";
	}		
	
}

function totalprice(&$param){
	
	$db = getDBO();
	
	$order_id = $param;
	
	$db->setQuery("SELECT SUM(price) As total_p FROM order_description WHERE status = '1' AND order_id = '".$order_id."' ");
	$rs = $db->loadAssocList();
	
	
	$db->setQuery("SELECT SUM(shipping_cost) As ship_cost FROM order_information WHERE status = '1' AND id = '".$order_id."' ");
	$rs2 = $db->loadAssocList();
	
	$price = $rs[0]["total_p"] + $rs2[0]["ship_cost"];
	
	$param = number_format($price);
	
} 

function getOrder(&$param){
	
	$db = getDBO();
	
	$order_id = $param;
	
	$db->setQuery("SELECT order_id,product,qty FROM order_description WHERE status = '1' AND order_id = '".$order_id."' ");
	$rs = $db->loadAssocList();
	
	$param = '<ul style="padding-left: 5px;">';
	
	for($i=0;$i<count($rs);$i++){
		
		$ord = $rs[$i]["product"];
		$param .= '<li style="list-style: none;">'.getProductName(@$rs[$i]["product"]).'&nbsp;&nbsp;(<font style="font-size: 15px;color: #78858a;"><b>x '.$rs[$i]["qty"].'</b></font> ชิ้น)</li>';
	}
	
	$param .= '</ul>';
	
}

function getStatusOrder(&$param){
	
	
	$arr = explode("__",$param);
	$status = $arr[0];
	
	// $param;
	
	if($status=="0" || $status=="6"){
		$param = '<a class="btn btn-danger btn-xs" style="cursor: auto;"><b>รอชำระเงิน</b></a><div style="margin-top: 6px;">กำหนดชำระเงิน</div><div style="color:#E91E63;">'.shortThDateYearlongY(@$arr[1]).'</div>';
		
	}else if($status=="1"){
		$param = '<a class="btn  btn-primary btn-xs" style="cursor: auto;"><b>ชำระเงินแล้ว</b></a>';
	
	}else if($status=="2"){
		$param = '<a class="btn  btn-warning btn-xs" style="cursor: auto;"><b>รอจัดส่งสินค้า</b></a>';
		
	}else if($status=="3"){
		$param = '<a class="btn  btn-success btn-xs" style="cursor: auto;"><b>ส่งสินค้าแล้ว</b></a>';
		
	}else if($status=="4"){
		$param = '<a class="btn btn-xs" style="cursor: auto;color: #FFF;background-color: #9E9E9E;"><b>เกินกำหนดชำระ</b></a>';
		
	}else if($status=="5"){
		$param = '<a class="btn btn-xs" style="cursor: auto;color: #FFF;background-color: #001f3f;"><b>ยกเลิกการสั่งซื้อ</b></a>';
	}
	
	
}


function getStatusOrder2($param){


	$arr = explode("__",$param);
	$status = $arr[0];

	// $param;

	if($status=="0" || $status=="6"){
		$param = '<a class="btn btn-danger btn-xs" style="cursor: auto;"><b>รอชำระเงิน</b></a>';

	}else if($status=="1"){
		$param = '<a class="btn  btn-primary btn-xs" style="cursor: auto;"><b>ชำระเงินแล้ว</b></a>';

	}else if($status=="2"){
		$param = '<a class="btn  btn-warning btn-xs" style="cursor: auto;"><b>รอจัดส่งสินค้า</b></a>';

	}else if($status=="3"){
		$param = '<a class="btn  btn-success btn-xs" style="cursor: auto;"><b>จัดส่งสินค้าแล้ว</b></a>';

	}else if($status=="4"){
		$param = '<a class="btn btn-xs" style="cursor: auto;color: #FFF;background-color: #9E9E9E;"><b>เกินกำหนดชำระ</b></a>';

	}else if($status=="5"){
		$param = '<a class="btn btn-xs" style="cursor: auto;color: #FFF;background-color: #001f3f;"><b>ลูกค้ายกเลิก</b></a>';
	}


	return $param;
}


function getLogoBank(&$param){
	
	$db = getDBO();
	
	$db->setQuery("SELECT i.account_number,c.display_image FROM bank_information i LEFT JOIN bank_category c ON i.cid = c. id  WHERE i.id = '".$param."' ");
	$rs = $db->loadAssocList();
	$dispaly_image = $rs[0]["display_image"];
	
	$param = '<img src="../'.$dispaly_image.'" width="40" height="40" data-pin-nopin="true"><br><b>'.$rs[0]["account_number"]."</b>";
}


function getShiptoNameList(&$param){

	$db = getDBO();

	$db->setQuery("SELECT subject FROM shipping_information WHERE status = '1' AND id = '".$param."' ORDER by id ASC ");
	$ship = $db->loadAssocList();

	$param = @$ship[0]["subject"];
}

function getShiptoDeliTimeList(&$param){

	$db = getDBO();

	$db->setQuery("SELECT ship_time FROM shipping_information WHERE status = '1' AND id = '".$param."' ORDER by id ASC ");
	$ship = $db->loadAssocList();

	$param = @$ship[0]["ship_time"];

}


function getAddrList(&$param){
	
	$db = getDBO();
	
	   $db->setQuery("SELECT * FROM order_information WHERE id ='{$param}' ");
        $rs = $db->loadAssocList();
        $frm = @$rs[0];
        
        $param = $frm["address"]."&nbsp; ตำบล".getSubDistrictName($frm["subdistrict"])."&nbsp; <br>อำเภอ ".getDistrictName($frm["district"])."&nbsp; จังหวัด ".getProvinceName($frm["province"])."&nbsp; ".$frm["zipcode"];

}



/* Function For admin */

function pre_test($param) {
  echo "<pre>";
    print_r($param);
  echo "</pre>";
}



    
?>
<?php 
function utf8_substr($str,$start_p,$len_p) 
{ 
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
 	$ret =  preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start_p.'}'.
  '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len_p.'}).*#s',
  '$1' , $str );
  if(strlen($str) > $len_p){
  	$ret .= "...";
  }
  return $ret;
};
// การใช้งาน
// $start_p คือตำแหน่งเริ่มต้นตัดข้อความ
// $len_p คือจำนวนตัวอักษรที่ต้องการแสดง
// $data="ข้อความทดสอบ ข้อความทดสอบ ข้อความทดสอบ ข้อความทดสอบข้อความทดสอบ ";
// echo substr_utf8($data,0,30);
// การใช้งาน
// $start_p คือตำแหน่งเริ่มต้นตัดข้อความ
// $len_p คือจำนวนตัวอักษรที่ต้องการแสดง
//$data="ข้อความทดสอบ ข้อความทดสอบ ข้อความทดสอบ ข้อความทดสอบข้อความทดสอบ ";
//echo utf8_substr($data,0,30);

?>
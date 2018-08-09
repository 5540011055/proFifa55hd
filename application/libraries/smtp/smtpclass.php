<?php
require("class.phpmailer.php");
function smtpmail( $email , $subject , $body )
{
    $mail = new PHPMailer();
	if(JaConfig::_("SendMailWithSMTP")=="true"){
    	$mail->IsSMTP();  
	}else{
		$mail->IsMail();  
	}
	//$mail->SMTPDebug=true;
	$mail->SMTPSecure=JaConfig::_("SMTPSecure");
	$mail->Port=JaConfig::_("SMTPPort");
	
    $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้                         
    $mail->Host     = JaConfig::_("SMTPHost"); //  mail server ของเรา
	if(JaConfig::_("SMTPAuth")=="true"){
		$mail->SMTPAuth = true;     //  เลือกการใช้งานส่งเมล์ แบบ SMTP
		$mail->Username = JaConfig::_("SMTPUsername");   //  account e-mail ของเราที่ต้องการจะส่ง
		$mail->Password = JaConfig::_("SMTPPassword");  //  รหัสผ่าน e-mail ของเราที่ต้องการจะส่ง
	}
    $mail->From     = JaConfig::_("SMTPFromEmail");  //  account e-mail ของเราที่ต้องการจะส่ง
    $mail->FromName = JaConfig::_("SMTPFromName"); //  ชื่อที่แสดง เมื่อผู้รับได้รับเมล์ของเรา
    $mail->AddAddress($email);            // Email ปลายทางที่เราต้องการส่ง
    $mail->IsHTML(true);                  // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
    $mail->Subject     =  $subject;        // หัวข้อที่จะส่ง
    $mail->Body     = $body;                   // ข้อความ ที่จะส่ง
     $result = $mail->send();        
     return $result;
}
?>
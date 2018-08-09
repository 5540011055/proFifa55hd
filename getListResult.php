<?php
date_default_timezone_set('Asia/Bangkok');
error_reporting(0);
require_once 'simple_html_dom.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT);
curl_setopt($ch, CURLOPT_CAINFO, $PATH."cacert.pem");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $COOKIEFILE);
curl_setopt($ch, CURLOPT_COOKIEFILE, $COOKIEFILE);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 120);
curl_setopt($ch, CURLOPT_URL, 'http://www.warpdoball.com/');
$data = curl_exec($ch);
$html = str_get_html($data);
$div = $html->find('div#warpdoball',0);
if (!(empty($div))) {
		echo $div1 = $html->find('div[class="container my-3"]',0);
	 $div2 = $html->find('div[class="container-fluid pb-5 mt-3"]',0);
	 if (!(empty($div2))) {
	 	echo $div2;
	 }
	 $div3 = $html->find('div[class="container-fluid px-2 px-md-3 pb-3 mt-3"]',0);
	 if (!(empty($div3))) {
	 	//echo $div3;
	 	//$div4 = $div3->find('div',0);
	 	//echo $div4;
	 	echo str_replace("Warpdoball.com",$site_name,$div3);
	 }
}
?>
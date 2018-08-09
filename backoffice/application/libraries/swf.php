<?php
class swfobject{
	function v9($swf,$w,$h,$transparent=false,$FlashVars=false)
	{
		$src = str_replace(".swf","",$swf);
		$html  = "<script type=\"text/javascript\">\n";
		$html .= "AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','$w','height','$h',";
		if($transparent==true){
			$html .= "'wmode','transparent',";
		}		
		if($FlashVars <> false){
			$html .= "'FlashVars','$FlashVars',";
		}
		$html .= "'src','$src','quality','high','pluginspage',";
		$html .= "'http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','$src' );\n";
		$html .= "</script>\n";
		$html .= "<noscript>\n";
		$html .= "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" ";
		$html .= "codebase=\"http//download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0\" width=\"$w\" height=\"$h\">";
		$html .= " <param name=\"movie\" value=\"$swf\" />";
		$html .= "<param name=\"quality\" value=\"high\" />";
		if($transparent==true){
			$html .= "<param name=\"wmode\" value=\"transparent\" />";
		}
		if($FlashVars <> false){
			$html .= "<param name=\"FlashVars\" value=\"$FlashVars\" />";
		}
		$html .= "<embed src=\"$swf\" quality=\"high\" ";
		$html .= "pluginspage=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\" ";
		$html .= "type=\"application/x-shockwave-flash\" width=\"$w\" height=\"$h\" ";
		if($transparent==true){
			$html .= "wmode=\"transparent\" ";
		}
		if($FlashVars <> false){
			$html .= "FlashVars=\"$FlashVars\" ";
		}
		$html .= "></embed>";
		$html .= "</object>";
		$html .= "</noscript>";
		print($html);
	}
}
?>
<?php
class youtube{
	public static function getDisplay($youtubeURL)
	{
		$youtubeID = youtube::getYoutubeID($youtubeURL);
		$img = "http://i3.ytimg.com/vi/".$youtubeID."/0.jpg";
		return $img;
	}
	public static function getYoutubeID($youtubeURL)
	{
		//http://www.youtube.com/watch?v=61RLo-bnWX8&feature=popular
		$query = split("\?",$youtubeURL);
		if(count($query) <> 2){
			return "";	
		}
		$variable = split("&",$query[1]);
		if(count($variable)){
			foreach($variable as $q)
			{
				$get = split("=",$q);
				if($get[0]=="v"){
					return	$get[1];
				}
			}
		}
		return "";	
	}
	public static function getYoutubeName($youtubeURL)
	{
		$handle = fopen($youtubeURL, "rb");
		$contents = stream_get_contents($handle);
		fclose($handle);
		$page = ereg_replace(".*<title>", "", $contents); //extract data
		$page = ereg_replace("</title>.*", "", $page); //extract data
		$page = str_replace(array("\r","\n","\t","YouTube-"),"",$page);
		$page = trim($page);
		return $page;
	}
	public static function getEmbedCode($youtubeURL,$width=640,$height=385,$allowfullscreen=true)
	{
		$youtubeID = youtube::getYoutubeID($youtubeURL);
		$allowfullscreen = ($allowfullscreen==true)?"true":"false";
		$embed = '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$youtubeID.'?fs=1&amp;hl=en_US"></param><param name="allowFullScreen" value="'.$allowfullscreen.'"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$youtubeID.'?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="'.$allowfullscreen.'" width="'.$width.'" height="'.$height.'"></embed></object>';
		return $embed;
	}
}
?>
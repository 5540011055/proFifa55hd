<?php
/**
* @param String $file Image source path
* @param Int $width Maximun width
* @param Int $height Maximun height
* @return String Image controller's URL path
*/

class ImageUtil {
}
function getImageRatio($file, $width, $height, $defaultImage = "images/default.jpg") {
	

	
	
	$fileInfo = pathinfo ( $file );
	if(@$fileInfo ['extension']){
		$extension = $fileInfo ['extension'];
	
		$tmpFile = './tmp/' . md5 ( $file . 'ratio' . $width . $height ) . '.' . $extension;
	
		if (file_exists ( $tmpFile )) {
			return $tmpFile;
		} else {
			return base_url () . "image/ratio/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}";
		}
	}else{
		return base_url () . "image/ratio/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}";
	}
}

$_tempDir = './tmp/';

function getImageCrop($file, $width, $height, $percen = 10, $ratio=array(16,9), $defaultImage  = "images/default.jpg", $type) {
	/* ddd ffff*/
	if($height=='' OR $height==NULL){
		$height  = $width*($ratio[1]/$ratio[0]);
	}
	if($width=='' OR $width==NULL){
		$width   = $height*($ratio[0]/$ratio[1]);
	}

	$fileInfo = pathinfo($file);

	if (@$fileInfo ['extension']) {
		$extension = strtolower($fileInfo ['extension']);


		$tmpFile = './tmp/' . md5($file . 'crop' . $width . $height. $percen) . '.' . $extension;
		if (file_exists($tmpFile)) {
			return $tmpFile;
		} else {
			return base_url() . "image/crop/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}&type={$type}&percen={$percen}";
		}
	} else {
		return base_url() . "image/crop/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}&type={$type}&percen={$percen}";
	}
}


function getImageCropDetail($file, $width, $height, $defaultImage = "images/nopic.jpg", $type) {
	$fileInfo = pathinfo ( $file );
	if(@$fileInfo ['extension']){
		$extension = $fileInfo ['extension'];
	
		$tmpFile = './tmp/' . md5 ( $file . 'crop_detail' . $width . $height ) . '.' . $extension;
		if (file_exists ( $tmpFile )) {
			return $tmpFile;
		} else {
			return base_url () . "image/crop_detail/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}&type={$type}";
		}
	}else{
			return base_url () . "image/crop_detail/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}&type={$type}";
	}
}
function getImageCropAndResize($file, $width, $height, $defaultImage = "images/nopic.jpg", $type) {
	$fileInfo = pathinfo ( $file );
	if(@$fileInfo ['extension']){
		$extension = $fileInfo ['extension'];
		$tmpFile = './tmp/' . md5 ( $file . 'cropandresize' . $width . $height ) . '.' . $extension;
		if (file_exists ( $tmpFile )) {
			return $tmpFile;
		} else {	
			return base_url () . "image/cropAndResize/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}&type={$type}";
		}
	}else{
			return base_url () . "image/cropAndResize/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}&type={$type}";
	}
}
function getImageDisplay($file, $width, $height, $defaultImage = "images/nopic.jpg", $pointx, $pointy, $originalwidth = 0, $originalheight = 0) {
	$fileInfo = pathinfo ( $file );

	if(@$fileInfo ['extension']){	
	
		$extension = $fileInfo ['extension'];

		if($pointy==0){
    		$pointy = 0;
    	}
    	if($pointx==0){
    		$pointx = 0;
    	}

	
		$tmpFile = './tmp/' . md5 ( $file . 'display' . $width . $height . $pointx . $pointy ) . '.' . $extension;
		if (file_exists ( $tmpFile )) {
			return $tmpFile;
		} else {
			return base_url () . "image/displayimage/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}&pointx={$pointx}&pointy={$pointy}&originalwidth={$originalwidth}&originalheight={$originalheight}";
		}
	}else{
		return base_url () . "image/displayimage/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}&pointx={$pointx}&pointy={$pointy}&originalwidth={$originalwidth}&originalheight={$originalheight}";
	}
}
function getImageRatioFix($file, $width, $height, $defaultImage = "images/nopic.jpg") {
	return base_url () . "image/ratiofix/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}";
}
function getImageFix($file, $width, $height, $defaultImage = "imnages/nopic.jpg") {
	return base_url () . "image/fix/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}";
}
function getImageWatermask($file, $width, $height, $defaultImage = "imnages/nopic.jpg") {
	return base_url () . "image/watermask/?file={$file}&width={$width}&height={$height}&defaultImage={$defaultImage}";
}
function getImageOriginal($file) {
	return base_url () . "image/orginal/?file={$file}";
}

?>

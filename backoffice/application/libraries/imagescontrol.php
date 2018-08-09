<?php

    class Image{
        public static $defaultUserImage         = "images/user_default.png";
        public static $defaultImage             = "images/nopic.jpg";
        public static $defaultFileIconDir       = "images/fileicons_16/";
    }

    function showRatioThumbnail($imagepath,$width,$height,$default="images/nopic.jpg")
    {
                    $url = site::$fullurl . "images.php?style=ratio&max_w={$width}&max_h={$height}&src={$imagepath}";
                    if($default <> ""){
                            $url .= "&defaultpath={$default}";	
                    }
                    return $url;
    }
    function showRatioThumbnailWithoutWaterMask($imagepath,$width,$height,$default="images/nopic.jpg")
    {
                    $url = site::$fullurl . "images.php?style=ratio_without_watermask&max_w={$width}&max_h={$height}&src={$imagepath}";
                    if($default <> ""){
                            $url .= "&defaultpath={$default}";	
                    }
                    return $url;
    }
    function showCropThumbnail($imagepath,$width,$height,$default="images/nopic.jpg")
    {
                    $url = site::$fullurl . "images.php?style=cropImage&max_w={$width}&max_h={$height}&src={$imagepath}";
                    if($default <> ""){
                            $url .= "&defaultpath={$default}";	
                    }
                    return $url;
    }
    function showFixThumbnail($imagepath,$width,$height,$default="images/nopic.jpg")
    {
                    $url = site::$fullurl . "images.php?style=fix&max_w={$width}&max_h={$height}&src={$imagepath}";
                    if($default <> ""){
                            $url .= "&defaultpath={$default}";	
                    }
                    return $url;
    }
    function showFullSite($imagepath,$default="images/nopic.jpg"){
            $url = site::$fullurl . "images.php?style=ratio&max_w=800&max_h=800&src={$imagepath}";
                    if($default <> ""){
                            $url .= "&defaultpath={$default}";	
                    }
                    return $url;
    }
    
    
?>
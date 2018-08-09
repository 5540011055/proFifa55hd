<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    $config['config-fake-@-file-userConfig.php']         = null;
    
    
    class Database{
        public static $host     = "localhost";
        public static $user     = "root";
        public static $pass     = "";
       
        public static $port             = 3306;
        public static $dbName           = "fifa55hd_db";
        public static $prefix           = "";
        
    }
    
    class Site{
        public static $local_id         = 1 ;
        public static $priv             = 'fifa55hd';
        public static $domainName 		= null;	
        public static $fullURL			= null;	
        public static $fullAdminURL     = null;
        public static $fullPath         = null;	   
        public static $fullAdminPath    = null; 
        
        public static $newIcon          = 30; // ตั้งค่าแสดงรูป News
        public static $webMain          = "http://www.fifa55hd.com";
        
    }
    class Object{}
    Database::$prefix           = '_'. Site::$priv.''.Database::$prefix .'_';
    

    /* Set For Multi Language */
    if(@$_SESSION['user']['lang']=='en'){
    	$_ENV['lang_type'] = 'en';
    	$_ENV['lang_img'] = 'eng';
    }else{
    	$_ENV['lang_type'] = 'th';
    	$_ENV['lang_img'] = 'thai';
    }
    
    /* Set For display Grid List */
    if(@$_SESSION['display_grid']=="list_view"){
    	$_ENV['display_grid'] = 't-text-list';
    	$_ENV['display_grid_active'] = '';
    	$_ENV['display_list_active'] = 'active';
    	$_ENV['display_thumb'] = '';
    }else{
    	$_ENV['display_grid'] 		 = 't-text';
    	$_ENV['display_grid_active'] = 'active';
    	$_ENV['display_list_active'] = '';
    	$_ENV['display_thumb'] = 'thumbview';
    }
    
?>

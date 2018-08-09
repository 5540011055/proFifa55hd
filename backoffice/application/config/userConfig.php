<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    define('SYSTEM_FOOTER',             'footer');
    define('SYSTEM_TITLE',              'title');
    
    require_once '../application/config/userConfig.php';

    /*
     *  Menu Icon (Left menu)
     */
    $_ENV['user-config']['showMenuIcon']        = false;
    define('SESSION_USER_ID',       'system-login-id'.Site::$priv.Site::$local_id);
    define('SESSION_LOGIN',         'system-login'.Site::$priv.Site::$local_id);
    define('SESSION_LOGIN_SID',     'system-login-sid'.Site::$priv.Site::$local_id);
?>
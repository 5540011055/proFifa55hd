<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoadURL extends CI_Controller {
    
    public function index(){
        exit( file_get_contents($_REQUEST['url']) );
    }
    
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Close_popup extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->helper('url'); 
    }    

    public function index(){
    	$this->toclose();
    }
   
    public function toclose(){
    	$_SESSION['user']['popup'] = "close";
    }
    
  
}
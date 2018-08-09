<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public static $_CMD             = "dashboard";
    public static $_NAME            = "Dash board";
    public static $_TABLE           = Array();
    public $data                = Array(
        '_CMD'              => 'Dashboard',
        'body'              => '',
        'menuName'          => 'ข้อมูลทั่วไประบบ'
    );
    
    public function __construct() {        
        parent::__construct();
        $this->load->helper('url');
    }
    private function loadView($view=null, $viewData=Array()){
        if($view!=null){
            if(!@$viewData['data']){$viewData['data']=$this->data;}
            ob_start();
            $this->load->view($view, $viewData);  
            $subView            = ob_get_clean();
            $this->data['body'] = $subView;
        }
        $this->load->view('view_main', $this->data);  
    }
    
    public function index(){
        $this->loadView('dashboard/showlist', $this->data);  
    }
    
    
        
}
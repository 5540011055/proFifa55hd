<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Livescore extends CI_Controller {
    /**
     *
     * @var Array All Available tables 
     */
    public $_TABLE              = Array(
        'info'              => 'howtoplay_information',
        'file'              => 'howtoplay_attactments',
        'category'          => 'howtoplay_category'
    );
    public $data                = Array(
        '_CMD'              => 'livescore',
        'body'              => '',
        'menuName'          => ''
    );
    public $maxRows             = 1;
    public $otherRows           = 5;
    public $avialableTag        = '<p><a><img><span><div><table><tbody><tr><td><th><ul><li><qoute><font><ol><style><strong><em><u><i><h4><h5><h6>'; 
    /*
     * Predined methods
     */
    public function __construct() {
        parent::__construct(); 
        $this->load->helper('url'); 
       
        $this->lang->load($_ENV['lang_type']);
        setPicContent($this->lang->line("livescore"));
    }    
    private function loadView($view=null, $viewData=Array()){
        if($view!=null){
            if(!@$viewData['data']){$viewData['data']=$this->data;}
            ob_start();
            $this->load->view($view, $viewData);  
            $subView            = ob_get_clean();
            $this->data['body'] = $subView;
        }
        $this->load->view($view, $this->data);  
    }
    private function getView($view=null, $viewData=Array()){
        ob_start();
        $this->load->view($view, $viewData);  
        return ob_get_clean();
    }
    public function index(){
        $this->showList();
    }
    public function download(){
        $this->updateFileHit(request('id'));
        download(request('file'), request('name'));        
        exit();
    }
    public function updateFileHit($id){
        $db             = getDBO();
        $db->setQuery("UPDATE {$this->_TABLE['file']} SET hits=hits+1 WHERE id='{$id}' ");
        $db->query();
    }
    public function updateHit($id){
        $db             = getDBO();
        $db->setQuery("UPDATE {$this->_TABLE['info']} SET hits=hits+1 WHERE id='{$id}' ");
        $db->query();
    }
    
    
  public function showList(){        

        	 $this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist')));
        
        
  }
  
  public function detail(){} 
    
}
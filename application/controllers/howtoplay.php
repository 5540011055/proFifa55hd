<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Howtoplay extends CI_Controller {
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
        '_CMD'              => 'howtoplay',
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
        setPicContent($this->lang->line("how-to-play"));
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

    	$db       	= getDBO();
        
    	$page       = request('page') ? request('page') : 1;
        $limit       = $this->maxRows;
    	$adjacent    = 2;
        $start      = intval(($page-1)*$limit);
       
        $search     = request('search') ? request ('search') : '';
		$Qsearch    = $search;
		
        if($search){
        		$search_text	= $search;
           	    $search         = " AND ( i.subject LIKE '%{$search}%')  ";
        }
       
        
        $query                  = " SELECT          i.id,i.description
                                    FROM            {$this->_TABLE['info']}         AS i
                                    WHERE           i.status='1'  AND cid = '2'                     
                                                    {$search}
                                    ";
                                                    
         $db->setQuery($query);
         $num_r          = $db->loadAssocList();
         $totalRow       = count($num_r);
         $totalPage      = ceil($totalRow/$limit);
       
         
         $query       .=" ORDER BY i.seq ASC ";
         $query       .=" LIMIT {$start},{$limit} ";
                                                    
         $db->setQuery($query);
         $rs            = $db->loadAssocList();
         
        
        $data                   = Array(
            'table'         => $this->_TABLE,
            'rs'            => $rs,
        	'totalRow'		=> @$totalRow,
            'search'		=> @$search_text,
        	'page_temp'		=> @$page,
            'paginator'     => nextPage(@$limit,$adjacent,$totalRow,$page,@$Qsearch),
            'txt_content' => "FIFA55HD มีการพัฒนาระบบการแทงบอลให้ตอบสนองความต้องการของคนไทยมากที่สุดและดีที่สุดในขณะนี้"
        );
        
      
  		if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){	
        		 $this->load->view($this->data['_CMD'].'/showlist_ajax', $data);
        	
        }else{
        	 $this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist', $data)));
        }
        
        
  }
  
  public function detail(){} 
    
}
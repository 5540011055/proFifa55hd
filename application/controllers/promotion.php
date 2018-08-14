<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion extends CI_Controller {
    /**
     *
     * @var Array All Available tables 
     */
    public $_TABLE              = Array(
        'info'              => 'promotion_information',
        'file'              => 'promotion_attactments',
        'category'          => 'promotion_category'
    );
    public $data                = Array(
        '_CMD'              => 'promotion',
        'body'              => '',
        'menuName'          => ''
    );
    public $maxRows             = 20;
    public $otherRows           = 5;
    public $avialableTag        = '<p><a><img><span><div><table><tbody><tr><td><th><ul><li><qoute><font><ol><style><strong><em><u><i><h4><h5><h6>'; 
    /*
     * Predined methods
     */
    public function __construct() {
        parent::__construct(); 
        $this->load->helper('url'); 
       
        $this->lang->load($_ENV['lang_type']);
        setPicContent($this->lang->line("promotion"));
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
       
        
        $query                  = " SELECT          i.id,i.display_image,i.subject,i.description,i.hits,i.create_date,i.recommend
                                    FROM            {$this->_TABLE['info']}         AS i
                                    WHERE           i.status='1'                       
                                                    {$search}
                                    ";
                                                    
         $db->setQuery($query);
         $num_r          = $db->loadAssocList();
         $totalRow       = count($num_r);
         $totalPage      = ceil($totalRow/$limit);
       
         
         $query       .=" ORDER BY i.recommend = '1' DESC,i.id DESC  ";
         $query       .=" LIMIT {$start},{$limit} ";
                                                    
         $db->setQuery($query);
         $rs            = $db->loadAssocList();

        
        $data                   = Array(
            'table'         => $this->_TABLE,
            'rs'            => $rs,
        	'totalRow'		=> @$totalRow,
        	'page_temp'		=> @$page,
            'search'		=> @$search_text,
            'paginator'     => nextPage(@$limit,$adjacent,$totalRow,$page,@$Qsearch),
            'txt_content' => "FIFA55HD โปรโมชั่นพิเศษ มีการอัพเดทใหม่ทุกเดือน เพื่อตอบสนองความต้องการของคุณ"
        );
        
        if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){	
        		 $this->load->view($this->data['_CMD'].'/showlist_ajax', $data);
        	
        }else{
        	 $this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist', $data)));
        }
        
        
  }
  
  public function detail(){
  	$id                 = getParam(3, 0);
  	$this->updateHit($id);
  	if(!$id){exit('');}
  	
  	$db  = getDBO();
  	$db->setQuery("SELECT * FROM {$this->_TABLE['info']} WHERE id='{$id}' ");
  	$rs = $db->loadAssocList();
  	
  	if(!$rs){exit('');}
  	
  	$db->setQuery(" SELECT * FROM {$this->_TABLE['file']} WHERE uploadKey='{$rs[0]['uploadKey']}' AND attact_type='i' AND status='1' ORDER BY seq ASC ");
  	$all_images  =	$db->loadAssocList();
  	
  	$db->setQuery(" SELECT          i.id,i.display_image,i.subject,i.subject_en,i.title,i.title_en,i.description,i.description_en,i.hits,i.create_date,i.recommend
  					FROM            {$this->_TABLE['info']} AS i
  					WHERE           i.id <> '{$id}'  AND i.status='1' ORDER BY i.id DESC
  					LIMIT           {$this->otherRows}
  					");
  
  		$otherTreatment  = $db->loadAssocList();
  
        $data               = Array(
            'table'         => $this->_TABLE,
            'rs'            => $rs[0],
        	'all_images'	=> $all_images,
  			'otherRs'       => $otherTreatment
  	);
  	$this->loadView('view_sub',Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/detail', $data)));
  } 
  
  public function updateDisplay(){
  	$style_show = $_REQUEST["style_show"];
  	$_SESSION['display_grid'] = $style_show;
  }
    
}
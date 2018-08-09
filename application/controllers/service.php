<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {
	/**
	 *
	 * @var Array All Available tables
	 */
	public $_TABLE              = Array(
			'info'              => 'service_information',
			'file'              => 'service_attactments',
			'category'          => 'service_category'
			);
	public $data                = Array(
			'_CMD'              => 'service',
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
		setPicContent($this->lang->line("service"));
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
				'paginator'     => nextPage(@$limit,$adjacent,$totalRow,$page,@$Qsearch)
				);


		if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
			$this->load->view($this->data['_CMD'].'/showlist_ajax', $data);
			 
		}else{
			$this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist', $data)));
		}


	}





	public function sport(){
		
		$this->lang->load($_ENV['lang_type']);
		setPicContent($this->lang->line("sport-th"));

		$db       	= getDBO();
		 
		$cid		= 1;

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
		WHERE           i.status='1'  AND cid = {$cid}
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
				'paginator'     => nextPage(@$limit,$adjacent,$totalRow,$page,@$Qsearch)
				);


		if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
			$this->load->view($this->data['_CMD'].'/showlist_ajax', $data);
				
		}else{
			$this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist', $data)));
		}


	}



	public function casino(){
		
		$this->lang->load($_ENV['lang_type']);
		setPicContent($this->lang->line("casino-th"));

		$db       	= getDBO();

		$cid		= 2;

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
		WHERE           i.status='1'  AND cid = {$cid}
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
				'paginator'     => nextPage(@$limit,$adjacent,$totalRow,$page,@$Qsearch)
				);


		if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
			$this->load->view($this->data['_CMD'].'/showlist_ajax', $data);
				
		}else{
			$this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist', $data)));
		}


	}



	public function lotto(){
		
		$this->lang->load($_ENV['lang_type']);
		setPicContent($this->lang->line("lotto-th"));

		$db       	= getDBO();

		$cid		= 3;

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
		WHERE           i.status='1'  AND cid = {$cid}
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
				'paginator'     => nextPage(@$limit,$adjacent,$totalRow,$page,@$Qsearch)
				);


		if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
			$this->load->view($this->data['_CMD'].'/showlist_ajax', $data);
				
		}else{
			$this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist', $data)));
		}


	}

	
	public function basketball(){
	
		$this->lang->load($_ENV['lang_type']);
		setPicContent($this->lang->line("how-basketball"));
	
		$db       	= getDBO();
	
		$cid		= 4;
	
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
		WHERE           i.status='1'  AND cid = {$cid}
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
					'paginator'     => nextPage(@$limit,$adjacent,$totalRow,$page,@$Qsearch)
			);
	
	
			if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
					$this->load->view($this->data['_CMD'].'/showlist_ajax', $data);
	
			}else{
			$this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist', $data)));
			}
	
	
			}
			
			
			public function boxxing(){
			
				$this->lang->load($_ENV['lang_type']);
				setPicContent($this->lang->line("how-boxing"));
			
				$db       	= getDBO();
			
				$cid		= 5;
			
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
				WHERE           i.status='1'  AND cid = {$cid}
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
						'paginator'     => nextPage(@$limit,$adjacent,$totalRow,$page,@$Qsearch)
						);
			
			
						if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
						$this->load->view($this->data['_CMD'].'/showlist_ajax', $data);
			
				}else{
			$this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist', $data)));
				}
			
			
				}
				
				
				public function cocks(){
						
					$this->lang->load($_ENV['lang_type']);
					setPicContent($this->lang->line("how-cock"));
						
					$db       	= getDBO();
						
					$cid		= 6;
						
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
					WHERE           i.status='1'  AND cid = {$cid}
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
											'paginator'     => nextPage(@$limit,$adjacent,$totalRow,$page,@$Qsearch)
											);
												
												
											if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
													$this->load->view($this->data['_CMD'].'/showlist_ajax', $data);
														
					}else{
			$this->loadView('view_sub', Array('VIEW_BODY' => $this->getView($this->data['_CMD'].'/showlist', $data)));
					}
		
										
				}

	public function detail(){}

}
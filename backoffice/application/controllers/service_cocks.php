<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_cocks extends CI_Controller {
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
        '_CMD'              => 'service_cocks',
        'body'              => '',
        'menuName'          => 'Topic management'
    );
    public $maxRows             = 10;
    public $avialableTag        = '<p><a><img><span><div><table><tbody><tr><td><th><ul><li><qoute><font><ol><style><strong><em><u><i><h4><h5><h6>'; 
    /*
     * Predined methods
     */
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
        $this->showList();
    }
    public function updateSequence(){
        $id                 = getParam(3);
        $db                 = getDBO();
        $seq                = request('seq');
        $db->setQuery(" UPDATE {$this->_TABLE['file']} SET seq='{$seq}' WHERE id='{$id}' ;  ");
        $db->query();
        exit();
    }
    public function updateFileDESC(){
        $id                 = getParam(3);
        $db                 = getDBO();
        $description        = strip_tags(request('description'));
        $db->setQuery(" UPDATE {$this->_TABLE['file']} SET description='{$description}' WHERE id='{$id}' ;  ");
        $db->query();
        exit(" UPDATE {$this->_TABLE['file']} SET description='{$description}' WHERE id='{$id}' ;  ");
    }
    public function removeFile(){
        $id             = request('id');
        $table          = request('table');
        $db             = getDBO();
        $obj            = new Object();
        $obj->id        = $id;
        $obj->status    = '2';
        $db->updateObject($table, $obj, 'id');
        exit();
    } 
    
    
    
    /******************************************************************************
     *************************** User methods *************************************
     ******************************************************************************/
    public function showList(){
    	
    	$cid = 6; /* for detail data page */
    	
    	
        $this->data['showMainSearch']   = true;
        $this->data['menuName']     =  'เพิ่มไก่ชนออนไลน์';
        $db                         = getDBO();    
        $limit       = $this->maxRows;
        $adjacent    = 2;
        
        $limit       = $this->maxRows;
        $adjacent    = 2;
         
        $w_tool      = 100;
        
        
        // add new for 2 lang
         
        $search                     = str_replace('"', '', str_replace('\'', '', strip_tags(trim(@$_REQUEST['search']))));
         
        $query_search               = $search ? " AND (i.subject LIKE '%{$search}%'  )" : "";
        $placeholder                = 'หัวข้อ';
        
        
       // $dropdown                   = (@$_REQUEST['cid']) ? " AND i.cid = '".$_REQUEST['cid']."' " : "";
         
        $Qsearch  = ($search || @$_REQUEST["key"] || @$_REQUEST["order_by"] )  ? '&search='.@$search.'&key='.@$_REQUEST["key"].'&order_by='.@$_REQUEST["order_by"] : '';
         
         
        @$page = ($_REQUEST['page']) ? $_REQUEST['page'] : 1;
         
        if($page==1){
        	$start = 0;
        }
        else{
        	$start = ($page-1)*$limit;
        }
         
 
        /* Retrival data */
        $page                       = request('page', '1');
        $key                        = request('key', 'i.create_date');
        $orderBy                    = request('order_by', 'DESC');
        $limit                      = $this->maxRows;
        $start                      = ($page-1)*$limit;
         
        $query                      = " SELECT i.id,i.seq,i.status,i.subject,CONCAT(i.create_date,'__',i.create_by) As cbydate,
        								CONCAT(i.update_date,'__',i.update_by) As ubydate,
        							    CONCAT(i.recommend,'_',i.id) As recommend 
                                        FROM {$this->_TABLE['info']} As i WHERE i.status <> '2' AND cid = {$cid} {$query_search}
       								  ";
        
        $db->setQuery($query);
        $num_r          = $db->loadAssocList();
        $totalRow       = count($num_r);
         
         
        $query                  .=" ORDER BY        {$key} {$orderBy} ";
        $query                  .=" LIMIT           {$start},{$limit} ";
         
   
        $db->setQuery($query);
        $rs                     = $db->loadAssocList();
        
        
        
        
        /* Field config */
        $showField      = Array( 
        	/*'display_image'     => Array(
        			    'width'         => '90',
        				'align'         => 'center',
        				'fieldname'     => 'ภาพหัวห้อ',
        			    'eval'          => 'getImgTopic',
        	), */
        	
        		
        
        	'subject'     => Array(
        		'align'         => 'left',
        		'fieldname'     => 'หัวข้อ'		
        	), 
        		
        	/*'seq'     => Array(
        				'align'         => 'left',
        				'align'         => 'center',
        				'fieldname'     => 'เลขหน้า',
        				'width'         => '90',
        				'eval'			=> 'setSeqCircle'
        	), */
        		
        	'cbydate'     => Array(
        			     'width'         => '115',
        				'align'         => 'center',
        				'fieldname'     => 'สร้างเมื่อ',
        			    'eval'          => 'getCreateData',
        	 ),
        		
        		'cbydate'     => Array(
        				'width'         => '120',
        				'align'         => 'center',
        				'fieldname'     => 'สร้างเมื่อ',
        				'eval'          => 'getCreateData',
        				),
        		
        		'ubydate'     => Array(
        				'width'         => '120',
        				'align'         => 'center',
        				'fieldname'     => 'ปรับปรุงเมื่อ',
        				'eval'          => 'getCreateData',
        				),
        		
        		
        	'status'        => Array(
        				'width'         => '80',
        				'style'         => '',
        				'eval'          => 'getStatusActive2',
        				'align'         => 'center'
             )

       
         
        );
        $pageURL        = base_url().getParam(1).'/'.getParam(2).'/?'.  getQueryString();
        $totalPage      = ceil($totalRow/$limit);
        /* Tools managment */
        $adminTools     = Array(
            'Edit'          => Array(
                'url'           => base_url().getParam(1).'/edit/@id/',
                'image'         => 'images/icons/16px/edit.png',
                'confirm'       => false
            ),
            'Delete'        => Array(
                'url'           => base_url().getParam(1).'/remove/@id/',
                'image'         => 'images/icons/16px/delete.png',
                'confirm'       => true
            )
        );
        
        
        $this->loadView(
                "{$this->data['_CMD']}/showlist", 
                Array(
                    'gridTable'     => getGridTable2(
                                            $rs,
                    		                @request('search'),
                                            $showField, 
                                            $adminTools, 
                                            true, 
                                            Array(
                                                Array(
                                                    'name'          => 'เพิ่มบริการไก่ชนออนไลน์',
                                                    'method'        => 'add',
                                                    'submit'        => false
                                                ),
                                                Array(
                                                    'name'          => 'Delete selected',
                                                    'method'        => 'multiRemove',
                                                    'submit'        => true
                                                )
                                            ),
                    		            true,
    									$limit,
    									$page,
                						$w_tool
                                        ),
                    'paginator'     => pagination(@$limit,$adjacent,$totalRow,$page,@$Qsearch),
                    'placeholder'   => $placeholder,
                		
                    'table'			=> $this->_TABLE
                )
        );
    }
    
    
    
    
    public function add(){
       
	    $this->data['menuName']      = 'เพิ่มบริการไก่ชนออนไลน์';
	    $this->data['iconName'] = '<i class="fa fa-plus-square"></i>';
	    
	    
        $user                   = getLogedInUser(); 
        $frm =Array();
        $frm['status'] = 1;
        
        
        $db = getDBO();
        
        $rs_seq = $this->getMaxSeq();
        $frm['seq'] = ($rs_seq) ? ($rs_seq + 1) : "1" ;
        
        $frm['cid'] = 6; /* for detail data page */
        
        
        $this->loadView("{$this->data['_CMD']}/edit", Array(
            'frm'           => $frm,
            'uploadKey'     => md5(time()),
            'sid'           => $user['sid'],
            'task'          => 'insert',
            '_CMD'          => $this->data['_CMD'],
            'table'         => $this->_TABLE,
            'user'          => $user,
        	'seq'           => $frm['seq']
        ));
    }
    
    
    
    public function insert(){
        
     	$obj                        = new Object();
     	
     	
     	$rs_seq	    = $this->getMaxSeq();
     	$curent_seq = request('seq');
     	
     	if($curent_seq <= $rs_seq){
     		$this->swap_seq($curent_seq,$rs_seq);
     	}
     	
		$obj->subject               = escape_str(strip_tags(request('subject')));
     			

        $obj->uploadKey             = request('uploadKey');
        $obj->cid                   = request('cid');
        
        $obj->seq             	    =    request('seq');
        
        $obj->description           = strip_tags(request('description'), $this->avialableTag);
        
        $obj->status                = request('status', '0');
        $obj->create_date           = date('Y-m-d H:i:s');
        $obj->create_by             = getLogedInUserId();
        $obj->create_ip             = getIPAddress();
        $db                         = getDBO();
        
        $updated                    = $db->insertObject($this->_TABLE['info'], $obj);
        if( $updated ){
            $this->loadView('_system_message',Array(
                'msg'       => lang('Inserted', 'Inserted'),
                'page'      => base_url().$this->data['_CMD'].'/'
            ));
        }else{
            $this->loadView('_system_message_error',Array(
                'msg'       => lang('Can not update', 'Can not update'),
                'page'      => base_url().$this->data['_CMD'].'/'
            ));
        }
    }
    
    
    
    public function edit(){

    	$this->data['menuName'] = lang('edit topic', 'edit topic');
    	$this->data['iconName'] = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>';
    	
        $id                     = getParam(3, -1);
        $db                     = getDBO();
        $db->setQuery("SELECT * FROM {$this->_TABLE['info']} WHERE id ='{$id}' ");
        $rs                     = $db->loadAssocList();
        $rs                     = @$rs[0];
        $user                   = getLogedInUser();    
        $uploadKey              = $rs['uploadKey'];
        
        $rs_seq = $this->getMaxSeq();
        
        if( @$rs ){
            $this->loadView("{$this->data['_CMD']}/edit", Array(
                'frm'           => $rs,
                'uploadKey'     => $uploadKey,
                'sid'           => $user['sid'],
                'task'          => 'update',
                '_CMD'          => $this->data['_CMD'],
                'table'         => $this->_TABLE,
                'user'          => $user,
            	'seq'		    => $rs_seq
            ));
        }
    }
    
    
    
    public function update(){         
       // $_ENV['alias-tab-number']   = '1';
        $obj                        = new Object();
        
        $rs_seq	     = $this->getSeqID(request('id'));
        $curent_seq  = request('seq');
        
        if($rs_seq != $curent_seq){
        	$this->swap_seq_update($curent_seq,$rs_seq);
        }

        $obj->id                    = request('id');  
        $obj->uploadKey             = request('uploadKey');
        
        $obj->subject               = escape_str(strip_tags(request('subject')));
        
        
        $obj->cid                   = request('cid');
        $obj->seq               	= request('seq');
      
        $obj->description           = strip_tags(request('description'), $this->avialableTag);
        
        $obj->status                = request('status', '0');
      
        $obj->update_date           = date('Y-m-d H:i:s');
        $obj->update_by             = getLogedInUserId();
        $obj->update_ip             = getIPAddress();
        $db                         = getDBO();
        $updated                    = $db->updateObject($this->_TABLE['info'], $obj, 'id');
        if( $updated ){
            $this->loadView('_system_message',Array(
                'msg'       => lang('Updated', 'Updated'),
                'page'      => base_url().$this->data['_CMD'].'/'
            ));
        }else{
            $this->loadView('_system_message_error',Array(
                'msg'       => lang('Can not update', 'Can not update'),
                'page'      => base_url().$this->data['_CMD'].'/'
            ));
        }
    }


    
    public function remove(){
        
        $id                         = getParam(3);
   
        $db                         = getDBO();
        $db->setQuery(" SELECT count(id) AS count FROM {$this->_TABLE['info']} WHERE id='{$id}' AND status<>'2'  ; ");
        $rs                         = $db->loadAssocList();
        $count                      = $rs[0]['count'];
        if(  $count>0  ){
            $user               = getLogedInUser(); 
            $obj                = new Object();
            $obj->id            = $id;
            $obj->delete_date   = date('Y-m-d H:i:s');
            $obj->delete_ip     = getIPAddress();
            $obj->delete_by     = $user['id'];
            $obj->status        = '2';
            if($db->updateObject($this->_TABLE['info'], $obj, 'id')){
            	
            	$this->setNewSeq();
            	
                $this->loadView('_system_message',Array(
                    'msg'       => lang('Deleted', 'Deleted'),
                    'page'      => base_url().$this->data['_CMD']
                ));
            }else{
            	$this->setNewSeq();
            	
                $this->loadView('_system_message_error',Array(
                    'msg'       => lang('Can not delete', 'Can not delete'),
                    'page'      => base_url().$this->data['_CMD']
                ));
            }
        }else{
            $this->loadView('_system_message_error',Array(
                'msg'       => lang('Data not found', 'Data not found'),
                'page'      => base_url().$this->data['_CMD']
            ));
        }
    }
	
        
    
    public function multiRemove(){
        $_ENV['alias-tab-number']   = '1';
        $this->data['menuName'] = lang('delete data', 'delete data');
       
        $id                 = request('id');
        if($id!="" && count($id)>0){
            $user                   = getLogedInUser(); 
            $db                     = getDBO();
            foreach($id     AS $currentId){                
                $obj                = new Object();
                $obj->id            = $currentId;
                $obj->delete_date   = date('Y-m-d H:i:s');
                $obj->delete_ip     = getIPAddress();
                $obj->delete_by     = $user['id'];
                $obj->status        = '2';
                $db->updateObject($this->_TABLE['info'], $obj, 'id');
            }
            
            $this->setNewSeq();
            $this->loadView('_system_message',Array(
                'msg'       => lang('Deleted', 'Deleted'),
                'page'      => base_url().$this->data['_CMD']
            ));
        }else{
            $this->loadView('_system_message_error',Array(
                'msg'       => lang('คุณไม่ได้เลือกรายการที่จะลบ กรุณาเลือกรายการที่จะลบ', 'คุณไม่ได้เลือกรายการที่จะลบ กรุณาเลือกรายการที่จะลบ'),
                'page'      => base_url().$this->data['_CMD']
            ));
        }
    }
    
    
    public function updateRecommend(){
    	$db             = getDBO();
    
    	$db->setQuery(" UPDATE {$this->_TABLE['info']} SET  recommend ='{$_REQUEST['val']}' WHERE id ='{$_REQUEST['id']}'");
    	$db->query();
        
    	echo $db->query();
    }
    
    
    public function getMaxSeq(){
    
    	$db             = getDBO();
    
    	$db->setQuery("SELECT max(seq) As seq FROM {$this->_TABLE['info']} WHERE status = '1' ");
    	$rs = $db->loadAssocList();
    
    	return  ($rs[0]["seq"]) ? $rs[0]["seq"] : "0";
    }
    
    
    public  function swap_seq($result_seq,$last_db_seq){
    
    	$db = getDBO();
    
    	$db->setQuery("SELECT id,seq FROM {$this->_TABLE['info']} WHERE  status = '1' AND seq >= '".$result_seq."' ");
    	$rs = $db->loadAssocList();
    
    	for($i=0;$i<count($rs);$i++){
    
    		$seq_new = $rs[$i]["seq"] + 1;
    
    		$db->setQuery("UPDATE {$this->_TABLE['info']}  SET seq = '".$seq_new."' WHERE id = '".$rs[$i]["id"]."' ");
    		$db->Query();
    	}
    }
    
    public  function swap_seq_update($result_seq,$last_db_seq){
    
    	$db = getDBO();
    
    	if($result_seq < $last_db_seq){
    
    		$db->setQuery("SELECT id,seq FROM {$this->_TABLE['info']} WHERE  status = '1' AND seq < '".$last_db_seq."' ");
    		$rs = $db->loadAssocList();
    
    		for($i=0;$i<count($rs);$i++){
    	   
    			$seq_new = $rs[$i]["seq"] + 1;
    	   
    			$db->setQuery("UPDATE {$this->_TABLE['info']}  SET seq = '".$seq_new."' WHERE id = '".$rs[$i]["id"]."' ");
    			$db->Query();
    		}
    
    	}else if($result_seq >  $last_db_seq){
    		$db->setQuery("SELECT id,seq FROM {$this->_TABLE['info']} WHERE  status = '1' AND seq > '".$last_db_seq."' ");
    		$rs = $db->loadAssocList();
    
    		for($i=0;$i<count($rs);$i++){
    
    			$seq_new = $rs[$i]["seq"] - 1;
    
    			$db->setQuery("UPDATE {$this->_TABLE['info']}  SET seq = '".$seq_new."' WHERE id = '".$rs[$i]["id"]."' ");
    			$db->Query();
    		}
    		 
    	}
    	 
    }
    
    
    public function setNewSeq(){
    	 
    	$db = getDBO();
    	 
    	$db->setQuery("SELECT id,seq FROM {$this->_TABLE['info']} WHERE  status = '1' AND cid = '3' ORDER BY seq ASC ");
    	$rs = $db->loadAssocList();
    	 
    	for($i=0,$j=1;$i<count($rs);$i++,$j++){
    
    		$db->setQuery("UPDATE {$this->_TABLE['info']}  SET seq = '".$j."' WHERE id = '".$rs[$i]["id"]."' ");
    		$db->Query();
    	}
    	 
    }
    
    
    public function getSeqID($id){
    
    	$db             = getDBO();
    
    	$db->setQuery("SELECT seq FROM {$this->_TABLE['info']} WHERE id = '".$id."' ");
    	$rs = $db->loadAssocList();
    
    	return @$rs[0]["seq"];
    }
    
        
    
    
}

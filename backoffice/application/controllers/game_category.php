<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game_category extends CI_Controller {
    /**
     *
     * @var Array All Available tables 
     */
    public $_TABLE              = Array(
         'info'              => 'game_category',
        'file'              => 'game_attactments',
        'category'          => 'game_category'
    );
    public $data                = Array(
        '_CMD'              => 'game_category',
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
    	
    	
        $this->data['showMainSearch']   = true;
        $this->data['menuName']     =  'เพิ่มประเภทเกมส์';
        $db                         = getDBO();    
        $limit       = $this->maxRows;
        $adjacent    = 2;
        
        $limit       = $this->maxRows;
        $adjacent    = 2;
         
        $w_tool      = 100;
        
        
        // add new for 2 lang
        @$_REQUEST["key"] = ($_REQUEST["key"]=="subject_temp") ? "i.cate_name" : $_REQUEST["key"];
         
         
        $search                     = str_replace('"', '', str_replace('\'', '', strip_tags(trim(@$_REQUEST['search']))));
         
        $query_search               = $search ? " AND (i.cate_name LIKE '%{$search}%' OR i.cate_name_en LIKE '%{$search}%' )" : "";
        $placeholder                = 'ประเภทเกมส์';
         
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
        $key                        = request('key', 'i.id');
        $orderBy                    = request('order_by', 'ASC');
        $limit                      = $this->maxRows;
        $start                      = ($page-1)*$limit;
         
        $query                      = " SELECT i.id,i.status,CONCAT(i.id,'__{$this->_TABLE['info']}')  As subject_temp,CONCAT(i.create_date,'__',i.create_by) As cbydate, 
        							    CONCAT(i.update_date,'__',i.update_by) As upydate 
                                        FROM {$this->_TABLE['info']} As i WHERE i.status <> '2'  {$query_search}
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
        		
        	'subject_temp'     => Array(
        		'align'         => 'left',
        		'fieldname'     => 'ประเภทเกมส์',
        		'eval'          => 'change_cate_name',		
        	),
        		
        	'cbydate'     => Array(
        			    'width'         => '160',
        				'align'         => 'center',
        				'fieldname'     => 'สร้างเมื่อ',
        			    'eval'          => 'getCreateData',
        	),
        		
             'upydate'     => Array(
             		    'width'         => '160',
        				'align'         => 'center',
        				'fieldname'     => 'ปรับปรุงเมื่อ',
             		    'eval'			=> 'getCreateData'
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
                                            false, 
                                            Array(
                                                Array(
                                                    'name'          => 'เพิ่มประเภท ',
                                                    'method'        => 'add',
                                                    'submit'        => false
                                                )/*,
                                                Array(
                                                    'name'          => 'Delete selected',
                                                    'method'        => 'multiRemove',
                                                    'submit'        => true
                                                )*/
                                            ),
                    		            true,
    									$limit,
    									$page,
                						$w_tool
                                        ),
                    'paginator'     => pagination(@$limit,$adjacent,$totalRow,$page,@$Qsearch),
                		
                    'placeholder'   => $placeholder
                )
        );
    }
    
    
    
    
    public function add(){
       
	    $this->data['menuName']      = "เพิ่มประเภทเกมส์";
	    $this->data['iconName'] = '<i class="fa fa-plus-square"></i>';
	    
	    
        $user                   = getLogedInUser(); 
        $frm =Array();
        $frm['status'] = 1;
        
        
        $db = getDBO();
        
        
        $this->loadView("{$this->data['_CMD']}/edit", Array(
            'frm'           => $frm,
            'uploadKey'     => md5(time()),
            'sid'           => $user['sid'],
            'task'          => 'insert',
            '_CMD'          => $this->data['_CMD'],
            'table'         => $this->_TABLE,
            'user'          => $user
        ));
    }
    
    
    
    public function insert(){
        
     	$obj                        = new Object();
     	
     	$obj->parent_id             = request('parent_id', '0');
        $obj->cate_name             = escape_str(strip_tags(request('cate_name')));
     //   $obj->cate_name_en          = escape_str(strip_tags(request('cate_name_en')));

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
        if( @$rs ){
            $this->loadView("{$this->data['_CMD']}/edit", Array(
                'frm'           => $rs,
                'uploadKey'     => $uploadKey,
                'sid'           => $user['sid'],
                'task'          => 'update',
                '_CMD'          => $this->data['_CMD'],
                'table'         => $this->_TABLE,
                'user'          => $user
            ));
        }
    }
    
    
    
    public function update(){         
       // $_ENV['alias-tab-number']   = '1';
        $obj                        = new Object();
 
        $obj->id                    = request('id');  
        $obj->parent_id             = request('parent_id', '0');
        $obj->cate_name             = escape_str(strip_tags(request('cate_name')));
      //  $obj->cate_name_en          = escape_str(strip_tags(request('cate_name_en')));
        
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
                $this->loadView('_system_message',Array(
                    'msg'       => lang('Deleted', 'Deleted'),
                    'page'      => base_url().$this->data['_CMD']
                ));
            }else{
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
        
    
    
}

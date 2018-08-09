<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
    /**
     *
     * @var Array All Available tables 
     */
    public $_TABLE              = Array( 
        'info'              	=> 'register_information'
    );
    public $data                = Array(
        '_CMD'              => 'register',
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
        $this->data['menuName']     =  '';
        $db                         = getDBO();    
        $limit       = $this->maxRows;
        $adjacent    = 2;
        
        $limit       = $this->maxRows;
        $adjacent    = 2;
         
        $w_tool      = 100;
       
         
         
        $search                     = str_replace('"', '', str_replace('\'', '', strip_tags(trim(@$_REQUEST['search']))));
         
        $query_search               = $search ? " AND ( i.name LIKE '%{$search}%' OR i.phone LIKE '%{$search}%' OR i.email LIKE '%{$search}%' OR i.line_id LIKE '%{$search}%' )" : "";
        $placeholder                = 'ชื่อ -สกุล, หมายเลขโทรศัพท์ หรือ Line ID';
        
        
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
         
        $query                      = " SELECT i.*,CONCAT(i.update_date,'__',i.update_by) As upydate 
                                        FROM {$this->_TABLE['info']} As i 
                                        WHERE i.status <> '2'  {$query_search}
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
        

	        	'name'     => Array(
	        		'align'         => 'center',
	        		'fieldname'     => 'ชื่อ - สกุล',		
	        	),
        		'phone'     => Array(
        				'align'         => 'center',
        				'fieldname'     => 'หมายเลขโทรศัพท์',
        				),
        		
        		'line_id'     => Array(
        				'align'         => 'center',
        				'fieldname'     => 'LINE ID',
        				),
        		
        		
        		'create_date'     => Array(
        				'width'         => '120',
        				'align'         => 'center',
        				'fieldname'     => 'วันที่สมัคร',
        				'eval'          => 'shortThDateYearlongYAdmin'
        				),
        		
        		'upydate'     => Array(
        				'width'         => '160',
        				'align'         => 'center',
        				'fieldname'     => 'ดำเนินการโดย',
        				'eval'			=> 'getCreateData'
        				),
        				 
        		
        		'status'        => Array(
        				'width'         => '80',
        				'style'         => '',
        				'eval'          => 'getStatusRegister',
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
                                                /*Array(
                                                    'name'          => 'เพิ่มข้อมูลเทคโนโลยี',
                                                    'method'        => 'add',
                                                    'submit'        => false
                                                ),*/
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
    
    
    public function edit(){

    	$this->data['menuName'] = lang('read register','read register');
    	$this->data['iconName'] = '<i class="fa fa-pencil-square-o" ></i>';
    	
        $id                 = getParam(3);
        $db                 = getDBO();
        $db->setQuery(" SELECT      *
                            FROM        {$this->_TABLE['info']}
                            WHERE       id='{$id}'
                            ");
        $rs                 = $db->loadAssocList();
        $rs                 = $rs[0];
        $rs["status"]			= 1;
 		  
        if(@$rs){
            $this->loadView("{$this->data['_CMD']}/edit", Array(
                'frm'           => $rs,
                'task'          => 'update',
                '_CMD'          => $this->data['_CMD'],
                'table'         => $this->_TABLE
            ));
        }
    }
    
    
    
    public function update(){         
       // $_ENV['alias-tab-number']   = '1';
        $obj                        = new Object();

        $obj->id                    = request('id');  
        $obj->status                = request('status', '2');
      
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
    
    
    public function updateRecommend(){
    	$db             = getDBO();
    
    	$db->setQuery(" UPDATE {$this->_TABLE['info']} SET  recommend ='{$_REQUEST['val']}' WHERE id ='{$_REQUEST['id']}'");
    	$db->query();
        
    	echo $db->query();
    }
        
    
    
}

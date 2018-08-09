<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userclass extends CI_Controller {
    /**
     *
     * @var Array All Available tables 
     */
    public $_TABLE              = Array(
        'info'              => 'users_class',
        'info_priv'         => 'users_priv',
    	'menu'        		=> '_menuadmin'
    );
    public $data                = Array(
        '_CMD'              => 'userclass',
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
        $this->data['menuName']     =  'เพิ่มข้อมูลกลุ่มผู้ใช้';
        $db                         = getDBO();    
        $limit       = $this->maxRows;
        $adjacent    = 2;
        
        $limit       = $this->maxRows;
        $adjacent    = 2;
         
        $w_tool      = 100;
        
         
         
        $search                     = str_replace('"', '', str_replace('\'', '', strip_tags(trim(@$_REQUEST['search']))));
         
        $query_search               = $search ? " AND (i.class_name LIKE '%{$search}%')" : "";
        $placeholder                = 'Group Name';
        
        
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
        $key                        = request('key', 'i.class_value');
        $orderBy                    = request('order_by', 'DESC');
        $limit                      = $this->maxRows;
        $start                      = ($page-1)*$limit;
         
        $query                      = " SELECT i.*,i.class_value As state FROM {$this->_TABLE['info']} As i WHERE i.status<>'2' {$query_search} ";
        
        $db->setQuery($query);
        $num_r          = $db->loadAssocList();
        $totalRow       = count($num_r);
         
         
        $query                  .=" ORDER BY        {$key} {$orderBy} ";
        $query                  .=" LIMIT           {$start},{$limit} ";
         
   
        $db->setQuery($query);
        $rs                     = $db->loadAssocList();
        
        
        /* Field config */
        $showField      = Array( 
        		
        	'class_value'     => Array(
        				'align'         => 'left',
        				'style'			=> 'padding-left:20px;',
        				'fieldname'     => 'กลุ่มผู้ใช้'
        	),
        		
        	'class_name'     => Array(
        				'align'         => 'left',
        				'style'			=> 'padding-left:20px;',
        				'fieldname'     => 'ชื่อกลุ่มผู้ใช้'
        	),
        		
        		'class_priv'     => Array(
        				'align'         => 'center',
        				'fieldname'     => 'สิทธิ์ใช้งาน'
        		),
        		
        		
        		'state'     => Array(
        				'align'         => 'center',
        				'width'         => '120',
        				'fieldname'     => 'Admin System',
        				'eval'			=> 'getAllowMenu'
        		),
        		
        		/*'status'        => Array(
        				'width'         => '80',
        				'style'         => '',
        				'eval'          => 'getStatusActive2',
        				'align'         => 'center'
        				)*/
        		
        	
        		
        );
        $pageURL        = base_url().getParam(1).'/'.getParam(2).'/?'.  getQueryString();
        $totalPage      = ceil($totalRow/$limit);
        /* Tools managment */
        $adminTools     = Array(
            'Edit'          => Array(
                'url'           => base_url().getParam(1).'/edit/@class_value/',
                'image'         => 'images/icons/16px/edit.png',
                'confirm'       => false
            ),
            'Delete'        => Array(
                'url'           => base_url().getParam(1).'/remove/@class_value/',
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
                                                    'name'          => 'เพิ่มกลุ่มผู้ใช้',
                                                    'method'        => 'add',
                                                    'submit'        => false
                                                ),
                                                /*Array(
                                                    'name'          => 'Delete selected',
                                                    'method'        => 'multiRemove',
                                                    'submit'        => true
                                                ) */
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
       
	    $this->data['menuName']      = "เพิ่มกลุ่มผู้ใช้ (Users Group)";
	    $this->data['iconName'] = '<i class="fa fa-users"></i>';
	    
	    
        $user                   = getLogedInUser(); 
        $frm =Array();
        $frm['status'] = 1;
        
        $db = getDBO();
       
        $db->setQuery("SELECT * FROM {$this->_TABLE['info_priv']} ");
        $users_priv_rs = $db->loadAssocList();
        
        $db->setQuery("SELECT * FROM {$this->_TABLE['menu']} WHERE status = '1' AND controller <> 'dashboard' ORDER BY sort_main, sort_sub ASC ");
        $menu = $db->loadAssocList();
        

        
        $this->loadView("{$this->data['_CMD']}/edit", Array(
            'frm'           => $frm,
            'uploadKey'     => md5(time()),
            'sid'           => $user['sid'],
            'task'          => 'insert',
            '_CMD'          => $this->data['_CMD'],
            'table'         => $this->_TABLE,
            'user'          => $user,
        	'users_priv_rs'	=> $users_priv_rs,
        	'menu'			=> $menu
        ));
    }
    
    
    
    public function insert(){
        
     	$obj                        = new Object();
    
        $obj->class_name          = request('class_name');
        $obj->class_value         = request('class_value');
        $obj->class_priv          = request('priv');
        $obj->status              = request('status','1');
        
        $db                       = getDBO();
        $update                   = $db->insertObject($this->_TABLE['info'], $obj);
        
        if($update){
        	// Define Column admin menu
        	$priv_colums = 'priv_'.@$_POST["class_value"];
        	 
        	// check culumn if no exits to add column
        	$crete_col = $db->getTableColumnExits2Add($this->_TABLE['menu'],$priv_colums);
        	 
        	// Clear Column this priv
        	$db->setQuery("UPDATE {$this->_TABLE['menu']}  SET {$priv_colums} =  '' ");
        	$db->Query();
        	 
        	// Clear Column this priv
        	$db->setQuery("UPDATE {$this->_TABLE['menu']}  SET {$priv_colums} =  'allow' WHERE controller = 'dashboard' ");
        	$updated = $db->Query();
        	 
        	
        	// input menu
        	$menu = request('menu');
        	 
        	for($i=0;$i<count($menu);$i++){
        	
        		$db->setQuery("UPDATE {$this->_TABLE['menu']}  SET {$priv_colums} =  'allow' WHERE id = '".$menu[$i]."' ");
        		$updated = $db->Query();
        	}
        }
        
        
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
        $db->setQuery("SELECT * FROM {$this->_TABLE['info']} WHERE class_value ='{$id}' ");
        $rs                     = $db->loadAssocList();
        $rs                     = @$rs[0];
        $user                   = getLogedInUser();    
 
        $db->setQuery("SELECT * FROM {$this->_TABLE['info_priv']} ");
        $users_priv_rs = $db->loadAssocList();
        
        $db->setQuery("SELECT * FROM {$this->_TABLE['menu']} WHERE status = '1' AND controller <> 'dashboard' ORDER BY sort_main, sort_sub ASC ");
        $menu = $db->loadAssocList();
        
        if( @$rs ){
            $this->loadView("{$this->data['_CMD']}/edit", Array(
                'frm'           => @$rs,
                'uploadKey'     => @$uploadKey,
                'sid'           => @$user['sid'],
                'task'          => 'update',
                '_CMD'          => $this->data['_CMD'],
                'table'         => $this->_TABLE,
                'user'          => @$user,
            	'users_priv_rs'	=> @$users_priv_rs,
            	'menu'			=> $menu
            ));
        }
    }
    
    
    
    public function update(){         
     
    	
    	$db = getDBO();
    	
    	// Define Column admin menu
    	$priv_colums = 'priv_'.@$_POST["class_value"];
    	
    	// check culumn if no exits to add column
    	$crete_col = $db->getTableColumnExits2Add($this->_TABLE['menu'],$priv_colums);
    	
    	// Clear Column this priv
    	$db->setQuery("UPDATE {$this->_TABLE['menu']}  SET {$priv_colums} =  '' ");
    	$db->Query();
    	
    	// Clear Column this priv
    	$db->setQuery("UPDATE {$this->_TABLE['menu']}  SET {$priv_colums} =  'allow' WHERE controller = 'dashboard' ");
    	$updated = $db->Query();
    	

        // input menu
    	$menu = request('menu');
    	
    	for($i=0;$i<count($menu);$i++){
    		
    		$db->setQuery("UPDATE {$this->_TABLE['menu']}  SET {$priv_colums} =  'allow' WHERE id = '".$menu[$i]."' ");
    		$updated = $db->Query();
    	}
    	
    	
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
        $db->setQuery(" SELECT count(class_value) AS count FROM {$this->_TABLE['info']} WHERE class_value='{$id}' AND status<>'2'  ; ");
        $rs                         = $db->loadAssocList();
        $count                      = $rs[0]['count'];
        if(  $count>0  ){
            
        	$db->setQuery("DELETE FROM {$this->_TABLE['info']} WHERE class_value='{$id}' ");
        	$del  = $db->Query();
        	
            if($del){
            	
            	$drop_col = 'priv_'.$id;
            	$db->setQuery("ALTER TABLE {$this->_TABLE['menu']} DROP COLUMN {$drop_col} ");
            	$db->Query();
            	
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

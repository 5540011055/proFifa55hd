<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_user extends CI_Controller {
    /**
     *
     * @var Array All Available tables 
     */
    public $_TABLE              = Array(
        'conf'              => 'cpanel_configuration',
        'general'           => 'cpanel_configuration_general'
    );
    public $data                = Array(
        '_CMD'              => 'setting_user',
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
        $this->edit();
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
    public function showList(){ }
    
    public function add(){ }

    public function insert(){ }
      
    public function edit(){

    	$this->data['menuName'] = lang('setting general', 'setting general');
    	$this->data['iconName'] = '<i class="fa fa-cogs" aria-hidden="true"></i>';
    	
        $db                     = getDBO();
        $db->setQuery("SELECT * FROM {$this->_TABLE['general']} ");
        $rs                     = $db->loadAssocList();
        $rs                     = @$rs[0];
        $user                   = getLogedInUser();    
        $uploadKey              = @$rs['uploadKey'];
        
        $field              = $db->getTableFields(Array( $this->_TABLE['general'] ));
        $field              = $field[$this->_TABLE['general']];
        $key                = array_keys($field);
        $key_type           = array_values($field);
        
        
        if( @$rs ){
            $this->loadView("{$this->data['_CMD']}/edit", Array(
                'frm'           => $rs,
                'sid'           => $user['sid'],
                'task'          => 'update',
                '_CMD'          => $this->data['_CMD'],
                'table'         => $this->_TABLE,
                'user'          => $user,
            	'key'           => $key,
            	'key_type'      => $key_type
            ));
        }
    }
    
    
    
    public function update(){         

        $obj                        = new Object();
        
        $obj->id                    = request('id');  
        $obj->title                 = escape_str(strip_tags(request('title')));
        $obj->company               = escape_str(strip_tags(request('company')));
        $obj->company2              = escape_str(strip_tags(request('company2')));
        
        $obj->company_address       = escape_str(strip_tags(request('company_address')));
        //$obj->company_address2      = escape_str(strip_tags(request('company_address2')));
        
      $obj->company_address_en       = escape_str(strip_tags(request('company_address_en')));
     //   $obj->company_address2_en      = escape_str(strip_tags(request('company_address2_en')));
        
        $obj->company_callcenter         = request('company_callcenter');
        
        $obj->company_phone         = request('company_phone');
        $obj->company_phone2        = request('company_phone2');
        $obj->company_email         = request('company_email');
        $obj->company_fax           = request('company_fax');
        
        
        $obj->company_facebook      = request('company_facebook');
        $obj->company_line          = request('company_line');
        $obj->company_ig            = request('company_ig');
        
        $obj->company_facebook_link      = request('company_facebook_link');
        $obj->company_line_link          = request('company_line_link');
        $obj->company_ig_link            = request('company_ig_link');
        
        $obj->company_slogan            = request('company_slogan');
        
        $obj->description           = request('description');
        $obj->keyword           	= request('keyword');
        
        $db                         = getDBO();
        $updated                    = $db->updateObject($this->_TABLE['general'], $obj, 'id');
        
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

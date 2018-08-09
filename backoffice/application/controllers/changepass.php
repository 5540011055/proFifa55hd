<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Changepass extends CI_Controller {
    /**
     *
     * @var Array All Available tables 
     */
    public $_TABLE              = Array(
        'info'                  => 'users',
    	'file'					=> 'users_attactments',
    	'province'				=> 'cpanel_province',
    	'amphur'				=> 'cpanel_amphur',
    	'district'				=> 'cpanel_district',
    	'zipcode'			    => 'cpanel_zipcode',
    	'users_priv'			=> 'users_priv',
    	'users_class'			=> 'users_class'
    );
    public $data                = Array(
        '_CMD'              => 'changepass',
        'body'              => '',
        'menuName'          => ''
    );
    public $maxRows             = 8;
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

    
    
    public function edit(){
       
        $this->data['iconName'] = '<i class="fa fa-key fa-rotate-120" aria-hidden="true"></i>';
        $this->data['menuName'] = "เปลี่ยนรหัสผ่าน";

        $user                   = getLogedInUser();
        
        $id                     = $user['id'];
        $db                     = getDBO();
        $db->setQuery("SELECT * FROM {$this->_TABLE['info']} WHERE id='{$id}' ");
        $rs                     = $db->loadAssocList();
        $rs                     = @$rs[0];
        
        
        if( @$rs ){
            $this->loadView("{$this->data['_CMD']}/edit", Array(
                'frm'           => $rs,
                'sid'           => $user['sid'],
                'task'          => 'update',
                '_CMD'          => $this->data['_CMD']
            ));
        }
    }
    
    
    
  
    public function update(){
    	
    	$this->data['iconName'] = '<i class="fa fa-key fa-rotate-120" aria-hidden="true"></i>';
    	$this->data['menuName'] = "เปลี่ยนรหัสผ่าน";
   	
    	$user                   = getLogedInUser();
    	$id                     = $user['id'];
    	
    	$obj                    = new Object();
    	
    	$obj->id                = $id;
    	$obj->password			= md5(request('newpassword'));
    	
        $obj->update_date       = date('Y-m-d H:i:s');
        $obj->update_by         = getLogedInUserId();
        $obj->update_ip         = getIPAddress();
       
        $db                     = getDBO();
    	$updated                = $db->updateObject($this->_TABLE['info'], $obj, 'id');
    	if( $updated ){
    		 $this->loadView("{$this->data['_CMD']}/edit", Array(
                'frm'           => $user,
                'task'          => 'update',
                '_CMD'          => $this->data['_CMD'],
    		 	'success'		=> true
            ));
    	}else{
    		$this->loadView('_system_message_error',Array(
    				'msg'       => lang('Can not update', 'Can not update'),
    				'page'      => base_url().$this->data['_CMD'].'/'
    		));
    	}
    }

    
    public function checkOldPass(){
    	
    	$user                   = getLogedInUser();
    	$user_id                = $user['id'];
    	$oldpass				= md5($_POST["oldpass"]);
    	
    	$db = getDBO();
    	$db->setQuery("SELECT COUNT(id) As chk_pass FROM {$this->_TABLE['info']} WHERE id = '".$user_id."' AND password = '".$oldpass."' ");
    	$rs = $db->loadAssocList();
    	
    	echo ($rs[0]["chk_pass"]) ? true : false ;
    	
    }
	

    
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_system extends CI_Controller {
    /**
     *
     * @var Array All Available tables 
     */
    public $_TABLE              = Array(
        'conf'              => 'cpanel_configuration',
        'general'           => 'cpanel_configuration_general'
    );
    public $data                = Array(
        '_CMD'              => 'setting_system',
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

    	$this->data['menuName'] = lang('setting system', 'setting system');
    	$this->data['iconName'] = '<i class="fa fa-cogs" aria-hidden="true"></i>';
    	
        $db                     = getDBO();
        $db->setQuery("SELECT * FROM {$this->_TABLE['conf']} ");
        $rs                     = $db->loadAssocList();
        $rs                     = @$rs[0];
        $user                   = getLogedInUser();    
        $uploadKey              = @$rs['uploadKey'];
        
        $field              = $db->getTableFields(Array( $this->_TABLE['conf'] ));
        $field              = $field[$this->_TABLE['conf']];
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
        $obj->company               = escape_str(strip_tags(request('company')));
        $obj->domain          		= request('domain');
       
        $obj->max_upload_filesize    = request('max_upload_filesize');
        $obj->max_upload_imagesize   = request('max_upload_imagesize');
        $obj->max_upload_vdosize     = request('max_upload_vdosize');
        
        $obj->create_date     		= ChangeTH2En(request('create_date'));
        $obj->reweb_date     		= ChangeTH2En(request('reweb_date'));
        
        $obj->version          		= request('version');
        
        $obj->admin_name          	= request('admin_name');
        $obj->admin_phone          	= request('admin_phone');
        $obj->admin_mail          	= request('admin_mail');
        
        $obj->statcode          	= request('statcode');
        
        $obj->charset          	    = getNamecharset(request('charset'));
        $obj->da_use          		= request('da_use');
        
        $obj->da_host          		= request('da_host');
        $obj->da_port          		= request('da_port');
        $obj->da_user          		= request('da_user');
        $obj->da_pass          		= request('da_pass');
        $obj->SendMailWithSMTP      = request('SendMailWithSMTP');
        $obj->SMTPSecure          	= request('SMTPSecure');
        
        $obj->SMTPHost          	= request('SMTPHost');
        $obj->SMTPPort          	= request('SMTPPort');
        $obj->SMTPAuth          	= request('SMTPAuth');
        $obj->SMTPUsername          = request('SMTPUsername');
        $obj->SMTPPassword          = request('SMTPPassword');
        
        $obj->SMTPFromEmail         = request('SMTPFromEmail');
        $obj->SMTPFromName          = request('SMTPFromName');

        $db                         = getDBO();
        $updated                    = $db->updateObject($this->_TABLE['conf'], $obj, 'id');
        
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

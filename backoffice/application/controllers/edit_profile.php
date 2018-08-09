<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_profile extends CI_Controller {
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
        '_CMD'              => 'edit_profile',
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
       
    	$this->data['iconName'] = '<i class="fa fa-user"></i>';
        $this->data['menuName'] = "แก้ไขข้อมูลส่วนตัว";

        $user                   = getLogedInUser();
        $id                     = $user["id"];
        
        $db                     = getDBO();
        $db->setQuery("SELECT * FROM {$this->_TABLE['info']} WHERE id='{$id}' ");
        $rs                     = $db->loadAssocList();
        $rs                     = @$rs[0];
       
        $uploadKey              = $rs['uploadKey'];
        
        
        
         $db->setQuery("SELECT * FROM {$this->_TABLE['province']}  ORDER BY province_name ASC");
         $porvince_rs = $db->loadAssocList();
         
         $db->setQuery("SELECT * FROM {$this->_TABLE['amphur']} ");
         $amphur_rs = $db->loadAssocList();
          
         $db->setQuery("SELECT * FROM {$this->_TABLE['district']} ");
         $district_rs = $db->loadAssocList();
      
         
         $db->setQuery("SELECT * FROM {$this->_TABLE['users_priv']} ");
         $users_priv_rs = $db->loadAssocList();
         
      
         $db->setQuery("SELECT * FROM {$this->_TABLE['users_class']} ");
         $users_class_rs = $db->loadAssocList(); 
        
        
  
        
        if( @$rs ){
            $this->loadView("{$this->data['_CMD']}/edit", Array(
                'frm'           => $rs,
                'uploadKey'     => $uploadKey,
                'sid'           => $user['sid'],
                'task'          => 'update',
                '_CMD'          => $this->data['_CMD'],
                'table'         => $this->_TABLE,
                'user'          => $user,
            	'porvince_rs'	=> $porvince_rs,
            	'amphur_rs'		=> $amphur_rs,
            	'district_rs'	=> $district_rs,
            	'users_priv_rs'	=> $users_priv_rs,
            	'users_class_rs' => $users_class_rs
            ));
        }
    }
    
    
    
  
    public function update(){
   	
    	$this->data['iconName'] = '<i class="fa fa-user"></i>';
    	$this->data['menuName'] = "แก้ไขข้อมูลส่วนตัว";
    	
    	$obj                        = new Object();
    	
    	$user                   = getLogedInUser();
    	$id                     = $user['id'];
    	
    	$obj->id                = $id;
    	$obj->fullname			= request('fullname');
    	
    	$obj->address			= request('address');
    	$obj->province			= request('province');
    	$obj->amphur			= request('amphur');
    	$obj->district			= request('district');
    	$obj->postcode			= request('postcode');
    	
    	$obj->email				= request('email');
    	$obj->phone				= request('phone');
    	
    	$obj->avatar			= request('display_image');
    	$obj->uploadKey			= request('uploadKey');
    	
        $obj->update_date           = date('Y-m-d H:i:s');
        $obj->update_by             = getLogedInUserId();
        $obj->update_ip             = getIPAddress();
       
        
        $db                         = getDBO();
    	$updated                    = $db->updateObject($this->_TABLE['info'], $obj, 'id');
    	if( $updated ){
    		
    		$db                     = getDBO();
    		$db->setQuery("SELECT * FROM {$this->_TABLE['info']} WHERE id='{$id}' ");
    		$rs                     = $db->loadAssocList();
    		$rs                     = @$rs[0];
    		 
    		$uploadKey              = $rs['uploadKey'];
    		
    		
    		
    		$db->setQuery("SELECT * FROM {$this->_TABLE['province']}  ORDER BY province_name ASC");
    		$porvince_rs = $db->loadAssocList();
    		 
    		$db->setQuery("SELECT * FROM {$this->_TABLE['amphur']} ");
    		$amphur_rs = $db->loadAssocList();
    		
    		$db->setQuery("SELECT * FROM {$this->_TABLE['district']} ");
    		$district_rs = $db->loadAssocList();
    		
    		 
    		$db->setQuery("SELECT * FROM {$this->_TABLE['users_priv']} ");
    		$users_priv_rs = $db->loadAssocList();
    		 
    		
    		$db->setQuery("SELECT * FROM {$this->_TABLE['users_class']} ");
    		$users_class_rs = $db->loadAssocList();
    		
    		
    		
    		
    		if( @$rs ){
    			$this->loadView("{$this->data['_CMD']}/edit", Array(
    					'frm'           => $rs,
    					'uploadKey'     => $uploadKey,
    					'sid'           => $user['sid'],
    					'task'          => 'update',
    					'_CMD'          => $this->data['_CMD'],
    					'table'         => $this->_TABLE,
    					'user'          => $user,
    					'porvince_rs'	=> $porvince_rs,
    					'amphur_rs'		=> $amphur_rs,
    					'district_rs'	=> $district_rs,
    					'users_priv_rs'	=> $users_priv_rs,
    					'users_class_rs' => $users_class_rs,
    					'success'		=> true
    					));
    		}
    		
    	}else{
    		$this->loadView('_system_message_error',Array(
    				'msg'       => lang('Can not update', 'Can not update'),
    				'page'      => base_url().$this->data['_CMD'].'/'
    		));
    	}
    }

    
    

    public function check_emp(){
    	$dbCenter                   = getDBO_center();
    	$dbcen                      = Database::$dbName_center;
    	 
    	$empp = $_POST['emp'];
    	 
    	$dbCenter->setQuery("SELECT count(*) As duplicatemat FROM $dbcen.{$this->_TABLE['empcen']}   WHERE id = '".$empp."' AND employee_out = 'live' LIMIT 1 ");
    	$rs = $dbCenter->loadAssocList();
    	 
    	echo  @$rs[0]['duplicatemat'];
    	 
    }
    
    
    public function check_emp_name(){
    	$db  = getDBO();
    	$dbCenter                   = getDBO_center();
    	$dbcen                      = Database::$dbName_center;
    
    	$emp = $_POST['empname'];
    
    	$dbCenter->setQuery("SELECT prename,name,surname,dept,title FROM $dbcen.{$this->_TABLE['empcen']}   WHERE id = '".$emp."'  AND employee_out = 'live'   LIMIT 1 ");
    	$rs = $dbCenter->loadAssocList();
    	 
    	$emp_name = @$rs[0]['prename']."~".@$rs[0]['name']."  ".@$rs[0]['surname']."~".@$rs[0]['dept']."~".@$rs[0]['title'];
    	 
    	echo  $emp_name;
    }
    
    
    public function chk_emp(){
    	$db  = getDBO();
    	$emp1 = $_POST['emp1'];
    	 
    	$db->setQuery(" SELECT count(id) as numrows FROM users WHERE username = '".$emp1."' AND status <> '2' LIMIT 1 ");
    	$rs = $db->loadAssocList();
    	echo  @$rs[0]['numrows'];
    	 
    	 
    }
    
	public function getAmphur(){
		
		$province_sel = $_POST["province_sel"];
		$db = getDBO();
		
		$db->setQuery("SELECT amphur_id,amphur_name FROM {$this->_TABLE['amphur']} WHERE province_id = '".$province_sel."' ORDER BY amphur_name ASC");
		$rs = $db->loadAssocList();
		
		$sel = '<select name="province" id="province" class="form-control input-sm" >';
		$sel .=  '<option value=""> --- กรุณาเลือกอำเภอ --- </option>';
		
		for($i=0;$i<count($rs);$i++){
			$sel .=  '<option value="'.$rs[$i]["amphur_id"].'">'.$rs[$i]["amphur_name"].'</option>';
		}
		
		$sel .= '</select>';
		
		exit($sel);
	}
	
	public function getDistrict(){
	
		$amphur_sel = $_POST["amphur_sel"];
		$db = getDBO();
	
		$db->setQuery("SELECT district_id,district_name FROM {$this->_TABLE['district']} WHERE amphur_id = '".$amphur_sel."' ORDER BY district_name ASC");
		$rs = $db->loadAssocList();
	
		$sel = '<select name="district" id="district" class="form-control input-sm" >';
		$sel .=  '<option value=""> --- กรุณาเลือกตำบล --- </option>';
	
		for($i=0;$i<count($rs);$i++){
			$sel .=  '<option value="'.$rs[$i]["district_id"].'">'.$rs[$i]["district_name"].'</option>';
		}
	
		$sel .= '</select>';

		exit($sel);
	}
    
	
	public function getPostcode(){
		
		$district_sel = $_POST["district_sel"];
		$db = getDBO();
		
		$db->setQuery("SELECT zipcode FROM {$this->_TABLE['zipcode']} WHERE district_id = '".$district_sel."' LIMIT 1");
		$rs = $db->loadAssocList();
		
		exit(@$rs[0]["zipcode"]);
			
	}
	
	
	public function getUserclass(){
	
		$priv_sel = $_POST["priv_sel"];
		$db = getDBO();
	
		$db->setQuery("SELECT class_value,class_name FROM {$this->_TABLE['users_class']} WHERE class_priv = '".$priv_sel."' ");
		$rs = $db->loadAssocList();
	
		$sel = '<select name="userclass" id="userclass" class="form-control input-sm" >';
		$sel .=  '<option value=""> --- กรุณาเลือกกลุ่ม --- </option>';
	
		for($i=0;$i<count($rs);$i++){
			$sel .=  '<option value="'.$rs[$i]["class_value"].'">'.$rs[$i]["class_name"].'</option>';
		}
	
		$sel .= '</select>';
	
		exit($sel);
	}
	
	
	public function updateSingleDel(){
		$db             = getDBO();
	
		$db->setQuery("SELECT id,filepath FROM {$this->_TABLE['file']} WHERE uploadKey IN (SELECT uploadKey FROM {$this->_TABLE['file']} WHERE id  ='{$_REQUEST['attact_id']}' AND attact_type ='{$_REQUEST['attact_type']}' ) AND id  <> '{$_REQUEST['attact_id']}' AND status = '1' ");
		$rs = $db->loadAssocList();
	
		$len = count($rs);
		$sql = "";
	
		for($i=0;$i<$len;$i++){
	
			if($i==0){
				$sql .= " IN('".$rs[$i]["id"]."'";
			}else{
				$sql .= ",'".$rs[$i]["id"]."'";
			}
	
			if($i==($len-1)){
				$sql .= ") ";
			}
	
			 unlink('../'.$rs[$i]["filepath"]);
		}
	
		if($len){
			$db->setQuery("UPDATE {$this->_TABLE['file']} SET status = '2' WHERE id {$sql} ");
			$db->Query();
		}
	
	}
	

    
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Authentication extends CI_Controller{
        
        
        
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('string');
            $this->load->language('authen');
        }
        
        
        
        public function index(){
            $this->load->view('login');
        }
		
		 public function index2(){
            $this->load->view('login_backup');
        }
        
        
        
        public function login(){
            $username               = strip_slashes(strip_quotes(strip_tags(request('username'))));
            $password               = md5(strip_slashes(strip_quotes(strip_tags(request('password')))));
            $db                     = getDBO();
            $db->setQuery(" SELECT          id 
                            FROM            users 
                            WHERE           username='{$username}'  AND 
                                            password='{$password}'  AND
                                            (
                                                (
                                                    priv='admin'
                                                )   OR
                                                (
                                                    priv='".Site::$priv.Site::$local_id."'
                                                )
                                            )
                                            AND status = '1'
                            ");
            $rs                     = $db->loadAssocList();
            if( count($rs)>0 ){
                $rs                 = $rs[0];                 
                $_SESSION[SESSION_LOGIN]               = true;
                $_SESSION[SESSION_USER_ID] = $rs['id'];
                $_SESSION[SESSION_LOGIN_SID]           = md5(time());
		        $_SESSION['user-order'] = $_SESSION[SESSION_LOGIN_SID] ;
                $db->setQuery("
                    UPDATE          users
                    SET             sid='{$_SESSION[SESSION_LOGIN_SID]}',
                                    ip_login='".  getIPAddress()."',
                                    last_login='".date('Y-m-d H:i:s')."'
                    WHERE           id='{$_SESSION[SESSION_USER_ID]}' ;
                ");
                $db->query();    
                /*
                $this->load->view   (   '_system_message',
                                        Array(
                                            'msg'=>'Loged in successfull.',
                                            'page'=>base_url()
                                        )
                                    );
                 * 
                 */
                
                header('Location: '.base_url());
            }else{
                echo false;
                exit();
            }
        }
        
        
        
        public function logout(){
            unset($_SESSION[SESSION_LOGIN]);
            unset($_SESSION['user-order']);
            header('Location: '.base_url());
            exit();
            /*
            $this->load->view   (   '_system_message',
                                        Array(
                                            'msg'=>'ออกจากระบบแล้ว',
                                            'page'=>base_url()
                                        )
                                    );
             * 
             */
        }
        
        
        
        
    }

?>

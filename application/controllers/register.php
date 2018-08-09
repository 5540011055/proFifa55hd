<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Register extends CI_Controller {
	
	/**
	 *
	 * @var Array All Available tables
	 */
	public $_TABLE = Array (
			'info' => 'register_information',
			'file' => '',
			'category' => '' 
	);
	public $data = Array (
			'_CMD' => 'register',
			'body' => '',
			'menuName' => ''  
	);
	public $maxRows = 20;
	public $avialableTag = '<p><a><img><span><div><table><tbody><tr><td><th><ul><li><qoute><font><ol><style><strong><em><u><i><h4><h5><h6>';
	/*
	 * Predined methods
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		
		$this->lang->load($_ENV['lang_type']);
		setPicContent($this->lang->line("register"));
	}
	private function loadView($view = null, $viewData = Array()) {
		if ($view != null) {
			if (! @$viewData ['data']) {
				$viewData ['data'] = $this->data;
			}
			ob_start ();
			$this->load->view ( $view, $viewData );
			$subView = ob_get_clean ();
			$this->data ['body'] = $subView;
		}
		$this->load->view ( $view, $this->data );
	}
	private function getView($view = null, $viewData = Array()) {
		ob_start ();
		$this->load->view ( $view, $viewData );
		return ob_get_clean ();
	}
	public function index() {
		$this->showList ();
	}
	public function download() {
		$this->updateFileHit ( request ( 'id' ) );
		download ( request ( 'file' ), request ( 'name' ) );
		exit ();
	}
	public function updateFileHit($id) {
		$db = getDBO ();
		$db->setQuery ( "UPDATE {$this->_TABLE['file']} SET hits=hits+1 WHERE id='{$id}' " );
		$db->query ();
	}
	public function updateHit($id) {
		$db = getDBO ();
		$db->setQuery ( "UPDATE {$this->_TABLE['info']} SET hits=hits+1 WHERE id='{$id}' " );
		$db->query ();
	}
	public function showList() {
		
		
		
		$arr = Array (
				'db' => getDBO () 
		);
		$this->loadView ( 'view_sub', Array (
				'VIEW_BODY' => $this->getView ( $this->data ['_CMD'] . '/showlist' )
		) );
	}
	
	
	public function code_exits(){
	
		$keyword = @$_POST["keyword"];
	
		$db = getDBO();
		$db->setQuery("SELECT count(id) As chk FROM {$this->_TABLE['info']} WHERE phone  = '".$keyword."' AND status <> '2' ");
		$rs = $db->loadAssocList();
	
		echo @$rs[0]["chk"];
		exit();
	}
	
	
	
	function sendEmail( $subject, $message, $from) {
		
		$recipient = getGeneralConfig("company_email");
	
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'To: <' . $recipient . '>' . "\r\n";
		$headers .= 'From: <' . $from . '>' . "\r\n";
		$headers .= 'Cc:' . "\r\n";
		$headers .= 'Bcc: ' . "\r\n";
		

		if (@mail( $recipient, $subject, $message, $headers )) {
			$msg = "yes";
		} else {
			$msg = "no";
		}
		return $msg;

	}
	
	
	
	public function send_ajax() {
		
		$regist_name 		= $_POST["regist_name"];
		$regist_phone 		= $_POST["regist_phone"];
		$regist_line		= $_POST["regist_line"];
		 
		$registfrom     = $this->lang->line("registfrom");
		 
		 
		$message = '<html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            </head>
	            <body>
	            <style type="text/css">
	            body,td,th {
	                    font-size: 14px;
	                    font-family: Arial, Helvetica, sans-serif;
	                    max-width: 600px;
 	    			    line-height: 1.6;
	            }
	            fieldset{
	                    width:350px;
	                    padding:5px;
	            }
	            </style>
	            <h3>'.$registfrom.' '.getConfig('domain'). '</h3> <br />
	            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-register">
	       
	      
				<tr>
					<td width="3%" align="left" valign="middle">&nbsp;</td>
					<td width="20%" align="left" valign="middle">'.$this->lang->line("txt-name").' :</td>
					<td align="left" valign="middle">
						'.$regist_name.'
					</td>
				</tr>
		
				<tr>
					<td width="3%" align="left" valign="middle">&nbsp;</td>
					<td width="20%" align="left" valign="middle">'.$this->lang->line("txt-phone").' :</td>
					<td align="left" valign="middle">
						'.$regist_phone.'
					</td>
				</tr>
		
				<tr>
					<td width="3%" align="left" valign="middle">&nbsp;</td>
					<td width="20%" align="left" valign="middle">'.$this->lang->line("lineid").' :</td>
					<td align="left" valign="middle">
						'.$regist_line.'
					</td>
				</tr>
		
				</table>
	            </body>
            </html>
          ';
 	    	
 	    	$msg = $this->sendEmail ('Register : ' . getConfig ( 'domain' ), $message,$email );
 	    	
 	    	$obj                           = new Object();
 	    	$db							   = getDBO();
 	    	
 	    	
 	    	$obj->name  		= $regist_name;
 	    	$obj->phone 		= $regist_phone;
 	    	$obj->line_id 		= $regist_line;
 	    		
 	    	
 	    	$obj->create_date           = date('Y-m-d H:i:s');
 	    	$obj->create_ip             = getIPAddress();
 	    	$obj->status					= 0;
 	    	
 	    	$updated = $db->insertObject($this->_TABLE['info'], $obj);
 	    	 
 	    	echo $msg;
 	    	exit();
	}
	

}
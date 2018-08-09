<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Contactus extends CI_Controller {
	
	/**
	 *
	 * @var Array All Available tables
	 */
	public $_TABLE = Array (
			'info' => 'contact_information',
			'file' => '',
			'category' => '' 
	);
	public $data = Array (
			'_CMD' => 'contactus',
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
		setPicContent($this->lang->line("contactus"));
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
	public function detail() {
		$id = getParam ( 3, 0 );
		$this->updateHit ( $id );
		if (! $id) {
			exit ( '' );
		}
		$db = getDBO ();
		$db->setQuery ( "SELECT * FROM {$this->_TABLE['info']} WHERE id='{$id}' " );
		$rs = $db->loadAssocList ();
		if (! $rs) {
			exit ( '' );
		}
		fullThaiDate ( $rs [0] ['create_date'] );
		$db->setQuery ( " SELECT          i.*, c.cate_name
                        FROM            {$this->_TABLE['info']}         AS i,
                                        {$this->_TABLE['category']}     AS c
                        WHERE           i.id<>'{$id}'       AND
                                        i.status='1'        AND
                                        i.cid=c.id          AND
                                        c.status='1'
                        ORDER BY        i.id DESC
                        LIMIT           5
                        " );
		$otherNews = $db->loadAssocList ();
		$data = Array (
				'table' => $this->_TABLE,
				'rs' => $rs [0],
				'otherNews' => $otherNews 
		);
		$this->loadView ( 'sub', Array (
				'VIEW_BODY' => $this->getView ( $this->data ['_CMD'] . '/showlist' )
			
		) );
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
	
	
	
	public function sendmail_ajax() {
		
			$contact_name 		    = $_POST["contact_name"];
			$contact_detail 		= $_POST["contact_detail"];
			$contact_phone			= $_POST["contact_phone"];
 	    	
 	    	$phd_phone 		= $this->lang->line("phd-phone");
 	    	$phd_mail  		= $this->lang->line("phd-mail");
 	    	$contactform    = $this->lang->line("contactform");
 	    	$call_contact   = $this->lang->line("call_contact");
 	    	
 	    	// <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 	    	
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
	            <h3>'.$contactform.' '.getConfig('domain'). '</h3> <br />
	            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-register">
	            		
	            
				<tr>
					<td width="3%" align="left" valign="middle">&nbsp;</td>
					<td width="20%" align="left" valign="middle">'.$this->lang->line("txt-conatct-name").' :</td>
					<td align="left" valign="middle">
						'.$contact_name.'
					</td>
				</tr>
								
				<tr>
					<td width="3%" align="left" valign="middle">&nbsp;</td>
					<td width="20%" align="left" valign="middle">'.$this->lang->line("txt-phone").' :</td>
					<td align="left" valign="middle">
						'.$contact_phone.'
					</td>
				</tr>
								
				<tr>
					<td width="3%" align="left" valign="middle">&nbsp;</td>
					<td width="20%" align="left" valign="middle">'.$this->lang->line("txt-detail").' :</td>
					<td align="left" valign="middle">
						'.$contact_detail.'
					</td>
				</tr>
				
				</table>
	            </body>
            </html>
          ';
 	    	
 	    	
 	    	$msg = $this->sendEmail ('Contact Us : ' . getConfig ( 'domain' ), $message,$email );
 	    	
 	    	//if($msg=="yes"){
	 	    	$obj                           = new Object();
	 	    	$db							   = getDBO();
	 	    	
	 	    	$obj->name                  	= $contact_name;
	 	    	$obj->phone                  	= $contact_phone;
	 	    	$obj->message                   = $contact_detail;
	 	    	
	 	    	$obj->create_date           = date('Y-m-d H:i:s');
	 	    	$obj->create_ip             = getIPAddress();
	 	    	
	 	    	$obj->status					= 0;
	 	    	
	 	    	$ins = $db->insertObject($this->_TABLE['info'], $obj);
 	    	// }
 	    	 	    	
		echo $ins;	 
		exit();
	}
	

}
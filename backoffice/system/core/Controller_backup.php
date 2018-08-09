<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
                
                $task           = getParam(2);
                $controller     = getParam(1);
                /* Upload */
                //dumpAll(getAllParam());
                if( $task=='upload' && checkSID() ){
                    uploadFile();
                }
                /* Login page */
                else if( !isLogedin()  &&  $controller!='authentication' ){
                    header('Location: '. base_url(). 'authentication');
                    return;
                }
                
                if( isLogedin() ){
                    $currentSID             = $_SESSION[SESSION_LOGIN_SID];
                    $db                     = getDBO();
                    $db->setQuery(" SELECT * FROM users WHERE sid='{$currentSID}' AND status='1' ");
                    if( !$db->loadAssocList() ){
                        header('Location: '. base_url(). 'authentication/logout/');
                        return;
                    }
                }
                
                setShowTooltip(true);


                /* Check permisson */                    
                $xmlPath            = "./application/controllers/{$controller}.xml";
                $xml                    = @simplexml_load_file($xmlPath);
                $usr                    = getLogedInUser();
                if($xml){
                    $permission         = @$xml->permission;
                    //exit(pre($permission));
                    if( $xml->permission  &&  @$xml->permission->userclass ){
                        if( $usr['userclass']!=$xml->permission->userclass ){
                            echo 'No permission access allowed !'; br();
                            exit();
                        }
                    }
                    /* Check Tab permission */
                    if($task){
                        $len_menu                   = count($xml->menu);
                        for( $i=0;  $i<$len_menu;  $i++ ){
                            if($xml->menu[$i]->attributes()->module==$task){
                                if( @$xml->menu[$i]->attributes()->permission  &&  
                                    $xml->menu[$i]->attributes()->permission!=$usr['userclass'] ){
                                    echo 'No permission access allowed !'; br();
                                    exit();
                                }
                            }
                        }
                    }
                }
                /* Checked permisson */
                    
                    
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
        
        public function setMenuName($name){
            if(@$this->data['menuName']){
                $this->data['menuName']             = $name;
            }else{
                exit("\$this->data['menuName'] not found");
            }
        }
        
        
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */
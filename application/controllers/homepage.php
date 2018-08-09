<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {

    /**
     *
     * @var Array All Available tables 
     */
    public $_TABLE              = Array(
        'info'              => '',
        'file'              => '',
        'category'          => ''
    );
    public $data                = Array(
        '_CMD'              => 'homepage',
        'body'              => '',
        'menuName'          => ''
    );
    public $cache               = false;
    public $cache_var           = "";
    public $maxRows             = 20;
    public $avialableTag        = '<p><a><img><span><div><table><tbody><tr><td><th><ul><li><qoute><font><ol><style><strong><em><u><i><h4><h5><h6>'; 
    /*
     * Predined methods
     */
    public function __construct() {
        parent::__construct();        
        $this->load->helper('url');
        if( $this->cache ){
            $this->cache_var    = 'cache-'.$this->data['_CMD'].'-'.  getParam(2, 'showlist');            
        }
    }    
    private function loadView($view=null, $viewData=Array()){  
        ob_start();
        if($view!=null){
            if(!@$viewData['data']){$viewData['data']=$this->data;}
            ob_start();
            $this->load->view($view, $viewData);  
            $subView            = ob_get_clean();
            $this->data['body'] = $subView;
        }
        $this->load->view( $view, $this->data );  
        $output             = ob_get_clean();
        echo $output;
        exit();
    }
    private function getView($view=null, $viewData=Array()){
        ob_start();
        $this->load->view($view, $viewData);  
        return ob_get_clean();
    }
    public function index(){
    	$this->lang->load($_ENV['lang_type']);
        $this->main();
    }
    
    
    /*************************************** same main.php ********************************************/
    
    public function main(){      
        $arr                        = Array('db'=>getDBO());        
        $this->loadView('view_homepage',
                        Array(
                        	 'VIEW_HEADER'             	=> $this->getView('homepage/header',$arr),
                        	 'VIEW_BANNER'             	=> $this->getView('homepage/banner',$arr),
                        	 'VIEW_TALK'	            => $this->getView('homepage/talk',$arr),
                        	 'VIEW_SERVICE'        	    => $this->getView('homepage/service',$arr),
                        	 'VIEW_REGISTER_GUIDE'      => $this->getView('homepage/register_guide',$arr), 		
                             'VIEW_REGISTER'        	=> $this->getView('homepage/register',$arr),
                        	 'VIEW_PROMOTION'        	=> $this->getView('homepage/promotion',$arr),
                        	 'VIEW_ABOUTUS'        	    => $this->getView('homepage/aboutus',$arr),
                        	 'VIEW_FEATURE'        	    => $this->getView('homepage/feature',$arr),
                        	 'VIEW_BANNERSERVICE'       => $this->getView('homepage/bannerservice',$arr),
                        	 'VIEW_NEWS'       			=> $this->getView('homepage/news',$arr),	
                        	 'VIEW_WITHDRAW'			=> $this->getView('homepage/withdraw',$arr),
                        	 'VIEW_CONTACTUS'			=> $this->getView('homepage/contactus',$arr),
                        	 'VIEW_BREADCRUMB'			=> $this->getView('homepage/breadcrumb',$arr),
                        	 'VIEW_FOOTER'				=> $this->getView('homepage/footer',$arr),
                        	 'VIEW_MENUPHONE'			=> $this->getView('homepage/menuphone',$arr)
                        	 
                        ));
    }
       
    /************************************************************************************************************/
    
}
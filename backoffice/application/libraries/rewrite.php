<?php
    class Rewrite{
        private $val = null;
        function getParameter($index,$default=''){
            try{
                if(@$_SERVER['PATH_INFO']){
                    if( $this->val==null ){
                        $buf                = explode('/', $_SERVER['PATH_INFO']);
                        if( count($buf)<1 ){
                            throw new Exception("URL not found({$_SERVER['PATH_INFO']})");
                        }
                        foreach ($buf AS $v){
                            if($v!=''){
                                $this->val[]   = $v;
                            }
                        }    
                    }
                    
                    $index--;
                    return @trim($this->val[$index]) ? trim($this->val[$index]) : $default ;
                }else{
                    if( $this->val==null ){
                        $a			= current_url();
                        $a			= explode('index.php', $a);
                        $a			= explode('/',@$a[1]);
                        $this->val = array();
                        foreach($a as $v){
                            if($v){
                                    $this->val[]=$v;
                            }
                        }
                    } 
                    $index--;
                    return (@trim($this->val[$index]))?@$this->val[$index]:$default;
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        
        
        function getAllParam(){
            return $this->val;
        }
    }
    
    
    function getRewriteObject(){
        if(!isset($_ENV['system-rewrite'])){
            $obj                    = new Rewrite();
            $_ENV['system-rewrite']    = &$obj;
        }
        return $_ENV['system-rewrite'];
    }
    
    
    function getParam($index,$default=''){
        $obj            = getRewriteObject();
        return $obj->getParameter($index, $default);
    }
    
    
    function getAllParam(){
        $obj            = getRewriteObject();
        return $obj->getAllParam();
    }
?>
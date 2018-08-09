<?php


    class Param{
        
        public function get($key, $defaultValue=''){
            return @$_GET[$key]?$_GET[$key]:$defaultValue;
        }
        
        public function post($key, $defaultValue=''){
            return @$_POST[$key]?@$_POST[$key]:$defaultValue;
        }
        
        
        public function request($key, $defaultValue=''){
            return @$_REQUEST[$key]?@$_REQUEST[$key]:$defaultValue;
        }
        
        public function env($key, $defaultValue=''){
            return @$_ENV[$key]?@$_ENV[$key]:$defaultValue;
        }
        
    }
    
    
    function getParamObj(){
        if( !@$_ENV['system-param'] ){
            $obj                        = new Param();
            $_ENV['system-param']       = &$obj;
        }
        return $_ENV['system-param'];
    }
    
    
    
    function get($key, $defaultValue=''){
        $obj                = getParamObj();
        return $obj->get($key, $defaultValue);
    }
    
    
    
    function post($key, $defaultValue=''){
        $obj                = getParamObj();
        return $obj->post($key, $defaultValue);
    }
    
    
    
    function request($key, $defaultValue=''){
        $obj                = getParamObj();
        return $obj->request($key, $defaultValue);
    }
    
    
    
    function env($key, $defaultValue=''){
        $obj                = getParamObj();
        return $obj->env($key, $defaultValue);
    }
    
?>
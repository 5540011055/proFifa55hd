<?php
    class IPAddress{
        public function getIPAddress(){
            if (@isset($_SERVER['HTTP_CLIENT_IP'])) { 
                @$IP = $_SERVER['HTTP_CLIENT_IP'];
            }elseif($_SERVER["REMOTE_ADDR"]) { 
                @$IP = $_SERVER["REMOTE_ADDR"];
            }else{
                @$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
            }
            $IP = preg_split("/,/",$IP);
            return  $IP[count($IP)-1];
        }
        public function hideIP($ip){
            $ips = explode(".",$ip);
            $ret = $ips[0] . "." . $ips[1] . "." . $ips[2] . ".";
            for($i=0;$i<strlen($ips[3]);$i++){
                    $ret .= "x"	;
            }
            return $ret;
        }
    }
    
    
    
    
    function getIPAddressObject(){
        if(!isset($_ENV['system-IPAddress'])){
            $obj                    = new IPAddress();
            $_ENV['system-IPAddress']    = &$obj;
        }
        return $_ENV['system-IPAddress'];
    }
    
    
    function getIPAddress(){
        $obj                    = getIPAddressObject();
        return $obj->getIPAddress();
    }
    
    
    function hideIP($ip){
        $obj                    = getIPAddressObject();
        return $obj->hideIP($ip);
    }
    
    
    
    
?>
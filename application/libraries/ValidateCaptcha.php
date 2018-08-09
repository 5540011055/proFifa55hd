<?PHP
    class ValidateCaptcha{	
        function validatecode()
        {
            /*
            $code111=$_POST['security_code'];
            $code=md5($code111);
            $code2=str_replace(".","_",$code111);
            $verify=$_SESSION[$code];
            session_unregister($code);

            if(!$code){
                    return false;	
            }
            if(!$verify){
                    return false;	
            }

            if($verify == strtolower($_POST[$code2])) {
                    return true;
            }else{
                    return false;
            }
            */
            $secureCode_real                = @$_SESSION['security_code'];
            $secureCode_post                = @$_REQUEST['security_code'];
            unset($_SESSION['security_code']);
            if($secureCode_real!='' && $secureCode_real==$secureCode_post){
                return true;
            }
            return false;
        }
    }
?>
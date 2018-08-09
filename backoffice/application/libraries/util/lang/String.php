<?php
	class String{
            
		public static function startWith($haystack, $needle){
			IF( strlen($haystack)>=strlen($needle) ) :
				$buf		= substr($haystack, 0, strlen($needle));
				if($buf==$needle)
					return true;
			ENDIF;
			return false;
		}
                
		public static function endWith($haystack, $needle){
			IF($haystack>=$needle):
				$buf		= substr($haystack, -strlen($needle), strlen($needle));
				if($buf==$needle)
					return true;
			ENDIF;
			return false;
		}
                
                
                
                public static function appendStringAt($appendWord, $index, $data){
                    $len            = strlen($data);
                    $buf            = "";
                    for( $i=0;  $i<$len;  $i++ ){
                        if( $i!=0 && $i%$index==0 ){
                            $buf    .=(substr($data, $i, 1).$appendWord);
                        }else{
                            $buf    .=(substr($data, $i, 1));
                        }
                    }
                    return $buf;
                }
                
                
	}
?>
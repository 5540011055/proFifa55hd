<?PHP      

    class HTML{
        
        public function pre($arr){
            echo "<pre>";		
            var_dump($arr);	
            echo "</pre>";
        }
        
        public function br($loop=1){
            for( $i=0;  $i<$loop;  $i++ ){echo '<br />';}            
        }
        
        public function hr($style=''){
            echo '<hr style="'.$style.'" />';
        }
        
        public function stripTagDescription($data){
            return strip_tags($data,'<p><a><img><span><div><table><tbody><tr><td><th><ul><li><qoute><font><ol><style><strong><em><u><i><h4><h5><h6><br>');
        }
        
    }
    
    
    
    function getHTMLObject(){
        if(!isset($_ENV['system-html'])){
            $obj                    = new HTML();
            $_ENV['system-html']    = &$obj;
        }
        return $_ENV['system-html'];
    }
    
    
    
    function pre($arr){
        $obj        = getHTMLObject();
        $obj->pre($arr);
    }
    
    
    
    function hr($style=''){
        $obj        = getHTMLObject();
        $obj->hr($style);
    }
    
    
    
    function br($loop=1){
        $obj        = getHTMLObject();
        $obj->br($loop);
    }
    
    
    
    function getDescription($id, $name, $value='', $height=320){
        $output             = '
            <div style="max-width:821px; !important;"><textarea id="'.$id.'" name="'.$name.'" >'.$value.'</textarea></div>
            <script> 
            		  CKEDITOR.env.isCompatible = true;
            		  CKEDITOR.replace( "'.$name.'",{height: '.$height.'} );
           </script>
        ';
        return $output;
    }
    
    
    
?>
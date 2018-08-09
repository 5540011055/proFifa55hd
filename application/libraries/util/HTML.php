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
        
        
        public function nbsp($loop=1){
            for( $i=0;  $i<$loop;  $i++ ){echo '&nbsp;';}            
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
    
    
    function nbsp($loop=1){
        $obj        = getHTMLObject();
        $obj->nbsp($loop);
    }
    
    
    
    function getDescription($id, $name, $value='', $height=500){
        $output             = '
            <textarea id="'.$id.'" name="'.$name.'">'.$value.'</textarea>
            <script>
                $("#'.$id.'").tinymce({
                    script_url : "'.  base_url().'js/tiny_mce/tiny_mce.js",
                    // General options
                    theme : "advanced",
                    height: '.$height.',
                    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

                    // Theme options
                    theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_resizing : true,
                    // Drop lists for link/image/media/template dialogs
                    template_external_list_url : "lists/template_list.js",
                    external_link_list_url : "lists/link_list.js",
                    external_image_list_url : "lists/image_list.js",
                    media_external_list_url : "lists/media_list.js"
                });
            </script>
        ';
        return $output;
    }
    
    
    
?>
<?php
    class Download{
        public function retriveFile($file, $name){
            //$file           = request('file');
            //$name           = request('name');
            $file           = str_replace('\\', '/', $file);
            $file           = str_replace('//', '/', $file);
            $buf            = explode('/', $file);
            $ext            = explode('.', $buf[count($buf)-1]);
            $ext            = $ext[1];
            switch($ext){
                case 'php'          :       case 'html'         :
                case 'htm'          :       case 'js'           :
                case 'css'          :       case 'htaccess'     :
                case 'xml'          :       case 'crt'          :
                case 'ini'          :
                case 'sql'          :
                    exit('Don\' allow access.');
                    break;
            }
            //First, see if the file exists
            if (!is_file($file)) { die("<b>404 File not found! $file</b>"); }
            //Gather relevent info about file
            $len = filesize($file);
            $filename = basename($file);
            $info = pathinfo($filename);
            if(!$name){
                $name   = $filename;
            }
            //Begin writing headers
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public"); 
            header("Content-Description: File Transfer");
            //Force the download
            $header="Content-Disposition: attachment; filename=".urlencode($name).";";
            header($header );
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".$len);
            @readfile($file);
            exit;
        }
    }
    
    
    
    function getDownloadObject(){
        if( !@$_ENV['system-download'] ){
            $obj                        = new Download();
            $_ENV['system-download']    = &$obj;
        }
        return $_ENV['system-download'];
    }
    
    
    
    function download($file, $name){
        $obj            = getDownloadObject();
        $obj->retriveFile($file, $name);
    }
?>

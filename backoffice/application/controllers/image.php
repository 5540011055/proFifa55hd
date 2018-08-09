<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Image extends CI_Controller {
        
        private $_tempDir               = './tmp/';
        
        
        private function initial(){
            /* Check tmp Directory */
            if(!file_exists($this->_tempDir) ){
                $is_made        = mkdir($this->_tempDir, 0777);
                @chmod($this->_tempDir, 0777);
                if(!$is_made){
                    return false;
                }
            }
        }
        
        
        public function ratio(){
            $this->initial();
            $this->load->helper('string');
            $file               = request('file','');
            $defaultImage       = request('defaultImage', 'images/nopic.jpg');
            $maxWidth           = request('width', 100);
            $maxHeight          = request('height', 100);
            $extension          = '';
            if(trim($file)=='' || !file_exists($file)){$file= $defaultImage;}
            if(strstr($file, 'http')    ||  strstr($file, 'ftp')){
                $fileInfo       = pathinfo($file);
                $filePath       = "./tmp/".md5($file).".{$fileInfo['extension']}";
                if(!file_exists($filePath)){
                    $extension      = "image/{$fileInfo['extension']}";
                    $f              = @fopen($filePath, 'w');
                    fwrite($f, file_get_contents($file));
                    @fclose($f);
                }        
                $file           = $filePath;
                $filePath       = null;
                $fileInfo       = null;
            }
            if(!$extension){
                $extension      = pathinfo($file);
                $extension      = $extension['extension'];
            }      
            
            $tmpFile            = $this->_tempDir. md5($file.'ratio'.$maxWidth.$maxHeight). '.' .$extension;
            if(!file_exists($tmpFile)){
                $config['image_library']    = 'gd2';
                $config['source_image']     = $file;
                $config['new_image']        = $tmpFile;
                $config['create_thumb']     = false;
                $config['maintain_ratio']   = true;
                $config['width']            = $maxWidth;
                $config['height']           = $maxHeight;
                $this->load->library('image_lib', $config); 
                $this->image_lib->initialize($config); 
                if ( ! $this->image_lib->resize()){
                    exit($this->image_lib->display_errors());
                }  
            }        
            $img                = null;
            switch($extension){
                case 'png'  : {$img=@imagecreatefrompng($tmpFile); break;}
                case 'gif'  : {$img=@imagecreatefromgif($tmpFile); break;}
                case 'jpg'  : 
                default     : {$img=@imagecreatefromjpeg($tmpFile); break;}
            }
            header ("Content-type: image/{$extension}");
            switch($extension){
                case 'png'  : {@imagepng($img);break;}
                case 'gif'  : {@imagegif($img);break;}
                case 'jpg'  : 
                default     : {@imagejpeg($img);break;}
            }
            @imagedestroy($img);
            //@unlink($tmpFile);
            exit();
        }
      
	  
	    public function ratiofix(){
            $this->initial();
            $this->load->helper('string');
            $file               = request('file','');
            $defaultImage       = request('defaultImage', 'images/nopic.jpg');
            $maxWidth           = request('width', 100);
            $maxHeight          = request('height', 100);
            $extension          = '';
            if(trim($file)=='' || !file_exists($file)){$file= $defaultImage;}
            if(strstr($file, 'http')    ||  strstr($file, 'ftp')){
                $fileInfo       = pathinfo($file);
                $filePath       = "./tmp/".md5($file).".{$fileInfo['extension']}";
                if(!file_exists($filePath)){
                    $extension      = "image/{$fileInfo['extension']}";
                    $f              = @fopen($filePath, 'w');
                    fwrite($f, file_get_contents($file));
                    @fclose($f);
                }        
                $file           = $filePath;
                $filePath       = null;
                $fileInfo       = null;
            }
            if(!$extension){
                $extension      = pathinfo($file);
                $extension      = $extension['extension'];
            }      
            
            $tmpFile            = $this->_tempDir. md5($file.'ratio'.$maxWidth.$maxHeight). '.' .$extension;
            if(!file_exists($tmpFile)){
                $config['image_library']    = 'gd2';
                $config['source_image']     = $file;
                $config['new_image']        = $tmpFile;
                $config['create_thumb']     = true;
                $config['maintain_ratio']   = false;
                $config['width']            = $maxWidth;
                $config['height']           = $maxHeight;
				
                $this->load->library('image_lib', $config); 
                $this->image_lib->initialize($config); 
                if ( ! $this->image_lib->resize()){
                    exit($this->image_lib->display_errors());
                }  
            }        
            $img                = null;
            switch($extension){
                case 'png'  : {$img=@imagecreatefrompng($tmpFile); break;}
                case 'gif'  : {$img=@imagecreatefromgif($tmpFile); break;}
                case 'jpg'  : 
                default     : {$img=@imagecreatefromjpeg($tmpFile); break;}
            }
            header ("Content-type: image/{$extension}");
            switch($extension){
                case 'png'  : {@imagepng($img);break;}
                case 'gif'  : {@imagegif($img);break;}
                case 'jpg'  : 
                default     : {@imagejpeg($img);break;}
            }
            @imagedestroy($img);
            //@unlink($tmpFile);
            exit();
        }
        
        public function fix(){
            $this->initial();
            $this->load->helper('string');
            $file               = request('file','');
            $defaultImage       = request('defaultImage', 'images/nopic.jpg');
            $maxWidth           = request('width', 100);
            $maxHeight          = request('height', 100);
            if($file==''){$file= $defaultImage;}
            if(!file_exists($file)){$file= $defaultImage;}
            $tmpFile            = $this->_tempDir. md5($file.'fix'.$maxWidth.$maxHeight). '.png';
            if(!file_exists($tmpFile)){
                $config['image_library']    = 'gd2';
                $config['source_image']     = $file;
                $config['new_image']        = $tmpFile;
                $config['create_thumb']     = false;
                $config['maintain_ratio']   = true;
                $config['width']            = $maxWidth;
                $config['height']           = $maxHeight;
                $this->load->library('image_lib', $config); 
                $this->image_lib->initialize($config); 
                if ( ! $this->image_lib->resize()){
                    exit($this->image_lib->display_errors());
                }  
            }                           
            $img                            = imagecreatefrompng($tmpFile);
            header ("Content-type: image/png");
            imagepng($img);
            imagedestroy($img);
            //@unlink($tmpFile);
            exit();
        }
        
        
        
        public function watermask(){            
            $this->initial();
            $this->load->helper('string');
            $file               = request('file','');
            $defaultImage       = request('defaultImage', 'images/nopic.jpg');
            $maxWidth           = request('width', 100);
            $maxHeight          = request('height', 100);
            if($file==''){$file= $defaultImage;}
            if(!file_exists($file)){$file= $defaultImage;}
            $tmpFile            = $this->_tempDir. random_string('alnum', 16). '.png';
            $config['image_library']    = 'gd2';
            $config['source_image']	= $file;
            $config['new_image']        = $tmpFile;
            $config['wm_text'] = 'Copyright Cityvariety';
            $config['wm_type'] = 'text';
            $config['wm_font_path']     = './system/fonts/texb.ttf';
            $config['wm_font_size']	= '16';
            $config['wm_font_color']    = 'ffffff';
            $config['wm_vrt_alignment'] = 'bottom';
            $config['wm_hor_alignment'] = 'center';
            //$config['wm_padding'] = '20';
            $config['width']            = $maxWidth;
            $config['height']           = $maxHeight;
            $config['create_thumb']     = false;
            $config['maintain_ratio']   = true;
            
            
            $this->load->library('image_lib', $config); 
            $this->image_lib->initialize($config); 
            if ( ! $this->image_lib->watermark()){
                exit($this->image_lib->display_errors());
            }            
            $img                        = imagecreatefrompng($tmpFile);
            header ("Content-type: image/png");
            imagepng($img);
            imagedestroy($img);
            @unlink($tmpFile);
            exit();
        }
        
        
        
        public function orginal(){
            $file               = request('file','');
            $defaultImage       = request('defaultImage', 'images/nopic.jpg');            
            if($file==''){
                $file           = $defaultImage;
            }
            $extension      = pathinfo($file);
            $extension      = $extension['extension'];
            switch($extension){
                case 'png'  : {$img=@imagecreatefrompng($file); break;}
                case 'gif'  : {$img=@imagecreatefromgif($file); break;}
                case 'jpg'  : 
                default     : {$img=@imagecreatefromjpeg($file); break;}
            }
            header ("Content-type: image/{$extension}");
            switch($extension){
                case 'png'  : {@imagepng($img);break;}
                case 'gif'  : {@imagegif($img);break;}
                case 'jpg'  : 
                default     : {@imagejpeg($img);break;}
            }
            imagedestroy($img);
            exit();
            
            
            
            
        }
        
        
        
        
        
    }

?>
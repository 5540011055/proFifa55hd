<?php
    class File{
        
        public function File( $file=null ){
            $this->file         = $file;
        }
        
        
        
        private function check(){
            if( !$this->exist() ){
                throw new Exception("File(". $this->file .") not found.");
            }
        }
        
        
        public function setFile( $file ){
            if( ! $file instanceof  File ){
                throw new Exception ("Instance of File not found(Wrong parameter)");
            }
            $this->file         = $file->getFileName();
        }
        public function getFile(){
            return new File($this->file);
        }


        
        public function setFileName( $fileName ){
            $this->file         = $fileName;
        }
        public function getFileName(){
            return $this->file;
        }
        
        
        public function exist(){
            return file_exists($this->file);
        }
        
        
        public function getAbsolutePath(){
            $this->check();
            return realpath($this->file);
        }
        
        
        public function getParentFile(){
            $this->check();
            return dirname($this->getAbsolutePath());
        }
        
        
        public function isFile(){
            return is_file($this->file);
        }
        
        
        public function isDirectory(){
            return is_dir($this->file);
        }
        
        
        
        public function isLink(){
            return is_link($this->getAbsolutePath());
        }
        
        
        
        public function changeGroup($group){
            return chgrp($this->file, $group);
        }
        
        
        
        public function changeOwner( $user ){
            return chown($this->file, $user);
        }
        
        
        
        public function delete(){
            return unlink($this->file);
        }
        
        
        
        public function getFreeSpace(){
            if( $this->isDirectory() ){
                return disk_free_space($this->getAbsolutePath());
            }else{
                return disk_free_space($this->getParentFile());
            }            
        }
        
        
        
        public function getTotalSpace(){
            if( $this->isDirectory() ){
                return disk_total_space($this->getAbsolutePath());
            }else{
                return disk_total_space($this->getParentFile());
            }            
        }
        
        
        
        public function getLassAccess(){
            return fileatime($this->getAbsolutePath());
        }
        
        
        
        public function getInodChangeTime(){
            return filectime($this->getAbsolutePath());
        }
        
        
        
        public function getGroup(){
            return filegroup($this->getAbsolutePath());
        }
        
        
        
        public function getInod(){
            return fileinode($this->getAbsolutePath());
        }
        
        
        
        public function getLastModified(){
            return filemtime($this->getAbsolutePath());
        }
        
        
        
        public function getOwner(){
            return fileowner($this->getAbsolutePath());
        }
        
        
        
        public function getPermission(){
            return fileperms($this->getAbsolutePath());
        }
        
        
        public function size(){
            return filesize($this->getAbsolutePath());
        }
        
        
        
        public function isExecutable(){
            return is_executable($this->getAbsolutePath());
        }
        
        
        public function isReadable(){
            return is_readable($this->getAbsolutePath());
        }
        
        
        public function isWritable(){
            return is_writable($this->getAbsolutePath());
        }
        
        
        
        public function createLink( $target ){
            return link($this->getAbsolutePath(), $target);
        }
        
        
        
        public function getLinkInfo(){
            return linkinfo($this->getAbsolutePath());
        }
        
        
        
        public function getLinkStatus(){
            return lstat($this->getAbsolutePath());
        }
        
        
        
        public function createDirectory( $path ){
            return mkdir($path);
        }
        
        
        
        public static function createDirectories( $path ){
            $path           = str_replace('\\', '/', $path);
            $path           = str_replace('../', '', $path);
            $path           = str_replace('./', '', $path);
            $bufPath_arr    = explode('/', $path);
            $len            = count($bufPath_arr);
            if(  count($bufPath_arr)<2  ){
                for( $i=0; $i<$len;  $i++  ){
                    if( $bufPath_arr[$i]!="" ){
                        $innerPath  = array_slice($bufPath_arr, 0, $i+1);
                        $innerPath  = './'. implode('/', $innerPath);
                        if( !file_exists($innerPath) ){
                            mkdir($innerPath);
                        }
                    }
                }
            }else{
                if(!file_exists($path)){
                   mkdir($path); 
                }
            }
            return;
        }
        
        
        
        
        public function createNewTemporaryFile(){
            return tmpfile();
        }
        
        
        
        public function rename( $newName ){
            return rename($this->getAbsolutePath(), $newName);
        }
        
        
        
        public function removeDirectory( $path ){
            return rmdir($path);
        }
        
        
        
        public function lists($directory=NULL){
            if($directory==NULL){
                $directory      = $this->getAbsolutePath();
            }
            return scandir($directory);
        }
        
        
        public function listFiles( $directory=NULL ){
            if($directory==NULL){
                $directory      = $this->getAbsolutePath();
            }
            $output             = array();
            $bufList            = scandir($directory);
            foreach( $bufList   AS      $name ){
                if( $name!='.'  &&  $name!='..' ){
                    $file       = new File(realpath($directory. DIRECTORY_SEPARATOR . $name));
                    $output[]   = $file;
                }
            }
            return $output;
        }
        


        public static function getExtendsion( $fileName ){
            //$buf_name       = explode(".", $fileName,2);   
            
            $lastDotPos = strrpos($fileName, '.');
            if ( !$lastDotPos ) return false;
            
            return substr($fileName, $lastDotPos+1);
            
            /*
            $extendsion     = "";
            if( $buf_name[1]!=$fileName ){
                $extendsion = str_replace($buf_name[1], '', $fileName);
                if(substr($extendsion, 0, 1)=='.' ){
                    $extendsion             = substr($extendsion, 1);
                }
                $buf        = explode(".", $extendsion);
                if( count($buf)>1 ){
                    $extendsion         = $buf[count($buf)-1];
                }
            } */
           // return @$buf_name[1];
        }
        
        
        
        
        
        
        public function __toString() {
            return $this->getAbsolutePath(). '; size: '. $this->size();
        }
        
        
        
        public static function getFormatSize($fileSize){
            if($fileSize==""    ||  $fileSize==0){
                return '0 B.';
            }
            switch( $fileSize ){
                case ($fileSize)<1024                       :
                    return $fileSize. ' B.';
                    break;
                case ($fileSize/pow(1024,1))<pow(1024, 1)   :
                    return number_format($fileSize/pow(1024,1) ,2). ' KB.';
                    break;
                case ($fileSize/pow(1024,2))<pow(1024, 2)   :
                    return number_format($fileSize/pow(1024,2) ,2). ' MB.';
                    break;
                case ($fileSize>pow(1024,3))                :
                    return number_format($fileSize/pow(1024,3) ,2). ' GB.';
                    break;            
            }
            return '-';
        }
        
        
        public static function getFormatSizeFile($fileSize){
        	if($fileSize==""    ||  $fileSize==0){
        		return '0';
        	}
        	
        	return $fileSize;
        }
        
        
        
        
        
        
        // Class variables
        private $file="";        
        
    }
    
    
    
    
    
?>

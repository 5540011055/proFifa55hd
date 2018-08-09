<?php
    class GarbageCleaner{
        
        private $tempPath                   = '';
        private $extension_available        = Array();
        /**
         * @var int Timestamp 
         */
        private $period                         = 0;
        
        /**
         * 
         * @param String $tempPath Temporary path to clean garbages (images, files)
         * @param File's Extension $extension_available Example: jpeg,jpg,bmp,gif,png
         */
        public function __construct(  
                    $tempPath=null,
                    $extension_available=Array('jpeg','jpg','bmp','gif','png')
                ) 
        {
            $this->tempPath         = $tempPath;
            $this->extension_available = $extension_available;
            $this->period                   = strtotime('-1month');
        }
        
        
        
        
        public function setPeriod($period){
            $this->period = $period;
        }
        public function getPeriod(){
            return $this->period;
        }
        
        
        public function setTemporaryPath($path){
            $this->tempPath = $path;
        }
        public function getTemporaryPath(){
            return $this->tempPath;
        }
        
        /**
         * 
         * @param Array $extension
         */
        public function setExtension( $extension ){
            $this->extension_available = $extension;
        }
        /**
         * 
         * @return Array
         */
        public function getExtension(){
            return $this->extension_available;
        }
        
        
        public function run(){
            if( file_exists( $this->tempPath ) ){
                $lsDir              = scandir($this->tempPath);
                if( $lsDir ){
                    foreach( $lsDir AS $file ){
                        $filePath       = "{$this->tempPath}/{$file}";
                        if( $file!="."      &&      $file!=".."     &&  @is_file($filePath) ){             
                            $lastModified       = filemtime($filePath);                            
                            if( $this->period>$lastModified ){
                                @unlink($filePath);
                            }
                        }
                    }// end foreach
                }
            }
        }
        
        
        
    }
    
    
    /*
    $gb             = new GarbageCleaner("tmp");
    $gb->run();
     */
    
?>

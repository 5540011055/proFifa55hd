<?PHP

    class DatabaseBackup{
        
        
        public function DatabaseBackup($host, $username, $password, $databaseName="", $encoding="utf8"){
            $this->host         = $host;
            $this->username     = $username;
            $this->password     = $password;    
            $this->databaseName = $databaseName;
            $this->encoding     = $encoding;
        }
        
        
        public function setHost($host){
            $this->host     = $host;
        }
        public function getHost(){
            return $this->host;
        }
        
        
        
        public function setUsername( $username ){
            $this->username         = $username;
        }
        public function getUsername(){
            return $this->username;
        }
        
        
        public function setPassword( $password ){
            $this->password         = $password;
        }
        public function getPassword(){
            return $this->password;
        }
        
        
        
        public function setDatabase( $databaseName ){
            $this->databaseName         = $databaseName;
        }
        public function getDatabase(){
            return $this->databaseName;
        }
        
        
        
        public function setEncoding( $encoding ){
            $this->encoding             = $encoding;
        }
        public function getEncoding(){
            return $this->encoding;
        }
        
        
        
        
        public function backup(){
            $filename       = $this->databaseName."_".date("Y-m-d_H-i-s")."_.sql";
            $fHandler       = fopen($filename,"w");
            if( $this->cn==NULL ){
                $this->cn           = mysql_connect($this->host, $this->username, $this->password);
                mysql_select_db($this->databaseName, $this->cn);
                mysql_query("SET character_set_results=".$this->encoding, $this->cn);
                mysql_query("SET character_set_client='".$this->encoding."'", $this->cn);
                mysql_query("SET character_set_connection='".$this->encoding."'", $this->cn);
            }
            $rs             = mysql_query("show tables;", $this->cn);
            $bufCount       = 0;
            $output         = "";
            while( ($row=mysql_fetch_array($rs)) ){
                /*
                 * Drop table if exists
                 */
                $tblname    = $row[0];                
                $output     .="DROP TABLE IF EXISTS `".$tblname."`; \r\n ";
                /*
                 * Create table
                 */
                $rs_createTbl=mysql_query(" SHOW CREATE table ".$tblname);
                $buf        = mysql_fetch_array($rs_createTbl);
                $output     .=$buf['Create Table']."\r\n ";
                /*
                 * Insert table
                 */
                $rs_insert  = mysql_query(" SELECT * FROM  ".$tblname);
                $rs_count   = mysql_num_fields($rs_insert);
                while( ($row_insert=  mysql_fetch_array($result)) ){
                    for( $i=0;  $i<$rs_count;  $i++ ){
                        $row_insert[$i]     = '`'. $row_insert.'`';
                    }
                    $values = implode(',', $row_insert);
                    $output .=" INSERT INTO {$tblname} values({$values}) ";
                }
                $bufCount++;
            }
            fclose($fHandler);
        }
        
        
        
        
        
        // Class variable
        private $host                   = "";
        private $username               = "";
        private $password               = "";
        private $databaseName           = "";
        private $encoding               = "utf8";
        
        
        public static $ENCODING_UTF8    = "utf8";
        public static $ENCODING_TIS620  = "tis620";
        
        /**
         *
         * @var MysqlResource Connection object
         */
        private $cn                     = null;
        
    }
    
    
    
    $db             = new DatabaseBackup("localhost", "root", "", "hatyaiwittaya");
    $db->backup();
    
    
    
?>
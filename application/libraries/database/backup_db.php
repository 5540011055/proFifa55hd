<?PHP

    backup_tables('localhost','tigerline_close','city#2010','tigerline_close');


    /* backup the db OR just a table */
    function backup_tables($host,$user,$pass,$name,$tables = '*')
    {
            $link = mysql_connect($host,$user,$pass);
			mysql_query("set character set utf8");
            mysql_select_db($name,$link);

            //get all of the tables
            if($tables == '*')
            {
                    $tables = array();
                    $result = mysql_query('SHOW TABLES');
                    while($row = mysql_fetch_row($result))
                    {
                            $tables[] = $row[0];
                    }
            }
            else
            {
                    $tables = is_array($tables) ? $tables : explode(',',$tables);
            }

            //cycle through
			$return				= "";	
            foreach($tables as $table)
            {

                    $result = mysql_query('SELECT * FROM '.$table);
                    $num_fields = mysql_num_fields($result);

                    $return.= 'DROP TABLE '.$table.';';
                    $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
                    $return.= "\n\n".$row2[1].";\n\n";

                    for ($i = 0; $i < $num_fields; $i++) 
                    {
                            while($row = mysql_fetch_row($result))
                            {
                                    $return.= 'INSERT INTO '.$table.' VALUES(';
                                    for($j=0; $j<$num_fields; $j++) 
                                    {
                                            $row[$j] = addslashes($row[$j]);
                                            //$row[$j] = ereg_replace("\n","\\n",$row[$j]);
											//$row[$j] = str_replace("\n","\\n",$row[$j]);
                                            if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                                            if ($j<($num_fields-1)) { $return.= ','; }
                                    }
                                    $return.= ");\n";
                            }
                    }
                    $return.="\n\n\n";
            }

            //save file
            
            $currentDatePath		= "../../backup/db/".date('Y-m-d')."/";
            if(!file_exists('../../backup')){
                    @mkdir('../../backup');
                    @chmod('../../backup', 0777);
            }
            if(!file_exists('../../backup/db/')){
                    @mkdir('../../backup/db/');
                    @chmod('../../backup/db/', 0777);
            }
            if(!file_exists($currentDatePath)){
                    @mkdir($currentDatePath);
                    @chmod($currentDatePath, 0777);
            }
            $path_sql_fileExt           = '.sql';
            $path_sql_fileName          = $name. ' ('.date('Y-m-d_H-i-s').')'. $path_sql_fileExt;
            $path_sql                   = $currentDatePath.$path_sql_fileName;			
            $handle = @fopen($path_sql,'w+');
            @fwrite($handle,$return);
            @fclose($handle);
            
            try{
                $path_gz_fileExt           = '.sql.gz';
                $path_gz_fileName          = $name. ' ('.date('Y-m-d_H-i-s').')'. $path_gz_fileExt;
                $path_gz                   = $currentDatePath.$path_gz_fileName;	
                $handle = gzopen($path_gz, 'w');
                gzwrite($handle, $return);
                gzclose($handle);
                @unlink($path_sql);
            }catch(Exception $e){
                
            }
            
    }

?>
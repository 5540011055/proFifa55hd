<?PHP
    /**
     *
     * @param String $SERVER Server connection's string
     * @param String $DatabaseName
     * @param String $output [html,file]
     * @param String $fileOutputPath
     * @return Mixed 
     * 
     * 
     ***************************************************************************
     * @example 
     *  MSServer2MySQL('localhost\SQLEXPRESS', 'LOAN1', 'file', './output.sql');
     *  MSServer2MySQL('localhost\SQLEXPRESS', 'LOAN1', 'html');
     *************************************************************************** 
     * 
     * 
     */
    function MSServer2MySQL($SERVER, $DatabaseName, $outputType='html', $fileOutputPath=""){
        /*
         *      Start Dump SQL 
         */
        $outputType         = strtolower($outputType);
        $con            = odbc_connect("DRIVER={SQL Server};SERVER={$SERVER};DATABASE={$DatabaseName};AutoTranslate=no",'', '') or die ("เชื่อมไม่ได้");
        $rs             = odbc_exec($con, "SELECT name FROM sys.tables WHERE name<>'dtproperties' ");
        $count          = 0;
        $output         = "";
        while($row=odbc_fetch_array($rs)){
            $desc       = odbc_exec($con, "sp_columns {$row['name']} ");
            $output.= "DROP TABLE IF EXISTS {$row['name']};";
            $output.= "\n";
            $output.= "CREATE TABLE {$row['name']}( ";
            $output.= "\n";
            $buf        = Array();
            $cols_arr   = Array();
            while($cols=odbc_fetch_array($desc)){
                $type           = $cols['TYPE_NAME']."(".$cols['LENGTH'].") ";
                if($cols['TYPE_NAME']=='money'){
                    $cols['TYPE_NAME'] = 'double';
                    $type       = $cols['TYPE_NAME']."(".$cols['LENGTH'].",0) ";
                }            
                if($cols['TYPE_NAME']=='char'){
                    $cols['TYPE_NAME'] = 'varchar';
                }
                $cols_arr[] = $cols['COLUMN_NAME'];
                $buf[]          = "  ".$cols['COLUMN_NAME']. " ".$type;
            }
            $output.= implode(",\n", $buf);
            $output.= "\n";
            $output.= ");";
            $output.= "\n\n";
            /*
             * Start Retrive Data
             */
            $fields             = implode(',', $cols_arr);
            $values             = odbc_exec(
                                                $con,   
                                                "   SELECT      ". $fields." 
                                                    FROM        {$row['name']}
                                                    "
                                            );
            while( $value=odbc_fetch_array($values) ){               
                if($value){            
                    $len            = count($cols_arr);
                    for( $i=0;  $i<$len;  $i++ ){
                        $value[$cols_arr[$i]]="'{$value[$cols_arr[$i]]}'";                      
                    }
                    $datas          = implode(',', $value);
                    $output.= " INSERT INTO {$row['name']}({$fields}) VALUES({$datas}); ";      
                    $output.= "\n";
                } 
            }
            /*
             * END Retrive Data
             */
            $count++;
        }
        odbc_close($con);
        /*
         *  END Dump SQL 
         */
        
        
        switch($outputType){
            case 'html' :
                $output         = str_replace("\n", "<br />", $output);
                $output         = str_replace(" ", "&nbsp;", $output);
                echo $output;
                break;
            case 'file' :
                $handle         = fopen($fileOutputPath, 'w');
                fwrite($handle, $output);
                fclose($handle);
                return true;
                break;
            default     :      
                exit('Output type not support');
                break;
        }
        
    }
    
    
?>
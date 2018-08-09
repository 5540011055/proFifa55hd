<?php
    /*  Fake class */
    class Uploader{}
    
    /**
     *   uploadFile for swf (Uploadify)
     */
    function uploadFile(){       
        
        
        $file                   = $_FILES['Filedata'];
        /* Check error */
        if( $file['error'] ){ exit("-1"); }
      
        $fileName               = request('Filename');
        $SID                    = request('sid');
        $uploadKey              = request('uploadKey');
        $_CMD                   = request('_CMD');
        $type                   = request('type');
        $table                  = request('table');
        $user_id                = request('user_id');
        $ip                     = getIPAddress();
        $now                    = date('Y-m-d H:i:s');
                
        $tmpFile                = $file['tmp_name'];
        $fileSize               = $file['size'];
        $extension              = File::getExtendsion($fileName);        
        
        $uploadPath             = "files/com_{$_CMD}/".date('Y-m')."/";
        $fileName_new           = $uploadPath.date('Y-m_').substr(md5($now), 0, 15).'.'.$extension;
        @mkdir('../'.$uploadPath, 0777, true);
        @move_uploaded_file($tmpFile, '../'.$fileName_new);
        @chmod($fileName_new, 0777);
        /* Insert transaction */
        $db                     = getDBO();
        $query                  = "
            INSERT  
            INTO    {$table}
                    (   uploadKey,
                        filename,
                        filepath,
                        filesizes,
                        extension,
                        attact_type,
                        hits,
                        create_by,
                        create_ip,
                        create_date,
                        status ) 
            VALUES  (   '{$uploadKey}',
                        '{$fileName}',
                        '{$fileName_new}',
                        '{$fileSize}',
                        '{$extension}',
                        '{$type}',
                        0,
                        '{$user_id}',
                        '{$ip}',
                        '{$now}',
                        '1'  );
        ";
        $db->setQuery($query);
        $db->query();
        $outout             = array(
            'id'            => $db->insertid(),
            'filename'      => $fileName,
            'filepath'      => $fileName_new,
            'size'          => File::getFormatSize($fileSize),
            'extension'     => $extension,
            'type'          => $type,
            '_CMD'          => $_CMD,
            'table'         => $table
        );  
        exit(json_encode($outout));
    }
    
    
    
    function insert_file($path, $table, $uploadKey, $file, $type) {
    	$upload_file = upload_file($path, $file);
    	if ($upload_file) {
    		$obj = new Object();
    		$obj->uploadKey = $uploadKey;
    		$obj->filename = $upload_file['name'];
    		$obj->filepath = $upload_file['path'];
    		$obj->filesizes = $upload_file['size'];
    		$obj->extension = $upload_file['extension'];
    		$obj->attact_type = $type;
    		$obj->hits = 0;
    		$obj->create_date = date('Y-m-d H:i:s');
    		$obj->create_by = getLogedInUserId();
    		$obj->create_ip = getIPAddress();
    		$obj->status = '1';
    		$db = getDBO();
    		$insert = $db->insertObject($table, $obj);
    		return $upload_file['path'];
    	} else {
    		return '';
    	}
    }
    
    function upload_file($path, $file) {
    
    	if (!$path) {
    		echo "Couldn't upload, No components detected.";
    		return false;
    	}
    
    	$file_name = $file['name'];
    
    	// get file information
    	$extension = File::getExtendsion ($file_name);
    
    	// check file type
    	$filter = array("jpg", "jpeg", "png", "gif", "doc", "docx", "pdf", "zip");
    	if (!in_array($extension, $filter)) {
    		echo "<script> console.warn('File type is not allow.({$extension}) Allow " . implode(", ", $filter) . " Only'); </script>";
    		return false;
    	}
    
    	// generate file name
    	$random_name = substr(md5(time() . $file_name . rand(0, 100)), 0, 15);
    	$new_file_name = date("Ymd") . "_" . $random_name . '.' . $extension;
    
    	$tmp_name = $file['tmp_name'];
    	$file_size = intval($file['size']);
    
    	if(!file_exists($path) ){
    		@mkdir($path, 0777, true );
    	}
    
    	$file_path = $path.$new_file_name;
    	if (move_uploaded_file($tmp_name, $file_path)) {
    		@chmod($file_path, 0777);
    		$result = array("name" => $file_name,
    				"size" => $file_size,
    				"extension" => $extension,
    				"path" => $file_path,
    				"urlpath" => $path);
    		return $result;
    	} else {
    		return FALSE;
    	}
    }
    
    
    
    /**
     *
     * @param String $sid
     * @param String $uploadKey
     * @param String $_CMD
     * @param String $tableName
     * @param int $user_id
     * @return string 
     */
    function getFileUploadTool($sid, $uploadKey, $_CMD, $tableName, $user_id){
        $data               = Array(
            'sid'       => $sid,
            'uploadKey' => $uploadKey,
            '_CMD'      => $_CMD,
            'type'      => 'f',
            'table'     => $tableName,
            'user_id'   => $user_id
        );
        $db                     = getDBO();
        $db->setQuery("SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='f'  AND status='1' ORDER BY seq ASC,id DESC ");
        $rs                     = $db->loadAssocList();
        $len                    = count($rs);
        $output                 = '';
        $output                 .='    
            <span class="comment" style="font-size:12px;">'.lang('max_upload_filesize').' <b>'.File::getFormatSize(getConfig('max_upload_filesize')*1024*1024).'</b> รองรับไฟลล์สกุล *.pdf; *.doc; *.docx; *.ppt; *.pptx; *.xls; *.xlsx; *.zip; *.rar</span>
            <div id="uploader-file"></div>            
            <div id="custom-queue-file"  class="custom-queue"></div>            
            <script>
                $("#uploader-file").uploadify({
                    height          : 30,
                    width           : 120,        
                    wmode           : "transparent",
                    buttonText      : "เลือกไฟล์",
                    swf             : \''.base_url().'js/uploadify-v3.1/uploadify.swf\',
                    uploader        : \''.base_url().$_CMD.'/upload\',
                    multi           : true,
                    auto            : true,
                    method          : \'post\',
                    fileTypeExts    : "*.pdf; *.doc; *.docx; *.ppt; *.pptx; *.xls; *.xlsx; *.zip; *.rar;",
                    fileTypeDesc    : "All files",
                    queueID         : "custom-queue-file",
                    onUploadSuccess : function(file, data, response) {
                        addUploadedFile(\'filelist\', data);                        
                    },
                    formData        : '.json_encode($data).'
                });
            </script>
        ';
        $output                 .='
            <div id="filelist">
        ';        
        for( $i=0;  $i<$len;  $i++ ){
            $imagePath          = "images/fileicons_16/{$rs[$i]['extension']}.png";
            /*
            if(!file_exists($imagePath) ){
                $imagePath      = "images/fileicons_16/file.png";
            }
             * 
             */
            $imagePath      = "images/fileicons_16/file.png";
            $url                = '../'.$rs[$i]['filepath'];
            $id                 = "file{$i}";
            $output             .='
                <table width="700" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_'.$rs[$i]['id'].'">
                    <tbody>
                        <tr>
                            <td width="200" rowspan="4" class="gridmenu" align="center">
                                <a href="'.$url.'" target="_blank"><img width="24" height="24" src="'.$imagePath.'" /></a>
                            </td>
                            <td width="300" class="gridmenu" style="vertical-align:top;">
                                '.lang('Filename','Filename').': '.$rs[$i]['filename'].' 
                            </td>
                            <td class="gridmenu" style="vertical-align:top;">
                                '.lang('Filetype','Filetype').' : '.$rs[$i]['extension'].'
                            </td>
                            <td width="25" align="center" class="gridmenu" style="vertical-align:top;">
                                <a href="javascript:;" onclick="removeFile(\''.base_url().getParam(1).'\',\''.$tableName.'\','.$rs[$i]['id'].', \'file_'.$rs[$i]['id'].'\');">
                                    <img src="images/icons/16px/delete.png" width="16" height="16" />
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td  class="gridmenu" style="vertical-align:top;">'.lang('Order index','Order index').' : <input type="text" style="width:40px;" value="'.intval($rs[$i]['seq']).'" onBlur="updateSequence(\''.$rs[$i]['id'].'\', \''.$tableName.'\', \''.$_CMD.'\', this);" /></td>
                            <td  class="gridmenu" colspan="2" style="vertical-align:top;">'.lang('Filesizes','Filesizes').' : '.File::getFormatSize($rs[$i]['filesizes']).'</td>
                        </tr>
                        <tr>
                            <td class="gridmenu" colspan="3" style="vertical-align:top;">'.lang('Comment','Comment').': <textarea onBlur="updateFileDesc('.$rs[$i]['id'].', \''.$tableName.'\', \''.$_CMD.'\', this);">'.$rs[$i]['description'].'</textarea></td>
                        </tr>
                    </tbody>
                </table>
                <br />
            ';
        }
        $output                 .='
            </div>
        ';        
        
        return $output;
    }
    
    
    
    
    /**
     *
     * @param String $sid
     * @param String $uploadKey
     * @param String $_CMD
     * @param String $tableName
     * @param int $user_id
     * @return string 
     */
    function getImageUploadTool($sid, $uploadKey, $_CMD, $tableName, $user_id){
        $data               = Array(
            'sid'       => $sid,
            'uploadKey' => $uploadKey,
            '_CMD'      => $_CMD,
            'type'      => 'i',
            'table'     => $tableName,
            'user_id'   => $user_id
        );
        $db                     = getDBO();
        $db->setQuery("SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='i'  AND status='1' ORDER BY seq ASC,id DESC ");
        
        $rs                     = $db->loadAssocList();
        $len                    = count($rs);
        $output                 = '';
        $output                 .='  
            <span class="comment" style="font-size:12px;">'.lang('max_upload_imagesize').' <b>'.File::getFormatSize(getConfig('max_upload_imagesize')*1024*1024).'</b> รองรับไฟลล์สกุล *.gif; *.png; *.jpg; *.jpeg; *.bmp; *.tiff; *.eps; *.ico</span>
            <div id="uploader-image"></div>
            <script>
                    var uploader_img_obj = $("#uploader-image").uploadify({
                        height          : 30,
                        width           : 120,
                        wmode           : "transparent",
                        buttonText      : "เลือกไฟล์",
                        swf             : \''.base_url().'js/uploadify-v3.1/uploadify.swf\',
                        uploader        : \''.base_url().$_CMD.'/upload\',
                        multi           : true,
                        auto            : true,
                        method          : \'post\',
                        fileTypeExts    : "*.gif; *.png; *.jpg; *.jpeg; *.bmp; *.tiff; *.eps; *.ico; ",
                        fileTypeDesc    : "All image",
                        queueID         : "custom-queue-image",
                        onUploadSuccess : function(file, data, response) {
                            addUploadedFile(\'imagelist\', data);                        
                        },
                        formData        : '.json_encode($data).'
                    });
                    
            </script>
            <div id="custom-queue-image" class="custom-queue"></div>
            
        ';
        $output                 .='
            <div id="imagelist">
        ';
        for( $i=0;  $i<$len;  $i++ ){
            $url                = '../'.$rs[$i]['filepath'];
            $id                 = "image{$i}";
            $output             .='
                <table width="700" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_'.$rs[$i]['id'].'">
                    <tbody>
                        <tr>
                            <td width=200" rowspan="3" class="gridmenu" align="center">
                                <img width="64" height="64" src="'.$url.'" /><br /><br />
                                <div href="javascript:;" class="display_image ui-state-default ui-corner-all" onClick="setDisplayImage(this);" style="width:80px;height:30px;float:left;margin:3px;">
                                    <span class="ui-icon ui-icon-check" style="float:left;"></span>
                                    ตั้งเป็นภาพ<br/>ประจำหัวข้อ
                                </div>
                                <div href="javascript:;" class="display_image ui-state-default ui-corner-all" onClick="insertImage_tiny(\'description\', \''.  stripcslashes($url).'\');"  style="width:80px;height:30px;float:left;margin:3px;">
                                    <span class="ui-icon ui-icon-check" style="float:left;"></span>
                                    แทรกในเนื้อหา
                                </div>
                            </td>
                            <td width="300" class="gridmenu" style="vertical-align:top;">
                                '.lang('Filename','Filename').': '.$rs[$i]['filename'].' 
                            </td>
                            <td class="gridmenu" style="vertical-align:top;">
                                '.lang('Filetype','Filetype').' : '.$rs[$i]['extension'].'
                            </td>
                            <td width="25" align="center" class="gridmenu" style="vertical-align:top;">
                                <a href="javascript:;" onclick="removeFile(\''.base_url().getParam(1).'\',\''.$tableName.'\','.$rs[$i]['id'].', \'file_'.$rs[$i]['id'].'\');">
                                    <img src="images/icons/16px/delete.png" width="16" height="16" />
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td  class="gridmenu" style="vertical-align:top;">'.lang('Order index','Order index').' : <input type="text" style="width:40px;" value="'.intval($rs[$i]['seq']).'" onBlur="updateSequence(\''.$rs[$i]['id'].'\', \''.$tableName.'\', \''.$_CMD.'\', this);" /></td>
                            <td  class="gridmenu" colspan="3" style="vertical-align:top;">'.lang('Filesizes','Filesizes').' : '.File::getFormatSize($rs[$i]['filesizes']).'</td>
                        </tr>
                        <tr>
                            <td class="gridmenu" colspan="3" style="vertical-align:top;">'.lang('Comment','Comment').': <textarea onBlur="updateFileDesc('.$rs[$i]['id'].', \''.$tableName.'\', \''.$_CMD.'\', this);">'.$rs[$i]['description'].'</textarea></td>
                        </tr>
                    </tbody>
                </table>
                <br />
            ';
        }
        $output                 .='
            </div>
        ';
        
        
        return $output;
    }
    
    
    
    
    
    
    
    /**
     *
     * @param String $sid
     * @param String $uploadKey
     * @param String $_CMD
     * @param String $tableName
     * @param int $user_id
     * @return string 
     */
    function getFileContentUploadTool($sid, $uploadKey, $_CMD, $tableName, $user_id){
        $data               = Array(
            'sid'       => $sid,
            'uploadKey' => $uploadKey,
            '_CMD'      => $_CMD,
            'type'      => 'f',
            'table'     => $tableName,
            'user_id'   => $user_id
        );
        $db                     = getDBO();
        $db->setQuery("SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='f'  AND status='1' ORDER BY seq ASC,id DESC ");
        
        $rs                     = $db->loadAssocList();
        $len                    = count($rs);
        $output                 = '';
        $output                 .='    
            <span class="comment"  style="font-size:12px;">'.lang('max_upload_filesize').' '.File::getFormatSize(getConfig('max_upload_filesize')*1024*1024).' รองรับไฟลล์สกุล *.pdf; *.doc; *.docx; *.ppt; *.pptx; *.xls; *.xlsx; *.zip; *.rar;</span>
            <div id="uploader-file"></div>
            <div id="custom-queue-file"  class="custom-queue"></div>            
            <script>
                $("#uploader-file").uploadify({
                    height          : 30,
                    width           : 120,
                    wmode           : "transparent",
                    buttonText      : "เลือกไฟล์",
                    swf             : \''.base_url().'js/uploadify-v3.1/uploadify.swf\',
                    uploader        : \''.base_url().$_CMD.'/upload\',
                    multi           : true,
                    auto            : true,
                    method          : \'post\',
                    fileTypeExts    : "*.pdf; *.doc; *.docx; *.ppt; *.pptx; *.xls; *.xlsx; *.zip; *.rar;",
                    fileTypeDesc    : "All files",
                    queueID         : "custom-queue-file",
                    onUploadSuccess : function(file, data, response) {
                        addUploadedFile(\'filelist\', data);                        
                    },
                    formData        : '.json_encode($data).'
                });
            </script>
        ';
        $output                 .='
            <div id="filelist">
        ';
        for( $i=0;  $i<$len;  $i++ ){
            $imagePath          = "images/fileicons_16/{$rs[$i]['extension']}.png";
            if(!file_exists($imagePath) ){
                $imagePath      = "images/fileicons_16/file.png";
            }
            $url                = '../'.$rs[$i]['filepath'];
            $id                 = "file{$i}";
            $downloadLink       = htmlentities('<a href="'.$rs[$i]['filepath'].'" title="'.  urlencode($rs[$i]['filename']).'">'.urlencode($rs[$i]['filename']).'</a>');
            $output             .='
                <table width="700" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_'.$rs[$i]['id'].'">
                    <tbody>
                        <tr>
                            <td width="200" rowspan="4" class="gridmenu" align="center">
                                <a href="'.$url.'" target="_blank"><img width="24" height="24" src="'.$imagePath.'" /></a>
                            </td>
                            <td width="300" class="gridmenu" style="vertical-align:top;">
                                '.lang('Filename','Filename').': '.$rs[$i]['filename'].' 
                            </td>
                            <td class="gridmenu" style="vertical-align:top;">
                                '.lang('Filetype','Filetype').' : '.$rs[$i]['extension'].'
                            </td>
                            <td width="25" align="center" class="gridmenu" style="vertical-align:top;">
                                <a href="javascript:;" onclick="alert(\'delete file id='.$rs[$i]['id'].'\');">
                                    <img src="images/icons/16px/delete.png" width="16" height="16" />
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td  class="gridmenu" colspan="3" style="vertical-align:top;">'.lang('Filesizes','Filesizes').' : '.File::getFormatSize($rs[$i]['filesizes']).'</td>
                        </tr>
                        <tr>
                            <td class="gridmenu" colspan="3" style="vertical-align:top;">'.lang('Download Link','Download Link').': 
                                <span style="font-weight:bold;color:blue;">
                                    <textarea>'.$downloadLink.'</textarea>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br />
            ';
        }
        $output                 .='
            </div>
        ';        
        
        return $output;
    }
    
    
    
?>

<?php
/* Fake class */
class Uploader {
}

/**
 * uploadFile for swf (Uploadify)
 */
function uploadFile() {
	$file = $_FILES ['Filedata'];
	/* Check error */
	if ($file ['error']) {
		exit ( "-1" );
	}
	
	
	$fileName = $file["name"];
	$SID = request ( 'sid' );
	$uploadKey = request ( 'uploadKey' );
	$_CMD = request ( '_CMD' );
	$type = request ( 'type' );
	$table = request ( 'table' );
	$user_id = request ( 'user_id' );
	$ip = getIPAddress ();
	$now = date ( 'Y-m-d H:i:s' );
	
	$tmpFile = $file ['tmp_name'];
	$fileSize = $file ['size'];
	$extension = File::getExtendsion ( $fileName );
	
	$uploadPath = "files/com_{$_CMD}/" . date ( 'Y-m' ) . "/";
	$fileName_new = $uploadPath . date ( 'Y-m_' ) . substr ( md5 ( $now . $fileName ), 0, 15 ) . '.' . $extension;
	@mkdir ( '../' . $uploadPath, 0777, true );
	@move_uploaded_file ( $tmpFile, '../' . $fileName_new );
	@chmod ( $fileName_new, 0777 );
	/* Insert transaction */
	$db = getDBO ();
	$query = "
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
	$db->setQuery ( $query );
	$db->query ();
	$outout = array (
			'id' => $db->insertid (),
			'filename' => $fileName,
			'filepath' => $fileName_new,
			'size' => File::getFormatSize ( $fileSize ),
			'extension' => $extension,
			'type' => $type,
			'_CMD' => $_CMD,
			'table' => $table 
	);
	exit ( json_encode ( $outout ) );
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
function uploadFileSingle() {
	$file = $_FILES ['Filedata'];
	/* Check error */
	if ($file ['error']) {
		exit ( "-1" );
	}
	
	$fileName = request ( 'Filename' );
	$SID = request ( 'sid' );
	$uploadKey = request ( 'uploadKey' );
	$_CMD = request ( '_CMD' );
	$type = request ( 'type' );
	$table = request ( 'table' );
	$user_id = request ( 'user_id' );
	$ip = getIPAddress ();
	$now = date ( 'Y-m-d H:i:s' );
	
	$tmpFile = $file ['tmp_name'];
	$fileSize = $file ['size'];
	$extension = File::getExtendsion ( $fileName );
	
	$uploadPath = "files/com_{$_CMD}/" . date ( 'Y-m' ) . "/";
	$fileName_new = $uploadPath . date ( 'Y-m_' ) . substr ( md5 ( $now . $fileName ), 0, 15 ) . '.' . $extension;
	@mkdir ( '../' . $uploadPath, 0777, true );
	@move_uploaded_file ( $tmpFile, '../' . $fileName_new );
	@chmod ( $fileName_new, 0777 );
	/* Insert transaction */
	$db = getDBO ();
	
	$query = "
	SELECT *
	FROM {$table}
	WHERE uploadKey = '{$uploadKey}'
	AND attact_type = '{$type}'
	AND	status = '1'
	";
	$db->setQuery ( $query );
	$frm = $db->loadAssocList ();
	
	if ($frm) {
		$query = "
		UPDATE {$table}
		SET status = '2'
		WHERE uploadKey = '{$uploadKey}'
		AND attact_type = '{$type}'
		";
		$db->setQuery ( $query );
		$db->query ();
	}
	
	$query = "
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
	
	$db->setQuery ( $query );
	$db->query ();
	$outout = array (
			'id' => $db->insertid (),
			'filename' => $fileName,
			'filepath' => $fileName_new,
			'size' => File::getFormatSize ( $fileSize ),
			'extension' => $extension,
			'type' => $type,
			'_CMD' => $_CMD,
			'table' => $table 
	);
	exit ( json_encode ( $outout ) );
}


function getFileUploadTool($sid, $uploadKey, $_CMD, $tableName, $user_id) {
	
	$data = Array (
			'sid' => $sid,
			'uploadKey' => $uploadKey,
			'_CMD' => $_CMD,
			'type' => 'f',
			'table' => $tableName,
			'user_id' => $user_id
			);
	
	
	$db = getDBO ();
	$db->setQuery ( "SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='f'  AND status='1' ORDER BY seq ASC,id DESC " );
	$rs = $db->loadAssocList ();
	
	
	$len = count ( $rs );
	$output = '';
	$output .= '
            <span class="comment" style="font-size:12px;">' . lang ( 'max_upload_filesize' ) . ' <b>' . File::getFormatSize ( getConfig ( 'max_upload_filesize' ) * 1024 * 1024 ) . '</b> Support file extensions *.pdf, *.doc, *.docx, *.ppt, *.pptx, *.xls, *.xlsx, *.zip</span>
            <div id="uploader-files"></div>
            <div id="custom-queue-file" ></div>
            <script>
                $("#uploader-files").uploadifive({
                    height          : 30,
                    width           : 120,
                    buttonText      : "แนบไฟล์เอกสาร",
                    uploadScript    : \'' . base_url () . $_CMD . '/upload\',
                    multi           : true,
                    fileSizeLimit   : ' . File::getFormatSizeFile ( getConfig ( 'max_upload_filesize' ) * 1024 ) . ',
                    auto            : true,
                    simUploadLimit  : 1,
                    method          : \'post\',
                    fileType        : "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/zip, application/octet-stream,application/x-rar-compressed, application/octet-stream",
                    queueID         : "custom-queue-file",
                    removeCompleted : true,
                    onUploadComplete : function(file, data, response) {
                        addUploadedFiles(\'filelist\', data,"'.base_url ().'");
                    },
                    formData        : ' . json_encode ( $data ) . '
                });
            </script>
        ';
	
	
	
	$output .= '
            <div id="filelist">
        ';
	for($i = 0; $i < $len; $i ++) {
		
		/*$imagePath = "images/fileicons_16/{$rs[$i]['extension']}.png";
		if (! file_exists ( $imagePath )) {
			$imagePath = "images/fileicons_16/file.png";
		} */
		$id = "file{$i}";
		
		$file_path = $rs [$i] ['filepath'];
		$url 	   = '../' . $rs [$i] ['filepath'];
		
		$downloadLink =  base_url().$url;
		
		$extension          = ($rs[$i]['extension']) ? $rs[$i]['extension'] : "default";
		 
		$iconfile           = '<img width="42" height="42" src="images/files_icon/'.$extension.'.png" />';
		 
		$set_to_content     = '&nbsp;&nbsp;<a href="javascript:;" onClick="insertImage_tiny_file(\'description\', \'' . stripcslashes ( $url ) . '\', \''.$extension.'\', \''.base_url().'\',\'description_en\');"   ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 99px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;แทรกในเนื้อหา</button></a>';
		$txt_area           = '<textarea placeholder="Describe this file here..." class="filecomment"  onBlur="updateFileDesc(' . $rs [$i] ['id'] . ', \'' . $tableName . '\', \'' . $_CMD . '\', this, \''.base_url().'\');">'. @$rs [$i] ['description'] .'</textarea>';
		 
		
		$downloadpath    = '<textarea ro placeholder="Describe this file here..." class="filelink" onclick="this.focus();this.select()" readonly>'. @$downloadLink.'</textarea>';
			
		 
		$output  .= '<table width="100%" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_'.$rs [$i] ['id'].'">'.
		'<tbody>'.
		'<tr>'.
		'<td width="20%" rowspan="3" class="gridmenu" align="center"> '.$iconfile.' </td>'.
		'<td width="40%" class="gridmenu">FileName&nbsp;:  '.$rs [$i] ['filename'].'</td>'.
		'<td class="gridmenu">FileType :&nbsp;'.$rs [$i] ['extension'].' </td>'.
		'<td width="3%" style="vertical-align: top;" align="center" class="gridmenu"><a href="javascript:;" title="ลบไฟล์นี้" onclick="removeFile(\''. $_CMD .'\', \'' . $tableName .'\', '. $rs [$i] ['id'] .', \'file_'. $rs [$i] ['id'] .'\')"><img src="images/icons/cross_circle.png" width="16" height="16"></a></td>'.
		'</tr>'.
		'<tr>'.
		'<td class="gridmenu">No. &nbsp;<input  type="text" class="fileorder" maxlength="3" value="' . intval ( $rs [$i] ['seq'] ) . '" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" onBlur="updateSequence('. $rs [$i] ['id'] .', \''. $tableName .'\', \''. $_CMD .'\', this,\''.base_url().'\');" /></td>'.
		'<td colspan="2" class="gridmenu">FileSize :&nbsp;'. File::getFormatSize ($rs [$i] ['filesizes']).'</td>'.
		'</tr>'.
		'<tr>'.
		'<td colspan="3" class="gridmenu">'.$downloadpath.'</td>'.
		'</tr>'.
		'<tr>'.
		'<td colspan="4" class="gridmenu">Caption :&nbsp'.$txt_area.'</td>'.
		'</tr>'.
		'</tbody>'.
		'</table>';
		
	}
	$output .= '
            </div>
        ';
	
	return $output;
}



function getVdoUploadToolSingle($sid, $uploadKey, $_CMD, $tableName, $user_id) {

	$data = Array (
			'sid' => $sid,
			'uploadKey' => $uploadKey,
			'_CMD' => $_CMD,
			'type' => 'v',
			'table' => $tableName,
			'user_id' => $user_id
			);


	$db = getDBO ();
	$db->setQuery ( "SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='v'  AND status='1' ORDER BY seq ASC,id DESC " );
	$rs = $db->loadAssocList ();


	$len = count ( $rs );
	$output = '';
	
	$output .= '
            <div id="vdofilelist">
        ';
	for($i = 0; $i < $len; $i ++) {

		/*$imagePath = "images/fileicons_16/{$rs[$i]['extension']}.png";
		 if (! file_exists ( $imagePath )) {
			$imagePath = "images/fileicons_16/file.png";
			} */
		$id = "file{$i}";

		$file_path = $rs [$i] ['filepath'];
		$url 	   = '../' . $rs [$i] ['filepath'];

		$downloadLink =  base_url().$url;

		$extension          = ($rs[$i]['extension']) ? $rs[$i]['extension'] : "default";
			
		$iconfile           = '<img width="42" height="42" src="images/files_icon/'.$extension.'.png" />';
			
		$set_to_content     = '&nbsp;&nbsp;<a href="javascript:;" onClick="insertImage_tiny_file(\'description\', \'' . stripcslashes ( $url ) . '\', \''.$extension.'\', \''.base_url().'\',\'description_en\');"   ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 99px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;แทรกในเนื้อหา</button></a>';
		$txt_area           = '<textarea placeholder="Describe this file here..." class="filecomment"  onBlur="updateFileDesc(' . $rs [$i] ['id'] . ', \'' . $tableName . '\', \'' . $_CMD . '\', this, \''.base_url().'\');">'. @$rs [$i] ['description'] .'</textarea>';
			

		$downloadpath    = '<textarea ro placeholder="Describe this file here..." class="filelink" onclick="this.focus();this.select()" readonly>'. @$downloadLink.'</textarea>';
		
		 
		$output .='<table width="100%" border="0" cellpadding="0" cellspacing="2" class="admintable single" id="file_'.$rs[$i]['id'].'">'.
			'<tbody>'.
			'<tr>'.
			'<td width="20%" rowspan="3" class="gridmenu" align="center"> '.$iconfile.' </td>'.
			'<td width="40%" class="gridmenu">FileName&nbsp;:  '.$rs[$i]['filename'].'</td>'.
			'<td class="gridmenu">FileType :&nbsp;'.$rs[$i]['extension'].' </td>'.
			'<td width="3%" style="vertical-align: top;" align="center" class="gridmenu"><a href="javascript:;" title="ลบไฟล์นี้" onclick="removeFile(\''. $_CMD .'\', \'' . $tableName .'\', '. $rs [$i] ['id'] .', \'file_'. $rs [$i] ['id'] .'\')"><img src="images/icons/cross_circle.png" width="16" height="16"></a></td>'.
			'</tr>'.
			'<tr>'.
			'<td class="gridmenu"><button type="button" class="btn btn-block btn-default btn-xs"  style="width: 115px !important;margin:5px 0 !important;font-weight: bold !important; color: #777;"  onclick="showLocalVDO(\''.$downloadLink.'\', \''.$rs[$i]['extension'].'\')"><i class="fa fa-play"></i>&nbsp;&nbsp;&nbsp;Preview Video</button></td>'.
			'<td colspan="2" class="gridmenu">FileSize :&nbsp;'. File::getFormatSize ($rs [$i] ['filesizes']).'</td>'.
			'</tr>'.
			'<tr>'.
			'<td colspan="3" class="gridmenu">'.$downloadpath.'</td>'.
			'</tr>'.
			'<tr>'.
			'<td colspan="4" class="gridmenu">Caption :&nbsp'.$txt_area.'</td>'.
			'</tr>'.
			'</tbody>'.
			'</table>' ;
	}
	
	$output .= '
            </div>
        ';
	
	$output .= '
            <span class="comment" style="font-size:12px;">' . lang ( 'max_upload_vdosize' ) . ' <b>' . File::getFormatSize ( getConfig ( 'max_upload_vdosize' ) * 1024 * 1024 ) . '</b> Support file extensions *.mp3, *.mp4, *.avi, *.flv, *.wmv</span>
            <div id="uploader-files-vdo"></div>
            <div id="custom-queue-file" ></div>
            <script>
                $("#uploader-files-vdo").uploadifive({
                    height          : 30,
                    width           : 120,
                    buttonText      : "แนบไฟล์วีดีโอ",
                    uploadScript    : \'' . base_url () . $_CMD . '/upload\',
                    multi           : false,
                    fileSizeLimit   : ' . File::getFormatSizeFile ( getConfig ( 'max_upload_vdosize' ) * 1024 ) . ',
                    auto            : true,
                    simUploadLimit  : 1,
                    method          : \'post\',
                    fileType        : "video/*",
                    queueID         : "custom-queue-file",
                    removeCompleted : true,
                    onUploadComplete : function(file, data, response) {
                        addUploadedVdoSingle(\'vdofilelist\', data,"'.base_url ().'",\''. $tableName .'\');
                    },
                    formData        : ' . json_encode ( $data ) . '
                });
            </script>
        ';
	

	return $output;
}


function getImageUploadTool($sid, $uploadKey, $_CMD, $tableName, $user_id) {

	$data = Array (
			'sid' => $sid,
			'uploadKey' => $uploadKey,
			'_CMD' => $_CMD,
			'type' => 'i',
			'table' => $tableName,
			'user_id' => $user_id
	);


	$db = getDBO ();
	$db->setQuery ( "SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='i'  AND status='1' ORDER BY seq ASC,id DESC " );
	$rs = $db->loadAssocList ();

	$len = count ( $rs );
	$output = '';
	$output .= '
            <span class="comment" style="font-size:12px;">' . lang ( 'max_upload_imagesize' ) . ' <b>' . File::getFormatSize ( getConfig ( 'max_upload_imagesize' ) * 1024 * 1024 ) . '</b> Support file extensions *.gif, *.png, *.jpg, *.jpeg, *.bmp, *.tiff</span>
            <div id="uploader-file"></div>
            <div id="custom-queue-file" ></div>
            <script>
                $("#uploader-file").uploadifive({
                    height          : 30,
                    width           : 120,
                    buttonText      : "แนบไฟล์ภาพ",
                    uploadScript    : \'' . base_url () . $_CMD . '/upload\',
                    multi           : true,
                    fileSizeLimit   : ' . File::getFormatSizeFile ( getConfig ( 'max_upload_imagesize' ) * 1024 ) . ',
                    auto            : true,
                    simUploadLimit  : 1,
                    method          : \'post\',
                    fileType        : "image/*",
                    queueID         : "custom-queue-file",
                    removeCompleted : true,
                    onUploadComplete : function(file, data, response) {
                        addUploadedImg(\'imagelist\', data,"'.base_url ().'");
                    },
                    formData        : ' . json_encode ( $data ) . '
                });
            </script>
        ';


	$output .= '
            <div id="imagelist">
        ';
	for($i = 0; $i < $len; $i ++) {

		/*$imagePath = "images/fileicons_16/{$rs[$i]['extension']}.png";
			if (! file_exists ( $imagePath )) {
			$imagePath = "images/fileicons_16/file.png";
			} */

		$file_path = $rs [$i] ['filepath'];
		$url 	   = '../' . $rs [$i] ['filepath'];
		$id = "file{$i}";

		$downloadLink = base_url () . '../' . $rs [$i] ['filepath'];


		$image_dis       = '<img style="max-height: 128px; max-width: 95%;" src="'.$url.'" alt="'.$file_path.'">';
		$set_to_image    = '<a href="javascript:;" onClick="setDisplayImage(\''.$file_path.'\');" ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 104px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-bookmark " aria-hidden="true"></i>&nbsp;&nbsp;ตั้งเป็นภาพหัวข้อ</button></a>';
		$set_to_content  = '&nbsp;&nbsp;<a href="javascript:;" onClick="insertImage_tiny(\'description\', \'' . stripcslashes ( $url ) . '\', \''.base_url().'\',\'description_en\');"  ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 99px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;แทรกในเนื้อหา</button></a>';
		$txt_area        = '<textarea placeholder="Describe this picture here..." class="filecomment" onBlur="updateFileDesc(' . $rs [$i] ['id'] . ', \'' . $tableName . '\', \'' . $_CMD . '\', this, \''.base_url().'\');">'. @$rs [$i] ['description'] .'</textarea>';

			
		$output  .=  '<table width="100%" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_' . $rs [$i] ['id'] .'">'.
				'<tbody>'.
				'<tr>'.
				'<td width="20%" rowspan="3" class="gridmenu" align="center"> '.$image_dis.' </td>'.
				'<td width="40%" class="gridmenu">FileName&nbsp;:  '. $rs [$i] ['filename'].'</td>'.
				'<td class="gridmenu">FileType :&nbsp;'.$rs [$i] ['extension'].' </td>'.
				'<td width="3%" style="vertical-align: top;" align="center" class="gridmenu"><a href="javascript:;" title="ลบภาพนี้" onclick="removeFile(\''. $_CMD .'\', \'' . $tableName .'\', '. $rs [$i] ['id'] .', \'file_'. $rs [$i] ['id'] .'\')"><img src="images/icons/cross_circle.png" width="16" height="16"></a></td>'.
				'</tr>'.
				'<tr>'.
				'<td class="gridmenu">No. &nbsp;<input  type="text" class="fileorder" maxlength="3" value="' . intval ( $rs [$i] ['seq'] ) . '" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" onBlur="updateSequence('. $rs [$i] ['id'] .', \''. $tableName .'\', \''. $_CMD .'\', this,\''.base_url().'\');" /></td>'.
				'<td colspan="2" class="gridmenu">FileSize :&nbsp;'. File::getFormatSize ($rs [$i] ['filesizes']).'</td>'.
				'</tr>'.
				'<tr>'.
				'<td colspan="3" class="gridmenu">' .$set_to_image.$set_to_content.'</td>'.
				'</tr>'.
				'<tr>'.
				'<td colspan="4" class="gridmenu">Caption :&nbsp'.$txt_area.'</td>'.
				'</tr>'.
				'</tbody>'.
				'</table>' ;
	}
	$output .= '</div>';

	return $output;

}





function getImageUploadToolNotProfile($sid, $uploadKey, $_CMD, $tableName, $user_id) {

	$data = Array (
			'sid' => $sid,
			'uploadKey' => $uploadKey,
			'_CMD' => $_CMD,
			'type' => 'i',
			'table' => $tableName,
			'user_id' => $user_id
			);


	$db = getDBO ();
	$db->setQuery ( "SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='i'  AND status='1' ORDER BY seq ASC,id DESC " );
	$rs = $db->loadAssocList ();

	$len = count ( $rs );
	$output = '';
	$output .= '
            <span class="comment" style="font-size:12px;">' . lang ( 'max_upload_imagesize' ) . ' <b>' . File::getFormatSize ( getConfig ( 'max_upload_imagesize' ) * 1024 * 1024 ) . '</b> Support file extensions *.gif, *.png, *.jpg, *.jpeg, *.bmp, *.tiff</span>
            <div id="uploader-file"></div>
            <div id="custom-queue-file" ></div>
            <script>
                $("#uploader-file").uploadifive({
                    height          : 30,
                    width           : 120,
                    buttonText      : "แนบไฟล์ภาพ",
                    uploadScript    : \'' . base_url () . $_CMD . '/upload\',
                    multi           : true,
                    fileSizeLimit   : ' . File::getFormatSizeFile ( getConfig ( 'max_upload_imagesize' ) * 1024 ) . ',
                    auto            : true,
                    simUploadLimit  : 1,
                    method          : \'post\',
                    fileType        : "image/*",
                    queueID         : "custom-queue-file",
                    removeCompleted : true,
                    onUploadComplete : function(file, data, response) {
                        addUploadedImgNprofile(\'imagelist\', data,"'.base_url ().'");
                    },
                    formData        : ' . json_encode ( $data ) . '
                });
            </script>
        ';


	$output .= '
            <div id="imagelist">
        ';
	for($i = 0; $i < $len; $i ++) {

		/*$imagePath = "images/fileicons_16/{$rs[$i]['extension']}.png";
			if (! file_exists ( $imagePath )) {
			$imagePath = "images/fileicons_16/file.png";
			} */

		$file_path = $rs [$i] ['filepath'];
		$url 	   = '../' . $rs [$i] ['filepath'];
		$id = "file{$i}";

		$downloadLink = base_url () . '../' . $rs [$i] ['filepath'];


		$image_dis       = '<img style="max-height: 128px; max-width: 95%;" src="'.$url.'" alt="'.$file_path.'">';
		/*$set_to_image    = '<a href="javascript:;" onClick="setDisplayImage(\''.$file_path.'\');" ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 104px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-bookmark " aria-hidden="true"></i>&nbsp;&nbsp;ตั้งเป็นภาพหัวข้อ</button></a>';*/
		$set_to_content  = '&nbsp;&nbsp;<a href="javascript:;" onClick="insertImage_tiny(\'description\', \'' . stripcslashes ( $url ) . '\', \''.base_url().'\',\'description_en\');"  ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 99px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;แทรกในเนื้อหา</button></a>';
		$txt_area        = '<textarea placeholder="Describe this picture here..." class="filecomment" onBlur="updateFileDesc(' . $rs [$i] ['id'] . ', \'' . $tableName . '\', \'' . $_CMD . '\', this, \''.base_url().'\');">'. @$rs [$i] ['description'] .'</textarea>';

			
		$output  .=  '<table width="100%" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_' . $rs [$i] ['id'] .'">'.
				'<tbody>'.
				'<tr>'.
				'<td width="20%" rowspan="3" class="gridmenu" align="center"> '.$image_dis.' </td>'.
				'<td width="40%" class="gridmenu">FileName&nbsp;:  '. $rs [$i] ['filename'].'</td>'.
				'<td class="gridmenu">FileType :&nbsp;'.$rs [$i] ['extension'].' </td>'.
				'<td width="3%" style="vertical-align: top;" align="center" class="gridmenu"><a href="javascript:;" title="ลบภาพนี้" onclick="removeFile(\''. $_CMD .'\', \'' . $tableName .'\', '. $rs [$i] ['id'] .', \'file_'. $rs [$i] ['id'] .'\')"><img src="images/icons/cross_circle.png" width="16" height="16"></a></td>'.
				'</tr>'.
				'<tr>'.
				'<td class="gridmenu">No. &nbsp;<input  type="text" class="fileorder" maxlength="3" value="' . intval ( $rs [$i] ['seq'] ) . '" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" onBlur="updateSequence('. $rs [$i] ['id'] .', \''. $tableName .'\', \''. $_CMD .'\', this,\''.base_url().'\');" /></td>'.
				'<td colspan="2" class="gridmenu">FileSize :&nbsp;'. File::getFormatSize ($rs [$i] ['filesizes']).'</td>'.
				'</tr>'.
				'<tr>'.
				'<td colspan="3" class="gridmenu">' .$set_to_content.'</td>'.
				'</tr>'.
				'<tr>'.
				'<td colspan="4" class="gridmenu">Caption :&nbsp'.$txt_area.'</td>'.
				'</tr>'.
				'</tbody>'.
				'</table>' ;
	}
	$output .= '</div>';

	return $output;

}





function getImageUploadToolBanner($sid, $uploadKey, $_CMD, $tableName, $user_id) {

	$data = Array (
			'sid' => $sid,
			'uploadKey' => $uploadKey,
			'_CMD' => $_CMD,
			'type' => 'i',
			'table' => $tableName,
			'user_id' => $user_id
			);


	$db = getDBO ();
	$db->setQuery ( "SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='i'  AND status='1' ORDER BY seq ASC,id DESC " );
	$rs = $db->loadAssocList ();

	$len = count ( $rs );
	$output = '';
	
	$output .= '
            <div id="imagelist">
        ';
	for($i = 0; $i < $len; $i ++) {

		/*$imagePath = "images/fileicons_16/{$rs[$i]['extension']}.png";
			if (! file_exists ( $imagePath )) {
			$imagePath = "images/fileicons_16/file.png";
			} */

		$file_path = $rs [$i] ['filepath'];
		$url 	   = '../' . $rs [$i] ['filepath'];
		$id = "file{$i}";

		$downloadLink = base_url () . '../' . $rs [$i] ['filepath'];


		
		
		$image_dis  = '<img class="img-responsive" style="max-height: 180px;" src="'.$url.'" alt="'.$file_path.'">';
		$del_this	= '<a href="javascript:;" title="ลบภาพนี้" style="float: right;" onclick="removeFile(\''. $_CMD .'\', \'' . $tableName .'\', '. $rs [$i] ['id'] .', \'file_'. $rs [$i] ['id'] .'\')"> x </a>';
		
		$output  .= '<div class="admintable img-wrap single" id="file_'.$rs[$i]['id'].'">'.$image_dis.$del_this.'</div>';
		

	}
	$output .= '</div>';
	
	$output .= '<br>
            <span class="comment" style="font-size:12px;">' . lang ( 'max_upload_imagesize' ) . ' <b>' . File::getFormatSize ( getConfig ( 'max_upload_imagesize' ) * 1024 * 1024 ) . '</b><br> Support file extensions *.gif, *.png, *.jpg, *.jpeg, *.bmp, *.tiff</span>
            <div id="uploader-file"></div>
            <div id="custom-queue-file" ></div>
            <script>
                $("#uploader-file").uploadifive({
                    height          : 30,
                    width           : 120,
                    buttonText      : "แนบไฟล์ภาพ",
                    uploadScript    : \'' . base_url () . $_CMD . '/upload\',
                    multi           : true,
                    fileSizeLimit   : ' . File::getFormatSizeFile ( getConfig ( 'max_upload_imagesize' ) * 1024 ) . ',
                    auto            : true,
                    simUploadLimit  : 1,
                    method          : \'post\',
                    fileType        : "image/*",
                    queueID         : "custom-queue-file",
                    removeCompleted : true,
                    onUploadComplete : function(file, data, response) {
                        addUploadedImgBanner(\'imagelist\', data,"'.base_url ().'");
                    },
                    formData        : ' . json_encode ( $data ) . '
                });
            </script>
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
function getFileUploadToolSingle($sid, $uploadKey, $_CMD, $tableName, $user_id) {
	$data = Array (
			'sid' => $sid,
			'uploadKey' => $uploadKey,
			'_CMD' => $_CMD,
			'type' => 'f',
			'table' => $tableName,
			'user_id' => $user_id 
	);
	$db = getDBO ();
	$db->setQuery ( "SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='f'  AND status='1' ORDER BY seq ASC,id DESC " );
	$rs = $db->loadAssocList ();
	$len = count ( $rs );
	$output = '';
	$output .= '
            <span class="comment" style="font-size:12px;">' . lang ( 'max_upload_filesize' ) . ' <b>' . File::getFormatSize ( getConfig ( 'max_upload_filesize' ) * 1024 * 1024 ) . '</b> รองรับไฟลล์สกุล *.pdf; *.doc; *.docx; *.ppt; *.pptx; *.xls; *.xlsx; *.zip; *.rar</span>
            <div id="uploader-file"></div>
            <div id="custom-queue-file" ></div>
            <script>
                $("#uploader-file").uploadify({
                    height          : 30,
                    width           : 120,
                    wmode           : "transparent",
                    buttonText      : "attachfile",
                    swf             : \'' . base_url () . 'js/uploadify-v3.1/uploadify.swf\',
                    uploader        : \'' . base_url () . $_CMD . '/uploadSingle\',
                    multi           : false,
                    simUploadLimit : 1,
                    auto            : true,
                    method          : \'post\',
                    fileTypeExts    : "*.pdf; *.doc; *.docx; *.ppt; *.pptx; *.xls; *.xlsx; *.zip; *.rar;",
                    fileTypeDesc    : "All files",
                    queueID         : "custom-queue-file",
                    onUploadSuccess : function(file, data, response) {
                        addUploadedFileSingle(\'filelist\', data);
                    },
                    formData        : ' . json_encode ( $data ) . '
                });

       
          
            </script>
        ';
	$output .= '
            <div id="filelist">
        ';
	for($i = 0; $i < $len; $i ++) {
		
		$imagePath = "images/fileicons_16/{$rs[$i]['extension']}.png";
		if (! file_exists ( $imagePath )) {
			$imagePath = "images/fileicons_16/file.png";
		}
		
		$url = '../' . $rs [$i] ['filepath'];
		$id = "file{$i}";
		
		$downloadLink = base_url () . '../' . $rs [$i] ['filepath'];
		// $downloadLink = htmlentities('<a href="'.base_url().'../'.$rs[$i]['filepath'].'" title="'. urlencode($rs[$i]['filename']).'">'.urlencode($rs[$i]['filename']).'</a>');
		
		
		$output .= '
                <table width="700" border="0" cellpadding="0" cellspacing="2" class="admintable single" id="file_' . $rs [$i] ['id'] . '">
                    <tbody>
                        <tr>
                            <td width="200" rowspan="4" class="gridmenu" align="center">
                                <a href="' . $url . '" target="_blank"><img width="24" height="24" src="' . $imagePath . '" /></a>
                            </td>
                            <td width="300" class="gridmenu" style="vertical-align:top;">
                                ' . lang ( 'Filename', 'Filename' ) . ': ' . $rs [$i] ['filename'] . '
                            </td>
                            <td class="gridmenu" style="vertical-align:top;">
                                ' . lang ( 'Filetype', 'Filetype' ) . ' : ' . $rs [$i] ['extension'] . '
                            </td>
                            <td width="25" align="center" class="gridmenu" style="vertical-align:top;">
                                <a href="javascript:;" onclick="removeFile(\'' . base_url () . getParam ( 1 ) . '\',\'' . $tableName . '\',' . $rs [$i] ['id'] . ', \'file_' . $rs [$i] ['id'] . '\');">
                                    <img src="images/icons/16px/delete.png" width="16" height="16" />
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td  class="gridmenu" style="vertical-align:top;">' . lang ( 'Order index', 'Order index' ) . ' : <input type="text" style="width:40px;" value="' . intval ( $rs [$i] ['seq'] ) . '" onBlur="updateSequence(\'' . $rs [$i] ['id'] . '\', \'' . $tableName . '\', \'' . $_CMD . '\', this);" /></td>
                            <td  class="gridmenu" colspan="2" style="vertical-align:top;">' . lang ( 'Filesizes', 'Filesizes' ) . ' : ' . File::getFormatSize ( $rs [$i] ['filesizes'] ) . '</td>
                        </tr>
                        <tr>
                            <td class="gridmenu" colspan="3" style="vertical-align:top;">' . lang ( 'Download Link', 'Download Link' ) . ':
                                <span style="font-weight:bold;color:blue;">
                                    <textarea>' . $downloadLink . '</textarea>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="gridmenu" colspan="4" style="vertical-align:top;">' . lang ( 'Comment', 'Comment' ) . ': <textarea onBlur="updateFileDesc(' . $rs [$i] ['id'] . ', \'' . $tableName . '\', \'' . $_CMD . '\', this);">' . $rs [$i] ['description'] . '</textarea></td>
                        </tr>
                    </tbody>
                </table>
                <br />
            ';
	}
	$output .= '
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
function getFileContentUploadTool($sid, $uploadKey, $_CMD, $tableName, $user_id) {
	$data = Array (
			'sid' => $sid,
			'uploadKey' => $uploadKey,
			'_CMD' => $_CMD,
			'type' => 'f',
			'table' => $tableName,
			'user_id' => $user_id 
	);
	$db = getDBO ();
	$db->setQuery ( "SELECT * FROM {$tableName} WHERE uploadKey='{$uploadKey}' AND attact_type='f'  AND status='1' ORDER BY seq ASC,id DESC " );
	
	$rs = $db->loadAssocList ();
	$len = count ( $rs );
	$output = '';
	$output .= '    
            <span class="comment"  style="font-size:12px;">' . lang ( 'max_upload_filesize' ) . ' ' . File::getFormatSize ( getConfig ( 'max_upload_filesize' ) * 1024 * 1024 ) . ' รองรับไฟลล์สกุล *.pdf; *.doc; *.docx; *.ppt; *.pptx; *.xls; *.xlsx; *.zip; *.rar;</span>
            <div id="uploader-file"></div>
            <div id="custom-queue-file"  ></div>            
            <script>
                $("#uploader-file").uploadify({
                    height          : 30,
                    width           : 120,
                    wmode           : "transparent",
                    buttonText      : "เลือกไฟล์",
                    swf             : \'' . base_url () . 'js/uploadify-v3.1/uploadify.swf\',
                    uploader        : \'' . base_url () . $_CMD . '/upload\',
                    multi           : true,
                    auto            : true,
                    method          : \'post\',
                    fileTypeExts    : "*.pdf; *.doc; *.docx; *.ppt; *.pptx; *.xls; *.xlsx; *.zip; *.rar;",
                    fileTypeDesc    : "All files",
                    queueID         : "custom-queue-file",
                    onUploadSuccess : function(file, data, response) {
                        addUploadedFile(\'filelist\', data);                        
                    },
                    formData        : ' . json_encode ( $data ) . '
                });
            </script>
        ';
	$output .= '
            <div id="filelist">
        ';
	for($i = 0; $i < $len; $i ++) {
		$imagePath = "images/fileicons_16/{$rs[$i]['extension']}.png";
		if (! file_exists ( $imagePath )) {
			$imagePath = "images/fileicons_16/file.png";
		}
		$url = '../' . $rs [$i] ['filepath'];
		$id = "file{$i}";
		$downloadLink = htmlentities ( base_url () . $rs [$i] ['filepath'] );
		
		$downloadLink = str_replace ( "/admin/", "/", $downloadLink );
		
		$output .= '
                <table width="700" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_' . $rs [$i] ['id'] . '">
                    <tbody>
                        <tr>
                            <td width="200" rowspan="3" class="gridmenu" align="center">
                                <a href="' . $url . '" target="_blank"><img width="24" height="24" src="' . $imagePath . '" /></a>
                            </td>
                            <td width="300" class="gridmenu" style="vertical-align:top;">
                                ' . lang ( 'Filename', 'Filename' ) . ': ' . $rs [$i] ['filename'] . ' 
                            </td>
                            <td class="gridmenu" style="vertical-align:top;">
                                ' . lang ( 'Filetype', 'Filetype' ) . ' : ' . $rs [$i] ['extension'] . '
                            </td>
                            <td width="25" align="center" class="gridmenu" style="vertical-align:top;">
                                <a href="javascript:;" onclick="removeFile(\'' . base_url () . getParam ( 1 ) . '\',\'' . $tableName . '\',' . $rs [$i] ['id'] . ', \'file_' . $rs [$i] ['id'] . '\');">
                                    <img src="images/icons/16px/delete.png" width="16" height="16" />
                                </a>
                            </td>
                        </tr>
                         <tr>
                            <td  class="gridmenu" colspan="3" style="vertical-align:top;">' . lang ( 'Filesizes', 'Filesizes' ) . ' : ' . File::getFormatSize ( $rs [$i] ['filesizes'] ) . '</td>
                        </tr>
                        <tr>
                            <td class="gridmenu" colspan="3" style="vertical-align:top;">' . lang ( 'Download Link', 'Download Link' ) . ': 
                                <span style="font-weight:bold;color:blue;">
                                    <textarea>' . $downloadLink . '</textarea>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="gridmenu" colspan="4" style="vertical-align:top;">' . lang ( 'Comment', 'Comment' ) . ': <textarea onBlur="updateFileDesc(' . $rs [$i] ['id'] . ', \'' . $tableName . '\', \'' . $_CMD . '\', this);">' . $rs [$i] ['description'] . '</textarea></td>
                        </tr>
                    </tbody>
                </table>
                <br />
            ';
	}
	$output .= '
            </div>
        ';
	
	return $output;
}

?>

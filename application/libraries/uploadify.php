<?php
    class Uploadify{
        public static function getFileUploader(
                    $uploadPath, 
                    $controllerName,
                    $data=array(),   
                    $uploadedFiles = array(),
                    $multipleUpload=true,
                    $fileType="*.*",
                    $fileTypeDesc="All Files (*.*)",
                    $sizeLimit=10240000
                )
        {
            $type       = 'file';            
            $output     = '';
            $len        = count($uploadedFiles);
            //Util::pre($uploadedFiles);exit();
            for( $i=0;  $i<$len;  $i++ ){
                $randomName     = random_string('alnum', 9);
                $file           = $uploadedFiles[$i];
                $output .='
                        <div id="'.$randomName.'" class="uploadifyQueueItem upload-div">
                            <div class="cancel">
                                <a href="javascript:;" onclick="if(confirm(\'คุณต้องการลบไฟล์ ?\')){$(\'#'.$randomName.'\').remove();$.post(\''.base_url().$controllerName.'/removeFile/?id='.$file->id.'\')}">
                                    <img src="'.base_url().'js/uploadify-v2.1.4/cancel.png" border="0">
                                </a>
                            </div>
                            <span class="fileName" style="font-size:14px;">
                                ชื่อไฟล์: <span class="upload-filename">'.$file->filename.'</span>&nbsp;
                                <img src="'.base_url().'/images/fileicons_16/'.$file->extension.'.png" />&nbsp;
                                ขนาด: <b>'.File::getFormatSize($file->filesizes).'</b>&nbsp;
                                <a href="'.base_url().$controllerName.'/downloadDocument/?filepath='.$file->filepath.'&name='.$file->filename.'"><img src="../images/download.png" /></a>
                            </span>
                        </div><br />
                ';
            }
            $output     .='
                <div id="custom-queue-'.$type.'" style="border:1px solid rgb(229, 229, 229); height:213px; margin-bottom:10px; width:80%; display:inline-table; overflow:scroll; height:200px;"></div>  
                <br />
                <span class="text-gray">Uploaded: <span id="'.$type.'-count" class="text-blue">0</span> files</span>
                <br /><br />
                <input id="'.$type.'_upload" type="file" name="'.$type.'_upload" />
                <script>
                    $("#'.$type.'_upload").uploadify({
                            "uploader"          : "'. base_url().'js/uploadify-v2.1.4/uploadify.swf",
                            "script"            : "'. $uploadPath.'",
                            "cancelImg"         : "'. base_url().'js/uploadify-v2.1.4/cancel.png",
                            "multi"             : '. $multipleUpload.',
                            "auto"              : true,
                            "fileTypeExts"      : "'. $fileType.'",
                            "fileTypeDesc"      : "'. $fileTypeDesc.'",
                            "queueID"           : "custom-queue-'.$type.'",
                            "simUploadLimit"    : 5,
                            "sizeLimit"         : '. $sizeLimit.',
                            "removeCompleted"   : false,
                            "scriptData"        : '.str_replace('\"','\'',json_encode($data)).',
                            "onDialogClose"     : function(queue) {
                                $("#status-message").text(queue.filesQueued + " files have been added to the queue.");
                            },
                            "onQueueComplete"   : function(stats) {
                                $("#status-message").text(stats.successful_uploads + " files uploaded, " + stats.upload_errors + " errors.");
                            },
                            "removeCompleted"   : "true",
                            "wmode"             : "transparent",
                            "onAllComplete"     : function(event,data){
                                $("#'.$type.'-count").text( parseInt($("#'.$type.'-count").text()) + data.filesUploaded );
                            },
                            "onError"           : function (event,ID,fileObj,errorObj) {
                                alert(errorObj.type + "Error:" + errorObj.info);
                                },
                            "onComplete"        : function(event, ID, fileObj, response, data){
                                if($("#file-container").text()=="None"){
                                    $("#file-container").text("");
                                }
                                $("#file-container").append(response);
                            }
                    });
                </script>
                <br /><br /><br />
            ';      
            $html           = '
            <tr>
                <td><span class="label">File: </span></td>
                <td>
                    <div id="file-container">None</div>                    
                </td>
            </tr>
            <tr>
                <td><span class="label"></span></td>
                <td>'.$output.'</td>
            </tr>    
            ';
            return $html;
            
            
        }
        
        
        
    }
?>


<?PHP
/*
 * <div id="" class="uploadifyQueueItem"><div class="cancel"><a href=""><img src="http://localhost/paloinfo.com/admin/js/uploadify-v2.1.4/cancel.png" border="0"></a></div><span class="fileName">response</span></div>
 */
?>
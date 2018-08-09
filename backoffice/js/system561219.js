function addUploadedFile(targetId, data,pathurl){
    var data                = $.parseJSON(data);
	
    var id                  = '';
    var image               = '';
    if( data.type=='i' ){
        image               = '<img width="64" height="64" src="../'+data.filepath+'" /><br />';
        image               +=  '<div href="javascript:;" class="display_image ui-state-default ui-corner-all" onClick="setDisplayImage(this);" style="width:80px;height:30px;float:left;margin:3px;">'+
                                '   <span class="ui-icon ui-icon-check" style="float:left;"></span>'+
                                '       ตั้งเป็นภาพประจำหัวข้อ'+
                                '</div>'+
                                '<div href="javascript:;" class="display_image ui-state-default ui-corner-all" onClick="insertImage_tiny(\'description\', \'../'+data.filepath+'\');"  style="width:80px;height:30px;float:left;margin:3px;">'+
                                '   <span class="ui-icon ui-icon-check" style="float:left;"></span>'+
                                '       แทรกในเนื้อหา'+
                                '</div>';
    }else{
        image               = '<img width="24" height="24" src="images/fileicons_16/'+data.extension+'.png" />';        
    }
    var html                =   '<table width="700" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_'+data.id+'">'+
                                '<tbody>'+
                                '<tr>'+
                                '   <td width="200" rowspan="2" class="gridmenu" align="center"> '+image+' </td>'+
                                '   <td width="300" class="gridmenu" style="vertical-align:top;">ชื่อไฟล์: '+ data.filename + '</td>'+
                                '   <td class="gridmenu" style="vertical-align:top;">ชนิดไฟล์ : '+ data.extension + '</td>' +
                                '   <td width="25" align="center" class="gridmenu" style="vertical-align:top;">'+
                                '       <a href="javascript:;" onclick="removeFile(\''+data._CMD+'\', \''+data.table+'\', '+data.id+', \'file_'+data.id+'\')">'+
                               '           <img src="images/icons/16px/delete.png" width="16" height="16" />'+
                               '       </a>'+
                                '   </td>'+
                                '</tr>'+
                                '<tr>'+
                                '   <td  class="gridmenu" style="vertical-align:top;">ลำดับที่ : <input type="text" style="width:40px;" value="0" onBlur="updateSequence('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this);" /></td>'+
                                '   <td  class="gridmenu"  colspan="3" style="vertical-align:top;">ขนาดไฟล์  : '+data.size+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                '   <td class="gridmenu" colspan="4" style="vertical-align:top;">คำอธิบาย: <textarea onBlur="updateFileDesc('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this);"></textarea></td>'+
                                '   '+
                                '</tr>'+
                                ''+
                                '</tbody>'+
                                '</table>'+
                                '<br />';
    $("#"+targetId).append(html);                            
}


function insertImage_tiny(insertAt_id, img){
  //  $("#"+insertAt_id).tinymce().execCommand('mceInsertContent', false, '<img src="../../../'+img+'" />');

		CKEDITOR.instances[insertAt_id].insertHtml('<img src="'+base_url+img+'" />');
}
                    
                    

function updateSequence(id, tableName, _CMD, htmlObject){
    var url                 = base_url+_CMD+"/updateSequence/"+id+"/?seq="+htmlObject.value;
    var fileId              = 'file'+id;
    $.post( url,
            function(data){
                $('#'+fileId).remove();
                $(htmlObject).parent().append('<div class="ui-state-active ui-corner-all" style="height:15px;padding:5px;" id="'+fileId+'">update seccessfull</div>');
                setTimeout("removeObject("+fileId+");", 1200);
            });
}


function removeFile(path, table, fileId, tblId){
    $.post(
        path+'/removeFile/',
        {
            id          : fileId,
            table       : table
        },
        function(data){
            $('#'+tblId).remove();
        }
    )
}


function updateFileDesc(id, tableName, _CMD, htmlObject){
    var url                 = base_url+_CMD+"/updateFileDESC/"+id;

    var fileId              = 'file'+id;
    $.post( url,
            {
                description     : htmlObject.value
            },
            function(data){
                $('#'+fileId).remove();
                $(htmlObject).parent().append('<div class="ui-state-active ui-corner-all" style="height:15px;padding:5px;" id="'+fileId+'">update seccessfull</div>');
                setTimeout("removeObject("+fileId+");", 1200);
            });
}


function removeObject(obj){
    $('#'+obj.id).fadeOut(function(){
        $('#'+obj.id).remove();
    });
    
}



function setDisplayImage( htmlObject ){
    var src             = $(htmlObject).parent("table td").children("img").attr('src');
    $('#display_image-show').attr('src',src);
    $('#display_image-show').attr('width',150);
    $('#display_image-show').attr('height',80);
    $('#display_image-show').css('display','inline');
    $('#display_image-del').css('display','inline');
    $('#display_image').val(src.replace('../',''));
}

function delDisplayImage(){
   // var src             = $(htmlObject).parent("table td").children("img").attr('src');
    $('#display_image-show').attr('src',"");
    $('#display_image-show').attr('width',150);
    $('#display_image-show').attr('height',80);
    $('#display_image-show').css('display','none');
    $('#display_image-del').css('display','none');
    $('#display_image').val("");
}
  
           
           
           
function multiSelected(chk){
    if( chk.checked ){
        $('input.chk-topic').prop('checked', true);
    }else{
        $('input.chk-topic').prop('checked', false);
    }
}
                 
                      
function isNumber(data){
    return new RegExp('[0-9]+', 'g').test(data);
}
                    
var showTopicDialog_url     = '';
var showTopicDialog_id      = '';
function showTopicDialog(id, url){
    showTopicDialog_url     = url;
    showTopicDialog_id      = id;
    /*$('#system-dialog').load(url);*/
    $.post( url,
                function(data){
                    $('#system-dialog').html(data);
                    $('#system-dialog').dialog({
                        title               : "-",
                        width               : '900',
                        height              : '600',
                        modal               : true,
                        buttons             : {
                            'ปิด'    : function(){
                                $('#system-dialog').dialog("close");
                            }
                        }
                    });
                });
    
}
function showTopicDialog_reload(){
    $('#system-dialog').load(showTopicDialog_url);
}



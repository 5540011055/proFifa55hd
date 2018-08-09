function addUploadedFile(targetId, data,pathurl){
    var data                = $.parseJSON(data);
    
    var base_url            = pathurl;
    
    
    var id                  = '';
    var image               = '';
    var downloadpath		= '';
    if( data.extension == 'gif' || data.extension == 'png' || data.extension == 'jpg' || data.extension == 'jpeg' || data.extension == 'JPG'){
    	image               = '<img width="110" height="80" src="'+base_url+data.filepath+'"></td>';      	
        downloadpath = '<tr>';
        downloadpath +=	'<td class="gridmenu" colspan="3" style="vertical-align:top;"><b>Download Link:</b>';
        downloadpath +=	'<span style="color:#0061A6;">';
        downloadpath +=	'<textarea style="width: 495px;">'+base_url+data.filepath+'</textarea>';
        downloadpath +=	'</span>';
        downloadpath +=	'</td>';
        downloadpath +=	'</tr>';
    }else{
        image               = '<img width="24" height="24" src="images/fileicons_16/'+data.extension+'.png" />';   
        downloadpath = '<tr>';
        downloadpath +=	'<td class="gridmenu" colspan="3" style="vertical-align:top;"><b>Download Link:</b>';
        downloadpath +=	'<span style="color:#0061A6;">';
        downloadpath +=	'<textarea style="width: 495px;">'+base_url+data.filepath+'</textarea>';
        downloadpath +=	'</span>';
        downloadpath +=	'</td>';
        downloadpath +=	'</tr>';
    }
    var html                =   '<table width="700" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_'+data.id+'" style="margin-bottom: 5px">'+
                                '<tbody>'+
                                '<tr>'+
                                '   <td width="200" rowspan="2" class="gridmenu" align="center"> '+image+' </td>'+
                                '   <td width="300" class="gridmenu" style="vertical-align:top;"><b>filename:</b> '+ data.filename + '</td>'+
                                '   <td class="gridmenu" style="vertical-align:top;"><b>fileSize</b>  : '+data.size+'</td>' +
                                '   <td width="25" align="center" class="gridmenu" style="vertical-align:top;">'+
                                '       <a href="javascript:;" onclick="removeFile(\''+data._CMD+'\', \''+data.table+'\', '+data.id+', \'file_'+data.id+'\')">'+
                               '           <img src="images/icons/16px/delete.png" width="16" height="16" />'+
                               '       </a>'+
                                '   </td>'+
                                '</tr>'+downloadpath+
                                '<tr>'+
                               /* '   <td  class="gridmenu"  colspan="4" style="vertical-align:top;"><b>filetype:</b> '+ data.extension + '</td>'+ */
                                '</tr>'+
                               /* '<tr>'+
                                '   <td class="gridmenu" colspan="4" style="vertical-align:top;">comment: <textarea onBlur="updateFileDesc('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this);"></textarea></td>'+
                                '   '+
                              '</tr>'+ */
                                ''+
                                '</tbody>'+
                                '</table>'+
                                '';
    $("#"+targetId).append(html);                            
}



function addUploadedImg(targetId, data,pathurl){
    var data                = $.parseJSON(data);
    var base_url            = pathurl;
    
    var id                  = '';
    var image               = '';
    var downloadpath		= '';
   
    
    	image               = '<img style="max-height: 128px; max-width: 95%;" src="../'+data.filepath+'" alt="'+data.filepath+'">';
    	set_to_image        = '<a href="javascript:;" onClick="setDisplayImage(\''+data.filepath+'\');" ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 104px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-bookmark " aria-hidden="true"></i>&nbsp;&nbsp;ตั้งเป็นภาพหัวข้อ</button></a>';
    	set_to_content      = '&nbsp;&nbsp;<a href="javascript:;" onClick="insertImage_tiny(\'description\', \'../'+data.filepath+'\', \''+base_url+'\',\'description_en\');"  ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 99px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;แทรกในเนื้อหา</button></a>';
    	txt_area            = '<textarea placeholder="Describe this picture here..." class="filecomment" onBlur="updateFileDesc('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this,\''+base_url+'\');"></textarea>';
    	
    	/*
        downloadpath = '<tr>';
        downloadpath +=	'<td class="gridmenu" colspan="3" style="vertical-align:top;"><b>Download Link:</b>';
        downloadpath +=	'<span style="color:#0061A6;">';
        downloadpath +=	'</span>';
        downloadpath +=	'</td>';
        downloadpath +=	'</tr>';
        */
        
       
       var html  =  '<table width="100%" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_'+data.id+'">' + 
						'<tbody>' + 
						'<tr>' +
							'<td width="20%" rowspan="3" class="gridmenu" align="center"> '+ image +' </td>' +
							'<td width="40%" class="gridmenu">FileName&nbsp;:  '+ data.filename + '</td>' +
							'<td class="gridmenu">FileType :&nbsp;'+ data.extension + ' </td>' +
							'<td width="3%" style="vertical-align: top;" align="center" class="gridmenu"><a href="javascript:;" title="ลบภาพนี้" onclick="removeFile(\''+data._CMD+'\', \''+data.table+'\', '+data.id+', \'file_'+data.id+'\')"><img src="images/icons/cross_circle.png" width="16" height="16"></a></td>' +
						'</tr>' +
		                '<tr>'  +
		                	'<td class="gridmenu">No. &nbsp;<input  type="text" class="fileorder" maxlength="3" value="0" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" onBlur="updateSequence('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this,\''+base_url+'\');" /></td>' +
		                	'<td colspan="2" class="gridmenu">FileSize :&nbsp;'+data.size+'</td>' +
		                '</tr>' +
		                '<tr>' +
		                	'<td colspan="3" class="gridmenu">' + set_to_image + set_to_content + '</td>' +
		                '</tr>'+
		                '<tr>'+
		                	'<td colspan="4" class="gridmenu">Caption :&nbsp'+ txt_area + '</td>' +
		                '</tr>' +
		                '</tbody>' +
		             '</table>' ;
    
   
    
    $("#"+targetId).append(html);                            
}


function addUploadedFiles(targetId, data,pathurl){
    var data                = $.parseJSON(data);
    var base_url            = pathurl;
    
    var id                  = '';
    var icon                = '';
    var downloadpath		= '';
    
    var extension          = (data.extension) ? data.extension : "default"; 
   
    var downloadLink 		=  base_url+'../'+data.filepath;
    
    	//image               = '<img style="max-height: 128px; max-width: 95%;" src="../'+data.filepath+'" alt="'+data.filepath+'">';
    	
    	iconfile            = '<img width="42" height="42" src="images/files_icon/'+extension+'.png" />';      
    	
    	set_to_content      = '&nbsp;&nbsp;<a href="javascript:;" onClick="insertImage_tiny_file(\'description\', \'../'+data.filepath+'\', \''+extension+'\', \''+base_url+'\',\'description_en\');"  ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 99px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;แทรกในเนื้อหา</button></a>';
    	txt_area            = '<textarea placeholder="Describe this file here..." class="filecomment" onBlur="updateFileDesc('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this,\''+base_url+'\');"></textarea>';
    	
    	var downloadpath    = '<textarea ro placeholder="Describe this file here..." class="filelink" onclick="this.focus();this.select()" readonly>'+downloadLink+'</textarea>';
        
       
       var html  =  '<table width="100%" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_'+data.id+'">' + 
						'<tbody>' + 
						'<tr>' +
							'<td width="20%" rowspan="3" class="gridmenu" align="center"> '+ iconfile +' </td>' +
							'<td width="40%" class="gridmenu">FileName&nbsp;:  '+ data.filename + '</td>' +
							'<td class="gridmenu">FileType :&nbsp;'+ data.extension + ' </td>' +
							'<td width="3%" style="vertical-align: top;" align="center" class="gridmenu"><a href="javascript:;" title="ลบไฟล์นี้" onclick="removeFile(\''+data._CMD+'\', \''+data.table+'\', '+data.id+', \'file_'+data.id+'\')"><img src="images/icons/cross_circle.png" width="16" height="16"></a></td>' +
						'</tr>' +
		                '<tr>'  +
		                	'<td class="gridmenu">No. &nbsp;<input  type="text" class="fileorder" maxlength="3" value="0" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" onBlur="updateSequence('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this,\''+base_url+'\');" /></td>' +
		                	'<td colspan="2" class="gridmenu">FileSize :&nbsp;'+data.size+'</td>' +
		                '</tr>' +
		                '<tr>' +
		                	'<td colspan="3" class="gridmenu">' +  downloadpath + '</td>' +
		                '</tr>'+
		                '<tr>'+
		                	'<td colspan="4" class="gridmenu">Caption :&nbsp'+ txt_area + '</td>' +
		                '</tr>' +
		                '</tbody>' +
		             '</table>' ;
    
   
    
    $("#"+targetId).append(html);                            
}


/* VDO single */
function addUploadedVdoSingle(targetId, data,pathurl){
    var data                = $.parseJSON(data);
    var base_url            = pathurl;
    
    var id                  = '';
    var icon                = '';
    var downloadpath		= '';
    
    var extension          = (data.extension != "") ? data.extension : "default"; 
   
    var downloadLink 		=  base_url+'../'+data.filepath;
    
    	//image               = '<img style="max-height: 128px; max-width: 95%;" src="../'+data.filepath+'" alt="'+data.filepath+'">';
    	
    	iconfile            = '<img width="42" height="42" src="images/files_icon/'+extension+'.png" />';      
    	
    	set_to_content      = '&nbsp;&nbsp;<a href="javascript:;" onClick="insertImage_tiny_file(\'description\', \'../'+data.filepath+'\', \''+extension+'\', \''+base_url+'\',\'description_en\');"  ><button type="button" class="btn btn-block btn-xs bg-navy disabled color-palette" style="width: 99px;magin-top:5px;magin-bottom:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;แทรกในเนื้อหา</button></a>';
    	txt_area            = '<textarea placeholder="Describe this file here..." class="filecomment" onBlur="updateFileDesc('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this,\''+base_url+'\');"></textarea>';
    	
    	var downloadpath    = '<textarea ro placeholder="Describe this file here..." class="filelink" onclick="this.focus();this.select()" readonly>'+downloadLink+'</textarea>';
        
       
       var html  =  '<table width="100%" border="0" cellpadding="0" cellspacing="2" class="admintable" id="file_'+data.id+'">' + 
						'<tbody>' + 
						'<tr>' +
							'<td width="20%" rowspan="3" class="gridmenu" align="center"> '+ iconfile +' </td>' +
							'<td width="40%" class="gridmenu">FileName&nbsp;:  '+ data.filename + '</td>' +
							'<td class="gridmenu">FileType :&nbsp;'+ data.extension + ' </td>' +
							'<td width="3%" style="vertical-align: top;" align="center" class="gridmenu"><a href="javascript:;" title="ลบไฟล์นี้" onclick="removeFile(\''+data._CMD+'\', \''+data.table+'\', '+data.id+', \'file_'+data.id+'\')"><img src="images/icons/cross_circle.png" width="16" height="16"></a></td>' +
						'</tr>' +
		                '<tr>'  +
		                	'<td class="gridmenu">No. &nbsp;<input  type="text" class="fileorder" maxlength="3" value="0" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" onBlur="updateSequence('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this,\''+base_url+'\');" /></td>' +
		                	'<td colspan="2" class="gridmenu">FileSize :&nbsp;'+data.size+'</td>' +
		                '</tr>' +
		                '<tr>' +
		                	'<td colspan="3" class="gridmenu">' +  downloadpath + '</td>' +
		                '</tr>'+
		                '<tr>'+
		                	'<td colspan="4" class="gridmenu">Caption :&nbsp'+ txt_area + '</td>' +
		                '</tr>' +
		                '</tbody>' +
		             '</table>' ;
    
   
    
    $("#"+targetId).append(html);                            
}




function addUploadedFileSingle(targetId, data,pathurl){
    var data                = $.parseJSON(data);
	
    var id                  = '';
    var image               = '';
    if( data.type=='i' ){
        image               = '<img width="120" height="80" src="../'+data.filepath+'" /><br />';
   /*     image               +=  '<div href="javascript:;" class="display_image ui-state-default ui-corner-all" onClick="setDisplayImage(this);" style="width:80px;height:30px;float:left;margin:3px;">'+
                                '   <span class="ui-icon ui-icon-check" style="float:left;"></span>'+
                                '       ตั้งเป็นภาพประจำหัวข้อ'+
                                '</div>'+
                                '<div href="javascript:;" class="display_image ui-state-default ui-corner-all" onClick="insertImage_tiny(\'description\', \'../'+data.filepath+'\');"  style="width:80px;height:30px;float:left;margin:3px;">'+
                                '   <span class="ui-icon ui-icon-check" style="float:left;"></span>'+
                                '       แทรกในเนื้อหา'+
                                '</div>'; */
        
    }else{
        image               = '<img width="24" height="24" src="images/fileicons_16/'+data.extension+'.png" />';        
    }
    var html                =   '<table  width="700" border="0" cellpadding="0" cellspacing="2" class="admintable single" id="file_'+data.id+'">'+
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
                                '   <td  class="gridmenu" colspan="4" style="vertical-align:top;">ขนาดไฟล์  : '+data.size+'</td>'+
                                
                                '</tr>'+
                                '<tr>'+
                                '   <td class="gridmenu" colspan="4" style="vertical-align:top;">คำอธิบาย: <textarea onBlur="updateFileDesc('+data.id+', \''+data.table+'\', \''+data._CMD+'\', this);"></textarea></td>'+
                                '   '+
                                '</tr>'+
                                ''+
                                '</tbody>'+
                                '</table>'+
                                '<br />';
    $(".single").remove();
    $("#"+targetId).append(html);                            
}



//function insertImage_tiny(insertAt_id, img){
//    $("#"+insertAt_id).tinymce().execCommand('mceInsertContent', false, '<img src="../../../'+img+'" />');
//}
                    
function insertImage_tiny(insertAt_id, img,base_url,insertAt_id2){
	
    CKEDITOR.instances[insertAt_id].insertHtml('<img src="'+base_url+img+'" />');
    CKEDITOR.instances[insertAt_id2].insertHtml('<img src="'+base_url+img+'" />');
} 


function insertImage_tiny_file(insertAt_id, file,extension,base_url,insertAt_id2){
	
	icon = '<img width="42" height="42" src="'+base_url+'images/files_icon/'+extension+'.png" />'; 
	
    CKEDITOR.instances[insertAt_id].insertHtml('<a target="_blank"  href="'+base_url+file+'" >'+icon+'</a>');
    CKEDITOR.instances[insertAt_id2].insertHtml('<a target="_blank"  href="'+base_url+file+'" >'+icon+'</a>');
    
    
       
}

function updateSequence(id, tableName, _CMD, htmlObject,base_url){
	  var url                 = base_url+_CMD+"/updateSequence/"+id+"/?seq="+htmlObject.value;
	    var fileId              = 'file'+id;
	    $.post( url,
	            function(data){
	                $('#'+fileId).remove();
	                $(htmlObject).parent().append('<div style="font-weight: 100; width: 98%;color: #3c763d !important;background-color: #dff0d8;border-color: #d6e9c6;" role="alert" id="'+fileId+'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Update Successfull! </strong><br> This Sequence has been updated. </div>');
	                setTimeout("removeObject("+fileId+");", 500);
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


function updateFileDesc(id, tableName, _CMD, htmlObject,base_url){
    var url                 = base_url+_CMD+"/updateFileDESC/"+id;
    var fileId              = 'file'+id;
    
  
    $.post( url,
            {
                description     : htmlObject.value
            },
            function(data){
            	$('#'+fileId).remove();
                $(htmlObject).parent().append('<div style="font-weight: 100; width: 98%;color: #3c763d !important;background-color: #dff0d8;border-color: #d6e9c6;" class="alert" role="alert" id="'+fileId+'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Update Successfull! </strong> This Description has been updated. </div>');
                setTimeout("removeObject("+fileId+");", 500);
            });
    
    
    
}


function removeObject(obj){
	
	// console.log(obj);
	
    $('#'+obj.id).fadeOut(function(){
        $('#'+obj.id).remove();
    });
    
}


/*
function setDisplayImage( htmlObject ){
    var src             = $(htmlObject).parent("table td").children("img").attr('src');
    $('#display_image-show').attr('src',src);
    $('#display_image-show').attr('width',150);
    $('#display_image-show').attr('height',80);
    $('#display_image-show').css('display','inline');
    $('#display_image').val(src.replace('../',''));
}*/
           
     
function setDisplayImage( htmlObject ){
	
	  var src = htmlObject;
	
	 //var src             = $(htmlObject).parent("table td").children("img").attr('src');
	 
	  	$(".deltxt").hide();
	 
	 	$('#display_image-show').attr('src','../'+src);
	    $("#display_image-show").css("display","block"); 
	    $("#display_image-del").css("display","block"); 
	    $('#display_image').val(src); 
	    
	   
}

function setDisplayImage2( htmlObject ){
	var src = $(htmlObject).parent("table td").children("img").attr('src');
	var vals = $(htmlObject).parent("table td").children("img").attr('alt');

	$('#display_image-show').attr('src',src);
	$('#display_image-show').attr('width',120);
	$('#display_image-show').attr('height',80);
	$('#display_image-show').css('display','inline');
	$('#display_image-del').css('display','inline');
	$('#display_image').val(src);
	
	$('#display_image').val(vals.replace('../',''));
	$('#display_img').css('display','block');
}

	function delDisplayImage(){
	// var src = $(htmlObject).parent("table td").children("img").attr('src');
	$('#display_image-show').attr('src',"");
	$('#display_image-show').css('display','none');
	$('#display_image-del').css('display','none');
	
	$('#display_image').val("");
	$(".deltxt").show();


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


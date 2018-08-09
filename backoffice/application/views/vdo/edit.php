<link rel="stylesheet" href="<?=base_url()?>dist/css/formValidation.css"/>
<script type="text/javascript" src="<?=base_url()?>dist/js/formValidation.js"></script>
<script type="text/javascript" src="<?=base_url()?>dist/js/framework/bootstrap.js"></script>
<script src="<?=base_url()?>dist/js/chkform_alert.js"></script>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
		
			<!-- /.box-header -->
			<div class="panel panel-grey font13">
                  
                    <div class="panel-body">
                     
                      
                      <!-- Table -->
                  <form action="<?=base_url().$_CMD.'/'.$task?>" method="post" name="adminTable" id="adminTable"  class="form-horizontal"  >
                   
                    <input type="hidden" name="id" value="<?=@$frm['id']?>">
                   <input type="hidden" id="display_image" name="display_image" value="<?=@$frm['display_image']?>">
				   <input type="hidden" id="uploadKey" name="uploadKey" value="<?=@$uploadKey?>">
                   
                   <table class="table" >
                    <tbody>
                    
                     <tr>
			            <td  colspan="2" style="border-top: none;" class="brd-crum"><?=@$data['iconName']?> <?=@$data['menuName']?></td>
           			 </tr>    
                    
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject">
	                        <label class="col-sm-2 right_b" >หัวข้อ<font class="req">*</font> <?=getLangImg("th");?></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="subject"  value="<?=@$frm["subject"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>


 					<tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject_en">
	                        <label class="col-sm-2 right_b" >หัวข้อ<font class="req">*</font> <?=getLangImg("en");?></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="subject_en"  value="<?=@$frm["subject_en"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group" id="title">
	                        <label class="col-sm-2 right_b" >คำอธิบาย<font class="req">*</font> <?=getLangImg("th");?></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                        	<textarea name="title" rows="3" cols="" class="form-control input-sm" ><?=@$frm["title"]?></textarea>   
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group" id="title_en">
	                        <label class="col-sm-2 right_b" >คำอธิบาย<font class="req">*</font> <?=getLangImg("en");?></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                        	<textarea name="title_en" rows="3" cols="" class="form-control input-sm" ><?=@$frm["title_en"]?></textarea>   
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                     <tr>
                         <td colspan="2">
                          <div class="form-group">
	                        <label class="col-sm-2 right_b">ไฟล์วีดีโอ<font class="req">*</font></label>
	                        <div class="col-sm-10 col-md-8 pad_3">
	                            
	                            
	                           <ul class="nav nav-tabs nav-vdo">
						            <li class="active"><label><input type="radio" name="vdo_source" id="vdo_source1" value="1" class="flat-red"  <?=(@$frm["vdo_source"]=="1") ? "checked" : "";?>/> Youtube</label></li>
						            <li class=""><label><input type="radio" name="vdo_source"  id="vdo_source2" value="2" class="flat-red" <?=(@$frm["vdo_source"]=="2") ? "checked" : "";?> />  Upload File</label></li>         
						       </ul> 
	                             
	                             <div class="tab-content" style="padding-left: 0px;">
						                  <div class="tab-pane <?=(@$frm["vdo_source"]=="1") ? "active" : "";?>" id="vdo_from_1">
						                    Youtube URL:
						                     <input type="text" class="form-control input-sm" placeholder="Copy URL จาก Youtube มาวางที่นี่" name="youtube_url" id="youtube_url"  value="<?=@$frm["youtube_url"]?>" style="max-width: 345px;">
						                     
						                     <button type="button" class="btn btn-block btn-default btn-xs" id="preview-youtube" style="width: 100px !important;margin:5px 0 !important;font-weight: bold !important; color: #777;"><i class="fa fa-play"></i>&nbsp;&nbsp;&nbsp;Preview</button>
						                     
						                     <br><font style="font-weight: bold;  color: #dd4b39;">**Example: https://www.youtube.com/watch?v=sSdN8CP7hCU</font><br>
						                     
						                  </div><!-- /.tab-pane -->
						                  
						                  <div class="tab-pane <?=(@$frm["vdo_source"]=="2") ? "active" : "";?>" id="vdo_from_2">
												 <?=getVdoUploadToolSingle( $sid, $uploadKey, $_CMD, $table['file'], $user['id'])?>
												 <br><font style="font-weight: bold;  color: #dd4b39;">**อัพโหลดได้ 1ไฟล์/หัวข้อ</font><br>
						                  </div><!-- /.tab-pane -->
						                </div><!-- /.tab-content -->
	                             
	                             
	                        </div>
	                      </div>        
                         
                        </td>
                    </tr>
                    
                    
                       <tr>
                         <td colspan="2">
                          <div class="form-group">
	                        <label class="col-sm-2 right_b" >วีดีโอแนะนำ<font class="req">*</font></label>
	                        <div class="col-sm-8 col-md-4 pad_3"  >
	                            <span title="คลิกอัพเดท">
	                            	<input type="checkbox"  name="recommend"  value="1" <?=(@$frm['recommend']== 1 ?  'checked': '')?>  data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-style="ios"  data-onstyle="success2">
	                       		</span>
	                        </div>
	                      </div>        
                         
                        </td>
                    </tr>
                    
                    
                     <tr>
                         <td colspan="2">
                          <div class="form-group" style="margin-top: 5px;">
	                        <label class="col-sm-2 right_b" >สถานะ<font class="req">*</font></label>
	                        <div class="col-sm-8 col-md-4 pad_3"  >
	                            <span title="คลิกเปลี่ยนสถานะ">
	                            	<input  type="checkbox" name="status"  value="1"  <?=(@$frm['status']== 1 ?  'checked': '')?>  data-toggle="toggle" data-on='Active' data-off="InActive" data-onstyle="primary" data-offstyle="danger" >
	                       		</span>
	                        </div>
	                      </div>        
                         
                        </td>
                    </tr>
                    
                    
                    
                    <tr>
                         <td colspan="2" style="height: 70px;vertical-align: bottom;">
                          <div class="form-group">
	                        <label class="col-sm-2">&nbsp;</label>
	                        <div class="col-sm-10 col-md-8 pad_3" style="max-width:750px;">
	                        	<button class="btn btn-block btn-danger btn-sm pull-right btnFrmBack" type="button" id="Back" name="Back" onclick="window.location.href='<?=base_url().getParam("1")?>';"><i class="fa fa-history"></i> <?=lang('cancel', 'cancel')?></button>
	                           	<button class="btn btn-block btn-success btn-sm pull-right btnFrmSubmit" type="submit" id="Save" name="Save"><i class="fa fa-floppy-o"></i> <?=lang('Save','Save')?></button>
	                        </div>
	                      
	                      </div>        
                         
                        </td>
                    </tr>
                  </tbody></table>
                   </form>     
                      <!-- Table -->

                   
                   
                    </div>     
                   <!-- /.panel-body -->              
         </div>
         <!-- /.box-body -->
			
		</div>
		<!-- /.box -->
	</div>
</div>

<script>
 $(function(){
		$("#youtube_url").keyup(function() {
			 $("#youtube_url").css("background","none");
		});

		$('#vdo_source1').on('ifChecked', function(event){
			$('#vdo_from_2').hide();
			$('#vdo_from_1').fadeIn("slow");
	   });
		
	   $('#vdo_source2').on('ifChecked', function(event){
			$('#vdo_from_1').hide();
			$('#vdo_from_2').fadeIn("slow");
	   });	


		$("#preview-youtube").click(function() { 

		        var youtube_url = $("#youtube_url").val();

	              if(youtube_url==""){
	            	  $("#youtube_url").css("background","#f2dede");
		          }else{
		        	  youtube_url          = youtube_url.split("?");
		        	  youtube_url          = youtube_url[1].replace('v=','');

			         	$('#vdo-sample').html('<iframe src="http://www.youtube.com/embed/'+youtube_url+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
					  	$("#videoModal").modal('toggle');
					  
			      }
	      });  
 });
</script>

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
	                        <label class="col-sm-2 right_b" >หัวข้อ<font class="req">*</font> </label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="subject"  value="<?=@$frm["subject"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>


                    
                    
                    
                    
                   <tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject_en">
	                        <label class="col-sm-2 right_b" >ประเภท<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
				                      <?=getAllCID(0, $table['category'], @$frm['cid'])?>   
	                        </div>
	                      </div>
                      </td> 
                    </tr> 
                    
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >เนื้อหา </label>
	                        <div class="col-sm-10 col-md-8 pad_3">
	                           
	                           <?=getDescription('description', 'description', @$frm["description"])?>
	                           
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" ><?=lang('display_image', 'display_image')?> :</label> 
	                        <div class="col-sm-10 col-md-8 pad_3">
	                             <?PHP
                       				$displayImg_style           = '';
				                        if(!@$frm['display_image']){
				                            $displayImg_style   = 'display:none;';
				                            
				                            echo '<span class="deltxt">ไม่มีภาพประจำหัวข้อ</span>';
				                        }
                   				 ?>
                   				
                   				<table width="100%" border="0" cellpadding="0" cellspacing="2" class="admintablePic" >
									<tbody>
										<tr>
											<td width="20%" class="gridmenu" align="center">
												<img id="display_image-show" style="max-height: 128px; max-width: 95%; <?=$displayImg_style?>" src="<?=(@$frm['display_image']?'../'.@$frm['display_image']:'')?>">
											</td>
											<td width="80%" class="gridmenu" style="vertical-align:top;">
												<img src="images/icons/cross_circle.png" style="cursor: pointer;<?=$displayImg_style?>" id="display_image-del" width="16" height="16" title="ลบภาพประหัวข้อ"  onclick="delDisplayImage();">
											</td>
										</tr>
										
									</tbody>
								</table>
                   				
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                   
               
                     <tr>
                         <td colspan="2">
                          <div class="form-group">
	                        <label class="col-sm-2 right_b">แนบไฟล์ภาพ</label>
	                        <div class="col-sm-10 col-md-8 pad_3">
	                             <?=getImageUploadTool( $sid, $uploadKey, $_CMD, $table['file'], $user['id'])?>
	                        </div>
	                      </div>        
                         
                        </td>
                    </tr>
                    
                    
                     <tr>
                         <td colspan="2">
                          <div class="form-group">
	                        <label class="col-sm-2 right_b">แนบไฟล์เอกสาร</label>
	                        <div class="col-sm-10 col-md-8 pad_3">
	                             <?=getFileUploadTool( $sid, $uploadKey, $_CMD, $table['file'], $user['id'])?>
	                        </div>
	                      </div>        
                         
                        </td>
                    </tr>
                    
                    
                       <tr>
                         <td colspan="2">
                          <div class="form-group">
	                        <label class="col-sm-2 right_b" >Special Offer<font class="req">*</font></label>
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

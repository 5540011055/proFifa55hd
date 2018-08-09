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
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >เลขที่บัญชี<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรอกข้อมูล (เฉพาะตัวเลข)" name="account_number"  value="<?=@$frm["account_number"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>  
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject">
	                        <label class="col-sm-2 right_b" >ชื่อบัญชี<font class="req">*</font> <?=getLangImg("th");?></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="subject"  value="<?=@$frm["subject"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>


 					<tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject_en">
	                        <label class="col-sm-2 right_b" >ชื่อบัญชี<font class="req">*</font> <?=getLangImg("en");?></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="subject_en"  value="<?=@$frm["subject_en"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                     
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group" id="cid">
	                        <label class="col-sm-2 right_b" >ธนาคาร<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
				                      <?=getAllCID(0, $table['category'], @$frm['cid'])?>   
	                        </div>
	                      </div>
                      </td> 
                    </tr> 
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group" id="branch">
	                        <label class="col-sm-2 right_b" >สาขา<font class="req">*</font> <?=getLangImg("th");?></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="branch"  value="<?=@$frm["branch"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>


 					<tr>
                      <td colspan="2">
	                      <div class="form-group" id=""branch"_en">
	                        <label class="col-sm-2 right_b" >สาขา<font class="req">*</font> <?=getLangImg("en");?></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="branch_en"  value="<?=@$frm["branch_en"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group" id="cid">
	                        <label class="col-sm-2 right_b" >ประเภท<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
				                      <select name="type" class="form-control input-sm">
				                      	<option> --- กรุณาเลือกประเภทบัญชี ---</option>
				                      		<?php for($i=0;$i<count($type);$i++){
				                      			
				                      			$selec = ($type[$i]["id"]==$frm['type']) ? 'selected="selected"' : '' ;
				                      			?>                
				                      			<option value="<?=$type[$i]["id"]?>" <?=@$selec?>><?=$type[$i]["type_name"]?></option>
				                      		<?php } ?>
				                      </select> 
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

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
                   
                   <table class="table" >
                    <tbody>
                    
                     <tr>
			            <td  colspan="2" style="border-top: none;" class="brd-crum"><?=@$data['iconName']?> <?=@$data['menuName']?></td>
           			 </tr> 
           			 
           			  <tr>
			            <td  colspan="2" style="border-top: none;">&nbsp;</td>
           			 </tr>   
                    
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject">
	                        <label class="col-sm-2 right_b" >ชื่อ - สกุล :</label> 
	                        <div class="col-sm-8 col-md-4 ">
	                            <?=@$frm["name"]?>
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                  
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject">
	                        <label class="col-sm-2 right_b" >หมายเลขโทรศัพท์ : </label> 
	                        <div class="col-sm-8 col-md-4 ">
	                       		<?=@$frm["phone"]?>
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                      <tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject">
	                        <label class="col-sm-2 right_b" >LINE ID : </label> 
	                        <div class="col-sm-8 col-md-4 ">
	                       		<?=@$frm["line_id"]?>
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                     <!-- 
                      <tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject">
	                        <label class="col-sm-2 right_b" >อีเมล์ : </label> 
	                        <div class="col-sm-8 col-md-4 ">
	                        	<?//=@$frm["email"]?>
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                     -->
                    
                                        
                     <tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject">
	                        <label class="col-sm-2 right_b" >วันที่ร้องขอการสมัคร : </label> 
	                        <div class="col-sm-8 col-md-4 ">
	                        	<?=shortThDateYearlongY(@$frm["create_date"])?>
	                        </div>
	                      </div>
	                     
                      </td> 
                    </tr>
                    
                    
                    
                     <tr>
                         <td colspan="2">
                          <br>
                          <div class="form-group" style="margin-top: 5px;">
	                        <label class="col-sm-2 right_b" >ดำเนินการ<font class="req">*</font></label>
	                        <div class="col-sm-8 col-md-4 pad_3"  >
	                            <span title="คลิกเปลี่ยนสถานะ">
	                            	<input  type="checkbox" name="status"  value="1"  <?=(@$frm['status']== 1 ?  'checked': '')?>  data-toggle="toggle" data-on='<?=lang('t-approve','t-approve')?>' data-off="<?=lang('t-notapprove','t-notapprove')?>" data-onstyle="primary" data-offstyle="danger" >
	                       		</span>
	                        </div>
	                      </div>        
                         
                        </td>
                    </tr>
                    
                    
                    <tr>
                         <td colspan="2" style="height: 70px;vertical-align: bottom;">
                          <div class="form-group">
	                        <label class="col-sm-2">&nbsp;</label>
	                        <div class="col-sm-10 col-md-8 " style="max-width:750px;">
	                        <button class="btn btn-block btn-success btn-sm pull-left btnFrmSubmit" type="submit" id="Save" name="Save"><i class="fa fa-floppy-o"></i> <?=lang('Save','Save')?></button>  
	                        <button class="btn btn-block btn-danger btn-sm pull-left btnFrmBack" type="button" id="Back" name="Back" onclick="window.location.href='<?=base_url().getParam("1")?>';"><i class="fa fa-history"></i> กลับไปหน้าหลัก</button>
	                           
	                        	
	                        	 
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




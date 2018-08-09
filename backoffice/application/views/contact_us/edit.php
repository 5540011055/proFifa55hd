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
	                        <label class="col-sm-2 right_b" >ชื่อผู้ติดต่อ :</label> 
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
	                        <label class="col-sm-2 right_b" >รายละเอียด :</label> 
	                        <div class="col-sm-8 col-md-4 ">
	                         	<?=@$frm["message"]?>
	                         </div>
	                      </div>
                      </td> 
                    </tr>
                    
                  
                  
                     <tr>
                      <td colspan="2">
	                      <div class="form-group" id="subject">
	                        <label class="col-sm-2 right_b" >วันที่ส่ง : </label> 
	                        <div class="col-sm-8 col-md-4 ">
	                        	<?=shortThDateYearlongY(@$frm["create_date"])?>
	                        </div>
	                      </div>
                      </td> 
                    </tr>


                    <tr>
                         <td colspan="2" style="height: 70px;vertical-align: bottom;">
                          <div class="form-group">
	                        <label class="col-sm-2">&nbsp;</label>
	                        <div class="col-sm-10 col-md-8 " style="max-width:750px;">
	                        	<button class="btn btn-block btn-danger btn-sm pull-left btnFrmBack" type="button" id="Back" name="Back" onclick="window.location.href='<?=base_url().getParam("1")?>';"><i class="fa fa-history"></i> กลับไปหน้าหลัก</button>
	                           	<!-- <button class="btn btn-block btn-success btn-sm pull-right btnFrmSubmit" type="submit" id="Save" name="Save"><i class="fa fa-floppy-o"></i> <?//=lang('Save','Save')?></button>  -->
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




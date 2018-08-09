<link rel="stylesheet" href="<?=base_url()?>dist/css/formValidation.css"/>
<script type="text/javascript" src="<?=base_url()?>dist/js/formValidation.js"></script>
<script type="text/javascript" src="<?=base_url()?>dist/js/framework/bootstrap.js"></script>
<script src="<?=base_url()?>dist/js/chkform_alert.js"></script>

<?php $readonly = ($task=="update") ? "readonly" : "";?>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
		
			<!-- /.box-header -->
			<div class="panel panel-grey font13">
                  
                   <div class="panel-body">
                     
                      
                      <!-- Table -->
                  <form action="<?=base_url().$_CMD.'/'.$task?>" method="post" name="adminTable" id="adminTable"  class="form-horizontal"  >
                   
                   
                   <table class="table" >
                    <tbody>
                    
                     <tr>
			            <td  colspan="2" style="border-top: none;" class="brd-crum"><?=@$data['iconName']?> <?=@$data['menuName']?></td>
           			 </tr>    
                   
                  	 <tr>
                      <td colspan="2" style="border: none;">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b"> </label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                        		<div style="font-size:14px;margin-bottom:0px; color: #3c763d !important;background-color: #dff0d8;border-color: #d6e9c6; <?=(@$success) ? 'display:block;' : 'display:none;' ;?>" class="alert" role="alert" id="passsuccess">
	                        			<strong>เปลี่ยนรหัสผ่านสำเร็จ !!</strong>
	                        			<br> กรุณาใช้รหัสผ่านใหม่เข้าสู่ระบบในภายหลัง<br><br>
	                        			<font style="font-size: 14px;color: #a94442;"><i class="fa fa-spinner fa-pulse fa-fw"></i> กรุณารอ <span id="redirect-sec">6</span> วินาที <u>กำลังนำออกจากระบบ</u> </font>
	                        		 </div>
			
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >ชื่อผู้ใช้งาน<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="usernames" id="usernames"  value="<?=@$frm["username"]?>" <?=@$readonly?>>
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >รหัสผ่านเดิม<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="password" class="form-control input-sm" placeholder="กรุณากรอกรหัสผ่านเดิม" name="password" id="password" onfocusout="check_oldpass(this.value);" >
	                            
	                            <small id="passnotmatch" class="help-block" style="display: none; color: #a94442;">รหัสผ่านเดิมไม่ถูกต้อง !!</small>
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >รหัสผ่านใหม่<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="password" class="form-control input-sm" placeholder="กรุณากรอกรหัสผ่านใหม่" name="newpassword" id="newpassword" >
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                      <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >ยืนยันรหัสผ่านใหม่<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="password" class="form-control input-sm" placeholder="กรุณายืนยันรหัสผ่านใหม่" name="renewpassword" id="renewpassword"  >
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                  
                    <tr>
                         <td colspan="2" style="height: 70px;vertical-align: bottom;">
                          <div class="form-group">
	                        <label class="col-sm-2">&nbsp;</label>
	                        <div class="col-sm-10 col-md-8 pad_3" style="max-width:750px;">
	                        	<button style="width: 140px;" class="btn btn-block btn-success btn-sm pull-left  btnFrmSubmit" type="submit" id="Save" name="Save"><i class="fa fa-floppy-o"></i> <?=lang('savepass','savepass')?></button>
	                        	<button class="btn btn-block btn-danger btn-sm pull-left btnFrmBack" type="button" id="Back" name="Back" onclick="window.location.href='<?=base_url().getParam("1")?>';"><i class="fa fa-history"></i> <?=lang('cancel2', 'cancel2')?></button>
	                           	
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
  function check_oldpass(oldpass){
	   if(oldpass){
		   $.post("<?=base_url().getParam('1').'/checkOldPass'?>", { oldpass: oldpass}).done(function(data) {
		     	if(!data){
		     		$('#passnotmatch').show();
		     		$("#password").val("");
					$("#password").removeAttr('value');
			    }
		   });
	   }
  }

  $("#password").keyup(function() {
	  $('#passnotmatch').hide();
  });

  
</script>
<?php 
	if(@$success){
		echo '<script>function nextPage(delay){ $("#redirect-sec").text(--delay); if(delay>0){ setTimeout("nextPage("+delay+");",1200);}else{ window.location="authentication/logout";}} $(function(){ setTimeout("nextPage(6);", 1200); })</script>';
	}
?>


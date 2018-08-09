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
                   
                    <input type="hidden" name="id" value="<?=@$frm['id']?>">
                   <input type="hidden" id="display_image" name="display_image" value="<?=@$frm['avatar']?>">
				   <input type="hidden" id="uploadKey" name="uploadKey" value="<?=@$uploadKey?>">
                   
                   <table class="table" >
                    <tbody>
                    
                     <tr>
			            <td  colspan="2" style="border-top: none;" class="brd-crum"><?=@$data['iconName']?> <?=@$data['menuName']?></td>
           			 </tr>    
                        
                     <tr>
                      <td colspan="2">
	                      <div class="form-group" id="fullname">
	                        <label class="col-sm-2 right_b" >ชื่อ - สกุล<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="fullname"  value="<?=@$frm["fullname"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group" id="address">
	                        <label class="col-sm-2 right_b" >ที่อยู่<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="address"  value="<?=@$frm["address"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >จังหวัด<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                           <select name="province" id="province" class="form-control input-sm" >
                            			<option value=""> --- กรุณาเลือกจังหวัด --- </option>
                            		<?php for($i=0;$i<count(@$porvince_rs);$i++){
                            		
                            			$sel_pro = (@$porvince_rs[$i]["province_id"] == @$frm["province"]) ? 'selected="selected"' : '' ;
                            			?>	
                            			<option value="<?=$porvince_rs[$i]["province_id"]?>" <?=@$sel_pro?>> <?=$porvince_rs[$i]["province_name"]?> </option>
                            		<?php } ?>
                               </select>
	                           
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >อำเภอ<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                           <select name="amphur" id="amphur" class="form-control input-sm" >
                            			<option value=""> --- กรุณาเลือกอำเภอ --- </option>
                            		<?php for($i=0;$i<count(@$amphur_rs);$i++){
                            			$sel_amp = (@$amphur_rs[$i]["amphur_id"] == @$frm["amphur"]) ? 'selected="selected"' : '' ;
                            			?>	
                            			<option value="<?=$amphur_rs[$i]["amphur_id"]?>" <?=@$sel_amp?>> <?=$amphur_rs[$i]["amphur_name"]?> </option>
                            		<?php } ?>
                               </select>
	                           
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >ตำบล<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                           <select name="district" id="district" class="form-control input-sm" >
                            			<option value=""> --- กรุณาเลือกตำบล --- </option>
                            		<?php for($i=0;$i<count(@$district_rs);$i++){
                            		
                            			$sel_dis = (@$district_rs[$i]["district_id"] == @$frm["district"]) ? 'selected="selected"' : '' ;
                            			?>	
                            			<option value="<?=$district_rs[$i]["district_id"]?>" <?=@$sel_dis?>> <?=$district_rs[$i]["district_name"]?> </option>
                            		<?php } ?>
                               </select>
	                           
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >รหัสไปรษณีย์<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="postcode" id="postcode"  value="<?=@$frm["postcode"]?>" maxlength="5" >
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >อีเมล์<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="email" id="email"  value="<?=@$frm["email"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >โทรศัพท์</label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" name="phone" id="phone"  value="<?=@$frm["phone"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    

                    <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >รูปประจำตัว</label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                              <?=getImageUploadToolBanner( $sid, $uploadKey, $_CMD, $table['file'], $user['id'])?>
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >สิทธิ<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                           <select name="priv" id="priv" class="form-control input-sm" >
                            			<option value=""> --- กรุณาเลือกสิทธิ --- </option>
                            		<?php for($i=0;$i<count(@$users_priv_rs);$i++){
                            		
                            			$sel_priv = (@$users_priv_rs[$i]["priv_value"] == @$frm["priv"]) ? 'selected="selected"' : '' ;
                            			?>	
                            			<option value="<?=$users_priv_rs[$i]["priv_value"]?>" <?=@$sel_priv?>> <?=$users_priv_rs[$i]["priv_name"]?> </option>
                            		<?php } ?>
                               </select>
	                           
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >กลุ่มผู้ใช้<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                           <select name="userclass" id="userclass" class="form-control input-sm" >
                            			<option value=""> --- กรุณาเลือกกลุ่ม --- </option>
                            		<?php for($i=0;$i<count(@$users_class_rs);$i++){
                            		
                            			$sel_class = (@$users_class_rs[$i]["class_value"] == @$frm["userclass"]) ? 'selected="selected"' : '' ;
                            			?>	
                            			<option value="<?=$users_class_rs[$i]["class_value"]?>" <?=@$sel_class?>> <?=$users_class_rs[$i]["class_name"]?> </option>
                            		<?php } ?>
                               </select>
	                           
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
               

                    <tr style="background: aliceblue;">
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >Username<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="username" id="username"  value="<?=@$frm["username"]?>" <?=@$readonly?>>
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    <tr style="background: aliceblue;">
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >Password<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="password" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="password" id="password"  value="<?=@$frm["password"]?>" <?=@$readonly?>>
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                      <tr style="background: aliceblue;">
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >Confirm Password<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="password" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="repassword" id="repassword"  value="<?=@$frm["password"]?>" <?=@$readonly?>>
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

	 $("#province").change(function(){
	     var province = this.value;

	     if(province){
	    	 $.post( '<?=base_url().getParam('1')."/getAmphur"?>', { province_sel: province }).done(function( data ) {
	    	      if(data){
	    	    	  $("#amphur").html(data);
		    	  }
	    	 });
		 }
	   
	  });


	 $("#amphur").change(function(){
	     var amphur = this.value;

	     if(amphur){
	    	 $.post( '<?=base_url().getParam('1')."/getDistrict"?>', { amphur_sel: amphur }).done(function( data2 ) {
	    	      if(data2){
	    	    	  $("#district").html(data2);
	    	    	  
		    	  }
	    	 });
		 }
	   
	  });


	 $("#district").change(function(){
	     var district = this.value;

	     if(district){
	    	 $.post( '<?=base_url().getParam('1')."/getPostcode"?>', { district_sel: district }).done(function( data3 ) {
	    	      if(data3){
	    	    	  $("#postcode").val(data3);
	    	    	  
		    	  }
	    	 });
		 }
	   
	  });


	 $("#priv").change(function(){
	     var priv = this.value;

	     if(priv){
	    	 $.post( '<?=base_url().getParam('1')."/getUserclass"?>', { priv_sel: priv }).done(function(data4) {
	    	      if(data4){
	    	    	  $("#userclass").html(data4);
	    	    	  
		    	  }
	    	 });
		 }
	   
	  });


</script>


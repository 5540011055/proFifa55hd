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
                 
                   <table class="table" >
                    <tbody>
                    
                     <tr>
			            <td  colspan="2" style="border-top: none;" class="brd-crum"><?=@$data['iconName']?> <?=@$data['menuName']?></td>
           			 </tr> 
           			 
           			 <tr>
			            <td  colspan="2" style="border: none;"> &nbsp; </td>
           			 </tr>    
                    
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >ชื่อกลุ่ม <font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="class_name"  value="<?=@$frm["class_name"]?>">
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                     <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >กลุ่มผู้ใช้ (Class Value) <font class="req">*</font><br></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" name="class_value"  value="<?=@$frm["class_value"]?>">
	                            &nbsp;<font color="#3a6491">(Example. superadmin, admin)</font>
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
                            		<?php for($i=0;$i<count($users_priv_rs);$i++){
                            		
                            			$sel_priv = (@$users_priv_rs[$i]["priv_value"] == @$frm["class_priv"]) ? 'selected="selected"' : '' ;
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
	                        <label class="col-sm-2 right_b" >เมนูที่ใช้งานได้<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                           
	                           
	                           	<?php
	                           	
	                           	echo '<ul class="list-unstyled boder-ul" >';
	                           	
	                           	for($i=0;$i<count($menu);$i++){
	                           			
	                           		$style  = ($i==0) ? '' : 'style="margin-top: 15px;"';
	                           		$style2 = 'style="margin-top: 3px;margin-left: 33px;"';
	                           		$class  = $menu[$i]["sort_main"]; 
	                           		
	                           		$privadmin = "priv_".@$frm["class_value"];
	                           		
	                           		$checked = (@$menu[$i]["$privadmin"]=="allow") ?  'checked' : '' ;
	                           		
	                           		if($menu[$i]["sort_sub"]=="0"){
	                           			echo '<li '.$style.' class="chkbox_head"><input type="checkbox" name="menu[]" class="flat-red main_'.@$class.'"  title="'.@$class.'" value="'.$menu[$i]["id"].'" '.@$checked.' >&nbsp;<b>'.$menu[$i]["menuname"].'</b></li>';
	                           		}else{
	                           			echo '<ul class="list-unstyled">';
	                           				echo '<li '.$style2.'><input type="checkbox" name="menu[]" class="flat-red '.@$class.'" title="'.@$class.'" value="'.$menu[$i]["id"].'" '.@$checked.' >&nbsp;'.$menu[$i]["menuname"].'</li>';
	                           			echo '</ul>';
	                           			
	                           		}
	                            }
	                            
	                            echo "</ul>";
	                            ?>
	                           
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    
                  
                    
                    <tr>
                         <td colspan="2" style="height: 70px;vertical-align: bottom;">
                          <div class="form-group">
	                        <label class="col-sm-2">&nbsp;</label>
	                        <div class="col-sm-10 col-md-8 pad_3" style="max-width:750px;">
	                        	<button class="btn btn-block btn-success btn-sm pull-left btnFrmSubmit" type="submit" id="Save" name="Save"><i class="fa fa-floppy-o"></i> <?=lang('Save','Save')?></button>
	                        	<button class="btn btn-block btn-danger btn-sm pull-left btnFrmBack" type="button" id="Back" name="Back" onclick="window.location.href='<?=base_url().getParam("1")?>';"><i class="fa fa-history"></i> <?=lang('cancel', 'cancel')?></button>
	                           	
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
	$('input:checkbox').on('ifChecked', function() {
		var class_chk = $(this).attr('class'); 
		    classArray = class_chk.split(" ");
	
		    $('.main_'+classArray[1]).iCheck('check');	
	});

	
</script>

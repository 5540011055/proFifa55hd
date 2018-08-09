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
               
               <?PHP
                for( $i=0;  $i< count($key);  $i++ ){ 
                	
                	if( ($key[$i]=="id") || ($key[$i]=="local_id") || ($key[$i]=="admin_title") || ($key[$i]=="company_address_footer") ||
                		($key[$i]=="company_phone_footer") || ($key[$i]=="company_email_footer") ){  // field except
                		continue;
                	}
                	
                	// check second field value
                	$placehoder = (substr($key[$i], -1) == "2") ? "เว้นว่างไว้ หากไม่มีข้อมูล" : "" ;
                	
                	// check row fo text area       
                	$rows_txt = (($key[$i]=="description") || ($key[$i]=="keyword")) ? 5 : 3 ;
                	
               
                	switch($key_type[$i]){
                		case 'text'     : $input_txt = '<textarea rows="'.@$rows_txt.'" class="form-control input-sm" name="'.$key[$i].'" id='.$key[$i].' placeholder="'.@$placehoder.'" >'.$frm[$key[$i]].'</textarea>'; break;
                		case 'int'      :
                		case 'float'    :
                		case 'double'   :
                		case 'char'     :
                		case 'varchar'  : $input_txt = '<input class="form-control input-sm" name="'.$key[$i].'" id='.$key[$i].' type="text" value="'.$frm[$key[$i]].'" placeholder="'.@$placehoder.'" >'; break;
                		case strstr($key_type[$i], 'enum') : 
                			
                			$key_type[$i]   = str_replace('enum', '', $key_type[$i]);
                			$key_type[$i]   = str_replace('\'', '', $key_type[$i]);
                			$enum           = explode(',', $key_type[$i]);
                			
                			 $input_txt = '<select class="form-control input-sm" name="'.$key[$i].'" id="'.$key[$i].'">';
                			for( $enumindex=0;  $enumindex<count($enum);  $enumindex++ ){
                				if($enum[$enumindex]!=""){
                					$selected           = getNamecharsetRS(@$frm[$key[$i]])==$enum[$enumindex] ? ' selected="selected" ' : '' ;
                					 $input_txt .= '<option value="'.$enum[$enumindex].'" '.$selected.'>'.$enum[$enumindex].'</option>';
                				}
                			}
                			 $input_txt .= '</select>';
                			break;
                		 case 'date'	 : $input_txt = '<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="th" data-date-autoclose="true" ><input    class="form-control input-sm" name="'.$key[$i].'" id='.$key[$i].' type="text" value="'.ChangeEN2TH($frm[$key[$i]]).'" placeholder="'.@$placehoder.'" > <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div></div>'; break;
                			
                		default         : $input_txt = '<input class="form-control input-sm" name="'.$key[$i].'" id='.$key[$i].' type="text" value="'.$frm[$key[$i]].'" placeholder="'.@$placehoder.'" >'; break;
                	}
                	
                	?>

                	<tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" ><?=lang($key[$i], ($key[$i]))?></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <?=@$input_txt?>   
	                        </div>
	                      </div>
                      </td> 
                    </tr>
             <? } ?>
 				
                    
                    <tr>
                         <td colspan="2" style="height: 70px;vertical-align: bottom;">
                          <div class="form-group">
	                        <label class="col-sm-2">&nbsp;</label>
	                        <div class="col-sm-10 col-md-8 pad_3" style="max-width:750px;">
	                        	<button class="btn btn-block btn-success btn-sm pull-left btnFrmSubmit" type="submit" id="Save" name="Save"><i class="fa fa-floppy-o"></i> <?=lang('Save','Save')?></button>
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

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
                      <td colspan="2">
	                      <div class="form-group" id="subject">
	                        <label class="col-sm-2 right_b" >Keyword<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <input type="text" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล" id="keyword" name="keyword"  value="<?=@$frm["keyword"]?>"  <?=(getParam("2")=="edit") ? 'readonly="readonly"' : ' onfocusout="check_keyword(this.value);" ';?>  >
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >คำภาษาไทย<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                            <textarea  name="th_lang" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล"><?=@$frm["th_lang"]?></textarea>
	                         
	                        </div>
	                      </div>
                      </td> 
                    </tr>
                    
                    <tr>
                      <td colspan="2">
	                      <div class="form-group">
	                        <label class="col-sm-2 right_b" >คำภาษาอังกฤษ<font class="req">*</font></label> 
	                        <div class="col-sm-8 col-md-4 pad_3">
	                             <textarea  name="en_lang" class="form-control input-sm" placeholder="กรุณากรอกข้อมูล"><?=@$frm["en_lang"]?></textarea>
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
	function check_keyword(val){

		var url = "<?=base_url()?><?=getParam('1')?>"+"/keyword_exits";
		
		if(val){
				$.post(url,{key: val},function(data) { 
		
					if(data!="0"){
						$("#keyword").val("");
					}
		
					
					//console.log(data);
				});
			}

}
</script>

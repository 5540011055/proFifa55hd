<div class="row">
	<div class="col-xs-12">
		<div class="box">
		
			<!-- /.box-header -->
			<div class="panel panel-grey font13" >
                  
                    <div class="panel-body">
                          
                          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-3" style="float: right;padding-right: 0px; padding-left: 0px;">    
	                       <form name="frm-search" method="post">   
	                        <span class="input-group input-group-sm" style="vertical-align:middle;float: right;">
		                  		<input type="text" name="search" id="search" class="form-control" value="<?=request('search')?>" placeholder="<?=@$placeholder?>">
	                  			  <span class="input-group-btn">
	                  			  <?php if(@request('search')){ ?>
	                      			<button class="btn btn-warning  btn-flat" type="button" onclick="window.location.href='<?=base_url().getParam("1");?>'" ><i class="fa fa-times-circle"></i> <b>ล้างคำค้น</b></button>
	                      		<?php }else{ ?>	
	                      		     <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-search"></i> <b>ค้นหา</b></button>
	                      		<?php } ?>
	                    		  </span>
	                 		 </span>
	                      </form>
	                      </div>
	                  
                        <form name="Adminform" id="Adminform" action="<?=base_url().getParam(1).'/'.getParam(2)?>" method="GET" width="100%">
            				<input type="hidden" name="page" id="page" value="<?=request('page')?>">
            					<?=$gridTable?>   
       					 </form>
             
          <div class="text-right" style="margin-top: -25px;">
                <?=$paginator?>
           </div>
                   
                    </div>     
                   <!-- /.panel-body -->              
         </div>
         <!-- /.box-body -->
			
		</div>
		<!-- /.box -->
	</div>
</div>


<script>
function changedRecommended(id, value){
	var res = (value) ? 1 : 0 ;

	  $.post( '<?=base_url().getParam('1')?>/updateRecommend/?id='+id+'&val='+res,
            function(data){

        console.log(data);

		     startAjax();
            });
      }	
</script>




            
           
            
            


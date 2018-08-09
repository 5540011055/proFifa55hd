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
	           			 </tbody>
	           			</table>        			 

<div id="control-sidebar-theme-demo-options-tab" class="tab-pane active" data-original-title="" title="">
		<ul class="list-unstyled clearfix">
			
			<div style="color: #3c763d !important;background-color: #dff0d8;border-color: #d6e9c6; display: none;" class="alert" role="alert" id="alertsuccess"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Update Successfull! </strong> This skin website has been updated. </div>
			
			<li style="float: left; width: 33.33333%; padding: 10px;">
				<a href="javascript:void(0);" onclick="set_skin('skin-blue');" data-skin="skin-blue" style="display: block;box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"  class="clearfix full-opacity-hover" data-original-title="" title="">
					<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 7px; background: #367fa9;" data-original-title="" title=""></span>
						<span class="bg-light-blue" style="display: block; width: 80%; float: left; height: 7px;" data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 20px; background: #222d32;" data-original-title="" title=""></span>
						<span style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;" data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc">Blue Skin</p></a>
			</li>
			
			<li style="float: left; width: 33.33333%; padding: 10px;">
				<a href="javascript:void(0);"  onclick="set_skin('skin-teal');" data-skin="skin-teal" style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)" class="clearfix full-opacity-hover" data-original-title="" title="">
				<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 7px;" class="bg-teal-active" data-original-title="" title=""></span>
						<span class="bg-teal" style="display: block; width: 80%; float: left; height: 7px;" data-original-title="" title=""></span>
				</div>
				<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 20px; background: #222d32;" data-original-title="" title=""></span>
						<span style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;" data-original-title="" title=""></span>
				</div>
				
			<p class="text-center no-margin skins-desc">Teal Skin</p></a>
			</li>
			
			<li style="float: left; width: 33.33333%; padding: 10px;">
				<a href="javascript:void(0);" onclick="set_skin('skin-purple');" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)" class="clearfix full-opacity-hover" data-original-title="" title="">
					<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 7px;" class="bg-purple-active" data-original-title="" title=""></span>
						<span class="bg-purple" style="display: block; width: 80%; float: left; height: 7px;" data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 20px; background: #222d32;" data-original-title="" title=""></span>
						<span style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;" data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc">Purple Skin</p></a>
			</li>
			
			
			
			
			<li style="float: left; width: 33.33333%; padding: 10px;">
				<a href="javascript:void(0);" onclick="set_skin('skin-green');"  data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)" class="clearfix full-opacity-hover" data-original-title="" title="">
					<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 7px;" class="bg-green-active" data-original-title="" title=""></span>
						<span class="bg-green" style="display: block; width: 80%; float: left; height: 7px;" data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 20px; background: #222d32;" data-original-title="" title=""></span>
						<span style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;" data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc">Green Skin</p></a>
			</li>
			
			
			
			<li style="float: left; width: 33.33333%; padding: 10px;">
				<a href="javascript:void(0);" onclick="set_skin('skin-lime');" data-skin="skin-lime" style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)" class="clearfix full-opacity-hover" data-original-title="" title="">
					<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 7px;" class="bg-lime-active" data-original-title="" title=""></span>
						<span class="bg-lime" style="display: block; width: 80%; float: left; height: 7px;" data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 20px; background: #222d32;" data-original-title="" title=""></span>
						<span style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;" data-original-title="" title=""></span>
					</div>	
			<p class="text-center no-margin skins-desc">Lime Skin</p></a>
		 </li>
			
			<li style="float: left; width: 33.33333%; padding: 10px;">
			   <a href="javascript:void(0);" onclick="set_skin('skin-black');" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)" class="clearfix full-opacity-hover" data-original-title="" title="">
			   		<div style="box-shadow: 0 0 2px rgba(0, 0, 0, 0.1)" class="clearfix" data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 7px; background: #fefefe;" data-original-title="" title=""></span>
						<span style="display: block; width: 80%; float: left; height: 7px; background: #fefefe;" data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span style="display: block; width: 20%; float: left; height: 20px; background: #222;"    data-original-title="" title=""></span>
						<span style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;" data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc">Black Skin</p></a>
			</li>
			
			<li style="float: left; width: 33.33333%; padding: 10px;"><a
				href="javascript:void(0);" onclick="set_skin('skin-red');"  data-skin="skin-red"
				style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"
				class="clearfix full-opacity-hover" data-original-title="" title=""><div
						data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 7px;"
							class="bg-red-active" data-original-title="" title=""></span><span
							class="bg-red"
							style="display: block; width: 80%; float: left; height: 7px;"
							data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 20px; background: #222d32;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;"
							data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc">Red Skin</p></a>
			</li>
			
			<li style="float: left; width: 33.33333%; padding: 10px;"><a
				href="javascript:void(0);" onclick="set_skin('skin-fuchsia');"  data-skin="skin-fuchsia"
				style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"
				class="clearfix full-opacity-hover" data-original-title="" title=""><div
						data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 7px;"
							class="bg-fuchsia-active" data-original-title="" title=""></span><span
							class="bg-fuchsia"
							style="display: block; width: 80%; float: left; height: 7px;"
							data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 20px; background: #222d32;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;"
							data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc">Pink Skin</p></a>
			</li>
			
			<li style="float: left; width: 33.33333%; padding: 10px;"><a
				href="javascript:void(0);" onclick="set_skin('skin-yellow');"  data-skin="skin-yellow"
				style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"
				class="clearfix full-opacity-hover" data-original-title="" title=""><div
						data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 7px;"
							class="bg-yellow-active" data-original-title="" title=""></span><span
							class="bg-yellow"
							style="display: block; width: 80%; float: left; height: 7px;"
							data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 20px; background: #222d32;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;"
							data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc">Orange Skin</p></a>
			</li>
			
			
			
			
			<li style="float: left; width: 33.33333%; padding: 10px;"><a
				href="javascript:void(0);" onclick="set_skin('skin-blue-light');"   data-skin="skin-blue-light"
				style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"
				class="clearfix full-opacity-hover" data-original-title="" title=""><div
						data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 7px; background: #367fa9;"
							data-original-title="" title=""></span><span
							class="bg-light-blue"
							style="display: block; width: 80%; float: left; height: 7px;"
							data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 20px; background: #f9fafc;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;"
							data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc" style="font-size: 12px">Blue Light</p></a>
			</li>
			
			<li style="float: left; width: 33.33333%; padding: 10px;"><a
				href="javascript:void(0);" onclick="set_skin('skin-purple-light');"  data-skin="skin-purple-light"
				style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"
				class="clearfix full-opacity-hover" data-original-title="" title=""><div
						data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 7px;"
							class="bg-purple-active" data-original-title="" title=""></span><span
							class="bg-purple"
							style="display: block; width: 80%; float: left; height: 7px;"
							data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 20px; background: #f9fafc;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;"
							data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc" style="font-size: 12px">Purple Light</p></a></li>
			<li style="float: left; width: 33.33333%; padding: 10px;"><a
				href="javascript:void(0);" onclick="set_skin('skin-black-light');" data-skin="skin-black-light"
				style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"
				class="clearfix full-opacity-hover" data-original-title="" title=""><div
						style="box-shadow: 0 0 2px rgba(0, 0, 0, 0.1)" class="clearfix"
						data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 7px; background: #fefefe;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 7px; background: #fefefe;"
							data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 20px; background: #f9fafc;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;"
							data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc" style="font-size: 12px">Black Light</p></a></li>
			
			
			
			<li style="float: left; width: 33.33333%; padding: 10px;"><a
				href="javascript:void(0);" onclick="set_skin('skin-green-light');"  data-skin="skin-green-light"
				style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"
				class="clearfix full-opacity-hover" data-original-title="" title=""><div
						data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 7px;"
							class="bg-green-active" data-original-title="" title=""></span><span
							class="bg-green"
							style="display: block; width: 80%; float: left; height: 7px;"
							data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 20px; background: #f9fafc;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;"
							data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin  skins-desc" style="font-size: 12px">Green Light</p></a></li>
			<li style="float: left; width: 33.33333%; padding: 10px;"><a
				href="javascript:void(0);" onclick="set_skin('skin-red-light');"   data-skin="skin-red-light"
				style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"
				class="clearfix full-opacity-hover" data-original-title="" title=""><div
						data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 7px;"
							class="bg-red-active" data-original-title="" title=""></span><span
							class="bg-red"
							style="display: block; width: 80%; float: left; height: 7px;"
							data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 20px; background: #f9fafc;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;"
							data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc" style="font-size: 12px">Red Light</p></a></li>
			<li style="float: left; width: 33.33333%; padding: 10px;"><a
				href="javascript:void(0);"  onclick="set_skin('skin-yellow-light');"  data-skin="skin-yellow-light"
				style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)"
				class="clearfix full-opacity-hover" data-original-title="" title=""><div
						data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 7px;"
							class="bg-yellow-active" data-original-title="" title=""></span><span
							class="bg-yellow"
							style="display: block; width: 80%; float: left; height: 7px;"
							data-original-title="" title=""></span>
					</div>
					<div data-original-title="" title="">
						<span
							style="display: block; width: 20%; float: left; height: 20px; background: #f9fafc;"
							data-original-title="" title=""></span><span
							style="display: block; width: 80%; float: left; height: 20px; background: #f4f5f7;"
							data-original-title="" title=""></span>
					</div>
			<p class="text-center no-margin skins-desc" style="font-size: 12px;">Orange Light</p></a></li>
		</ul>
</div>           	
                   </form>     
                   
                   <p> &nbsp; </p>
                   <p> &nbsp; </p>
                      <!-- Table -->

                   
                   
                    </div>     
                   <!-- /.panel-body -->              
         </div>
         <!-- /.box-body -->
			
		</div>
		<!-- /.box -->
	</div>
</div>

<script type="text/javascript">
	function set_skin(skin){

		var urls = '<?=base_url().getParam('1')."/setTheme"?>';
		var ids  = '<?=$frm["id"]?>';

		$.post(urls , { skin_sel : skin, id_sel: ids }).done(function( data ) {
			// $("#alertsuccess").fadeIn().delay(1500).fadeOut();
		});
	}
</script>

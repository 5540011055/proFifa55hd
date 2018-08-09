<div class="outter-wrapper body-wrapper regist-theme">		
		<div class="wrapper ad-pad-first clearfix regist-theme" >
			
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">	
					<header><?=$this->lang->line('how2register');?></header>
					
					
					<div class="register-step-item wow zoomIn" data-wow-delay="0.2s">
						<div class="pull-left">
							<span class="register-step-item-bullet register-step-item-bullet1"></span>
						</div>
						<div class="register-msg pull-left">

							<h4 class="register-step-title"><?=$this->lang->line("register")?></h4>
							<p class="clear-pad"><?=$this->lang->line("home-guide-regist-1")?></p>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="register-step-item wow zoomIn" data-wow-delay="0.4s">
						<div class="pull-left">
							<span class="register-step-item-bullet register-step-item-bullet2"></span>
						</div>
						<div class="register-msg pull-left">

							<h4 class="register-step-title"><?=$this->lang->line("tranfer")?></h4>
							<p class="clear-pad"><?=$this->lang->line("home-guide-regist-2")?></p>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="register-step-item pad-bottom wow zoomIn" data-wow-delay="0.6s">
						<div class="pull-left">
							<span class="register-step-item-bullet register-step-item-bullet3"></span>
						</div>
						<div class="register-msg pull-left">

							<h4 class="register-step-title"><?=$this->lang->line("getuser")?></h4>
							<p class="clear-pad"><?=$this->lang->line("home-guide-regist-3")?></p>
						</div>
						<div class="clearfix"></div>
					</div>
			</div>
			
			<div class="col-xs-12  col-sm-12 col-md-4 col-lg-4" >
					<header id="register-home"><?=$this->lang->line('register');?></header>
					
					<p class="lead wow fadeIn" data-wow-delay="1s" data-wow-duration="2s"  style="text-align: left;"><?=$this->lang->line("txt-for-webregist");?></p> 
					
					<div class="message error" id="alerts-error-regist">
	    			<em class="fa"></em> <span id="txt-error-regist"></span>		
		    	    </div>
		    	    
		    	    <div class="message success" id="alerts-success-regist">
		    			<em class="fa"></em> <span id="txt-success-regist"></span>
		    			<em type="button" class="close" id="close-regist"><span aria-hidden="true">&times;</span></em>
		    		</div>
					
						<!-- Start Form -->
		        	<form id="register_form" method="post" name="entryform"   >
		        		<table class="tableless">
		        			<tbody>
		        				<tr><td><input type="text" id="regist_name"  name="regist_name"  placeholder="<?=$this->lang->line("txt-name");?>"   autocomplete="off" ></td></tr>
			        			<tr><td><input type="text" id="regist_phone" name="regist_phone" placeholder="<?=$this->lang->line("txt-phone");?>"  autocomplete="off" onfocusout="code_exits(this.value);" ></td></tr>
			        			<tr><td><input type="text" id="regist_line"  name="regist_line"  placeholder="<?=$this->lang->line("lineid");?>"     autocomplete="off" ></td></tr>
		        			</tbody>
		        	 </table>
		        		
		        		<button class="btn-2 wow flash" data-wow-delay="2s"    id="confirm-regist" type="submit"> <i class="fa fa-check-square-o regist-btn" aria-hidden="true"></i> <?=$this->lang->line("confirm-regist"); ?></button>
		     
			        		<div class="ajax-wait-contact ajax-register">
					        	<span><img  src="images/ajax-loader.gif" width="40"></span>
								<span><?=$this->lang->line("pleasewait");?></span>
						   </div>
		        		
		        	</form>
		
			</div>
			
			
		</div>
</div>
	
	
	
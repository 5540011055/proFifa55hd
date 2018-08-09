<div class="body-main-sub-in ">

<h1 class="h-text-contact-sub">
<span class="fa-stack fa-lg font-28">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-user fa-stack-1x fa-inverse"></i>
</span>

 <?=$this->lang->line("registerbyweb");?></h1>

       	
	        	<p class="p-register"> <?=$this->lang->line("txt-for-webregist2");?> </p>
	        	
	        	<div class="message error" id="alerts-error-regist">
	    			<em class="fa"></em> <span id="txt-error-regist"></span>		
	    	    </div>
	    	    
	    	    <div class="message success" id="alerts-success-regist">
	    			<em class="fa"></em> <span id="txt-success-regist"></span>
	    			<em type="button" class="close" id="close-regist"><span aria-hidden="true">&times;</span></em>
	    		</div>
	        	
	        	<!-- Start Form -->
	        	<form id="register_form" method="post" name="entryform"  >
	        		<table class="tableless">
	        			<tbody>
	        				<tr><td><input type="text" id="regist_name"  name="regist_name"  placeholder="<?=$this->lang->line("txt-name");?>"   autocomplete="off" ></td></tr>
		        			<tr><td><input type="text" id="regist_phone" name="regist_phone" placeholder="<?=$this->lang->line("txt-phone");?>"  autocomplete="off" onfocusout="code_exits(this.value);" ></td></tr>
		        			<tr><td><input type="text" id="regist_line"  name="regist_line"  placeholder="<?=$this->lang->line("lineid");?>"     autocomplete="off" ></td></tr>
	        			</tbody>
	        	 </table>
	        		
	        		<button class="btn-2"   id="confirm-regist" type="submit"> <i class="fa fa-check-square-o regist-btn" aria-hidden="true"></i> <?=$this->lang->line("confirm-regist"); ?></button>
	        		
		        		<div class="ajax-wait-regist" style="display: none;">
				        	<span><img  src="images/hourglass.gif" width="40"></span>
							<span><b><?=$this->lang->line("pleasewait");?></b></span>
					   </div>
	        		
	        	</form>
	        	
	        	<!-- 
	        	<div class="map-contact">
				<hr>
					<img alt="" src="images/to-regist.jpg">	
				</div> -->
	

</div>





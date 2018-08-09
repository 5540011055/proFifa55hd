<div class="widget">
				
			   
			   <div class="widget-ads-r wow bounceIn" data-wow-delay="1s" style="text-align: -webkit-center;">
			   		<img src="images/subpage/ads-right.png" class="img-responsive" >
			   </div> 
			   
			   <h1 class="h-text-contact contact-sub-left  wow zoomIn"><?=$this->lang->line("contactus");?></h1>
			    <ul class="widget-list contact-list">
			    	
			    	<?php if(getGeneralConfig("company_callcenter")!=""){ ?>
			    		<li  class="wow zoomInRight" data-wow-delay="0.2s"><img src="<?=base_url()?>images/contact/svg/mobile-phone.svg" style="width: 40px;" /> <span class="contact-list-style" ><?=getGeneralConfig("company_callcenter");?></span></li>
			    	<?php } ?>
			    	<li  class="wow zoomInRight" data-wow-delay="0.4s" onclick="window.open('https://line.me/ti/p/<?=getGeneralConfig("company_line");?>', '_blank')"><img src="<?=base_url()?>images/contact/svg/line.svg"  style="width: 40px;" /> 		<span class="contact-list-style"><?=getGeneralConfig("company_line");?></span></li>
			    	<li  class="wow zoomInRight" data-wow-delay="0.6s" onclick="window.open('<?=getGeneralConfig("company_facebook_link");?>', '_blank')" ><img src="<?=base_url()?>images/contact/svg/facebook.svg"  style="width: 40px;" /> 	<span class="contact-list-style"><?=getGeneralConfig("company_facebook");?></span></li>
			    	<li  class="wow zoomInRight" data-wow-delay="0.8s"><img src="<?=base_url()?>images/contact/svg/email.svg"   style="width: 40px;" /> 		<span class="contact-list-style"><?=getGeneralConfig("company_email");?></span></li>
			    	<li  class="wow zoomInRight" data-wow-delay="1s"><img src="<?=base_url()?>images/contact/svg/internet.svg"   style="width: 40px;" /> 	<span class="contact-list-style"><?=getConfig("domain");?></span></li>
			    	
			    </ul>
			   
</div>	 

<div>
	
</div>  
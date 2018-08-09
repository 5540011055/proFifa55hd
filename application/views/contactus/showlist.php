<div class="body-main-sub-in ">

<h1 class="h-text-contact-sub"><i class="fa fa-envelope icon-contact"></i> <?=$this->lang->line('contact-head-form');?></h1>

       	
	        	<p class="p-contact"> <?=$this->lang->line('contact-des-form');?> </p>
	        	
	        	<div class="message error" id="alerts-error-contact">
	    			<em class="fa"></em> <span id="txt-error-contact"></span>		
	    	    </div>
	    	    
	    	    <div class="message success" id="alerts-success-contact">
	    			<em class="fa"></em> <span id="txt-success-contact"></span>
	    			<em type="button" class="close" id="close-contact"><span aria-hidden="true">&times;</span></em>
	    		</div>
	<form id="contact_form" method="post" name="entryform">
		<table class="tableless2">
			<tbody>
				<tr>
					<td>
						<input type="text" id="contact_name" name="contact_name" placeholder="<?=$this->lang->line("txt-conatct-name");?>" autocomplete="off"></td>
				</tr>
				<tr>
					<td>
						<input type="text" id="contact_phone" name="contact_phone" placeholder="<?=$this->lang->line("txt-phone");?>" autocomplete="off">
					</td>
				</tr>
				<tr>
					<td>
						<textarea id="contact_detail" name="contact_detail" placeholder="<?=$this->lang->line("txt-detail");?>"></textarea>
					</td>
				</tr>
			</tbody>
		</table>


		<button class="btn-2" id="confirm-contact" type="submit">
			<i class="fa fa-check-square-o regist-btn" aria-hidden="true"></i> <?=$this->lang->line("confirm-contact"); ?></button>

		<div class="ajax-wait-contact">
			<span><img alt="" src="images/ajax-loader.gif" width="40"></span> <span><b><?=$this->lang->line("pleasewait");?></b></span>
		</div>
	</form>
	

</div>





<div class="outter-wrapper body-wrapper">		
		<div class="wrapper ad-pad-first clearfix" >
			
			<div class="col-xs-12">
					<div class="simple-column">
					
					<?php 
						$db = getDBO();
						
						$db->setQuery("SELECT subject,description FROM aboutus_information WHERE status = '1' AND cid = '1' ORDER BY id DESC LIMIT 1");
						$rs = $db->loadAssocList();
						$rs = $rs[0];

					?>
						
						<div class="heading heading-12">
							<p ><?=$this->lang->line('aboutus-en');?></p>
							<h1 class="wow zoomInUp"><span class="left"></span><?=@$rs["subject"];?><span class="right"></span></h1>
							
							<div class="wow fadeIn descript-about" data-wow-delay="1.2s" data-wow-duration="1s">
								<?=$rs["description"];?>
							</div>

						</div>
					</div>
			</div>
			
		</div>
</div>





	
	
	
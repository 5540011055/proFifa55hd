 <div class="outter-wrapper divider-pro"></div> 
<div class="outter-wrapper centered paralax-block with-draw" style="background: url('images/withdraw/wd16.jpg');  background-position: 0px -28.75px" data-stellar-background-ratio="0.75">		
		<div class="wrapper section-withdraw clearfix">
		<div class="col-md-6">
			<header class="wow zoomIn"><?=$this->lang->line("wihtdraw");?></header>
			<p class="wow zoomIn"><?=$this->lang->line("withdraw-head");?></p>

			<ul class="withdraw">
				
				<?php 
				
					$db = getDBO();
					
					$db->setQuery("SELECT id,subject FROM withdraw_information WHERE status = '1' AND cid = '1' ORDER BY id ASC");
					$rs= $db->loadAssocList();
					
					$time_sec_wd = 0;
				
				    for($i=0;$i<count($rs);$i++){
				    	$time_sec_wd = $time_sec_wd + 0.2;
				?>				
				<li class="wow bounceInLeft" data-wow-delay="<?=$time_sec_wd?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr2" aria-hidden="true"></i> <?=$rs[$i]["subject"];?> 
				</li>
				<?php  } ?>
			</ul>
		
		</div>

		<div class="col-md-6 last bank-list">
			<ul class="bank-symbol">
				<li class="wow flipInX" data-wow-delay="0.5s"><img class="img-responsive" src="images/bank/scb.png"></li>
				<li class="wow flipInX" data-wow-delay="1s"><img class="img-responsive" src="images/bank/ktb.png"></li>
				<li class="wow flipInX" data-wow-delay="1.5s"><img class="img-responsive" src="images/bank/bb.png"></li>
				<li class="wow flipInX" data-wow-delay="2s"><img class="img-responsive" src="images/bank/kk.png"></li>
			</ul>
				
		</div>
		
		</div>
	</div>
<div class="outter-wrapper divider-pro"></div> 


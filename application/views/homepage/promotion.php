<div class="outter-wrapper body-wrapper promotion-theme">
	<div class="wrapper section-promotion clearfix">

		<div class="col-md-6">
			 <img src="<?//=base_url()?>images/promotion/promote.png" class="img-responsive wow tada" data-wow-offset="50" data-wow-delay="1.5s"> 

		</div>

		<div class="col-md-6 last">
			<header><?=$this->lang->line("promotion");?></header>
			<p><?=$this->lang->line("promotion-head");?></p>

			<ul class="promotion">
				
				<?php 
					
					$db = getDBO();
					
//					$db->setQuery("SELECT id,subject FROM promotion_information WHERE status = '1' ORDER BY recommend = '1' DESC,id DESC LIMIT 6");
					$db->setQuery("SELECT id,subject FROM promotion_information WHERE status = '1' ORDER BY id DESC LIMIT 6");
					$rs= $db->loadAssocList();
				
					$time_sec = 0;
				
				    for($i=0;$i<count($rs);$i++){
				    	$time_sec = $time_sec + 0.2;
				?>				
				<li class="wow bounceInRight" data-wow-delay="<?=$time_sec?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr" aria-hidden="true"></i> <?=$rs[$i]["subject"];?> 
				</li>
				<?php  } ?>
			</ul>
			
			<hr class="hr-pro">
			
			<a href="<?=base_url()?>promotion/index/<?=$this->lang->line("promotion");?>" class="btn btn-danger btn-lg pull-right Parent slideInUp animated" data-animate-offset="50" role="button" id="more-promotion"> <i class="fa fa-plus-circle promo-btn" aria-hidden="true"></i> <?=$this->lang->line("promotion-more");?></a>
			
		</div>

	</div>
</div>








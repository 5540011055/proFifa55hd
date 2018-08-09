<link href="<?=base_url()?>style/style-main.css" rel="stylesheet" type="text/css" />

<div class="outter-wrapper body-wrapper">
	<div class="wrapper clearfix" style="padding-bottom: 0;">
		<div class="col-1-1">
			<div class="simple-column">
				<div class="heading heading-13">
					<p><?=$this->lang->line('contactus-en');?></p>
					<h2 class="wow zoomInUp"><?=$this->lang->line('contact-head');?></h2>
					<br>
				</div>
			</div>


		</div>
	</div>
	<section class="footer-contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				
				<?php if(getGeneralConfig("company_callcenter")!=""){ ?>
					<div class="tel-phone wow pulse" data-wow-delay="1s">
                   		<?=getGeneralConfig("company_callcenter");?><br>
					</div>
				<?php } ?>

					<div class="line-fb-container">

						<div class="line-fb-inner2">
							<div class="line2 wow zoomIn" data-wow-delay="1.4s">
								<div class="con1">
									<img src="img/line-icon.png" alt="">
								</div>
								<div class="content-box">
									<a target="_blank" href="https://line.me/ti/p/<?=getGeneralConfig("company_line");?>"><?=getGeneralConfig("company_line");?></a>
								</div>
							</div>
							<div class="facebook2 wow zoomIn"  data-wow-delay="1.8s">
								<div class="con1">
									<img src="img/fb-icon.png" alt="">
								</div>
								 <a target="_blank" href="<?=getGeneralConfig("company_facebook_link");?>"><?=getGeneralConfig("company_facebook");?></a>
							</div>
							<div class="clearfix"></div>
						</div>

					</div>


				</div>
			</div>

		</div>
	</section>
</div>





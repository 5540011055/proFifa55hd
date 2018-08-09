<div class="outter-wrapper body-wrapper wrapper-feature">
	<div class="wrapper ad-pad-first clearfix">

		<div class="col-xs-12">
			<div class="simple-column">
					
					<?php
					$db = getDBO ();
					
					$db->setQuery ( "SELECT subject,description FROM feature_information WHERE status = '1' AND cid = '1' ORDER BY id DESC" );
					$rs = $db->loadAssocList ();
					?>
						
				<div class="heading heading-12 feature-des">

					<h1 class="wow zoomInUp"><?=$this->lang->line('feature-txt');?></h1>

					<div class="descript-about">

						
						
						<div class="row" id="sec4">
							<!-- rows -->
						
						<?php 
							$time_sec = 0;
						
							for($i=0;$i<count($rs);$i++){
								
								$time_sec = $time_sec + 0.3;
							
								?>
							
							<div class="col-md-4">
								<div class="media wow flipInX" data-wow-delay="<?=$time_sec?>s">
									<div class="media-left">
										<i class="fa fa-futbol-o fa-4x"></i>
									</div>
									<div class="media-body">
										<h4 class="media-heading"><?=$rs[$i]["subject"]?></h4>
										<?=strip_tags($rs[$i]["description"]);?>
									</div>
								</div>
								<!--media-->
							</div>
							
							<?php } ?>

						
							
							
							
						</div>

					</div>
					
				<!-- rows -->
				</div>
				<div class="row" style="text-align:center;" >
					<h2 style="font-size:18px !important;padding:0;margin:0 auto;display:inline-block;">แทงบอลที่ไหนดี</h2>
					<h2 style="font-size:18px !important;padding:0;margin:0 auto;display:inline-block;">แนะนำเว็บแทงบอล</h2>
							
				</div>
			</div>
		</div>

	</div>
</div>








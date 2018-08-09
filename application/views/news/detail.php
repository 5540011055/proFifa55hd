
<style>
 
 
</style>


<div class="detail-news">
		<div class="row">
			<div class="topic"><?=$rs["subject"] ?></div>
			<div class="share">
				
					<span class="col-sm-12 col-md-6 detail-date"><i class="fa fa-calendar"></i> <?=($_ENV['lang_type']=='th') ? shortThDate($rs['create_date']) : shortEnDate($rs['create_date'])?> <i class="fa fa-eye" style="margin-left: 10px;"></i> <?=number_format($rs["hits"]);?> <?=$this->lang->line("views");?></span>
					<span  class="col-sm-12 col-md-6 last detail-social">
						<span class='st_facebook_hcount' displayText='Facebook'></span>
						<span class='st_twitterfollow_hcount' displayText='Twitter Follow' st_username='Follow'></span>
						<span class='st_pinterest_hcount' displayText='Pinterest'></span>
						<span class='st_plusone_hcount' displayText='Google +1'></span>					
						<script type="text/javascript" src="<?=base_url()?>plugins/share/buttons.js"></script>
						<script type="text/javascript">stLight.options({publisher: "362b973c-5230-47b6-979e-f4bb89861751", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
					</span>
				
			</div>
			<div class="detail-block">
			   <!-- <span><h3>Head</h3></span><br />  -->
				<br /><?=$rs["description"]?>
			</div>


			<?php if(@$all_images){?>
				<div class="pic-block">
					<?php 
						for($i=0;$i<count($all_images);$i++){
							
							$class_img = ($i==0) ? 'img-content-first' : 'img-content';
							
							echo '<img src="'.$all_images[$i]["filepath"].'" class="'.@$class_img.'" />';
						}
					?>
				</div>
				
			<?php } ?>
			
			
			<?php if(@$all_files){?>
				<div class="detail-attachment">
					<div class="detail-attachment-top"><?=$this->lang->line("detail-attact");?></div>
					<div class="detail-attachment-mid">
						<ul>
						  <?php 
						  for($i=0;$i<count($all_files);$i++){
								$downloadPath	= base_url().getParam(1)."/download/?id={$all_files[$i]['id']}&file={$all_files[$i]['filepath']}&name={$all_files[$i]['filename']}";
								$icon_file		= '<img src="'.getExtImage(@$all_files[$i]['extension'] ? $all_files[$i]['extension']:'file').'" style="vertical-align:middle" border="0" width="26">';
						  ?>

							<li><a href="<?=$downloadPath?>" target="_blank" download><?=@$icon_file?> <?=$all_files[$i]['filename']?></a></li>
							
						<?php } ?>
						</ul>
					</div>
				</div>
			<?php } ?>
			
			<div class="comment-block">
				<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.7&appId=472027116183953";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-comments" data-href="<?=Site::$webMain;?><?=getParam("1")?>/<?=getParam("2")?>/<?=getParam("3")?>" data-width="650" data-order-by="reverse_time"></div>
					
			</div>
			
			
		<a href="<?=base_url()?>news/index/<?=$this->lang->line("hili-news");?>">
			<button class="btn-2" id="confirm-contact" type="submit"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?=$this->lang->line('news-other');?></button>
		</a>		
			
		</div>
	</div>



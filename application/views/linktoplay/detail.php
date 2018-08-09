<div class="col9">
	<div class="detail">
		<div class="row">
			<div class="topic"><?=($_ENV['lang_type']=='th') ? $rs["subject"] : $rs["subject_en"]?></div>
			<div class="share">
				<span class="col6 detail-date"><i class="fa fa-calendar"></i> <?=($_ENV['lang_type']=='th') ? shortThDate($rs['create_date']) : shortEnDate($rs['create_date'])?> <i class="fa fa-eye" style="margin-left: 10px;"></i> <?=number_format($rs["hits"]);?> <?=$this->lang->line("views");?></span>
				<span class="col6 last detail-social">
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
				<br /><?=($_ENV['lang_type']=='th') ? $rs["description"] : $rs["description_en"]?>
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
			<!-- 
			<div class="vdo-block">
				<iframe width="560" height="315"
					src="https://www.youtube.com/embed/ZOKeLxh3rh0?list=UUwMAbNsfCXN57DB7QKqqLWg"
					frameborder="0" allowfullscreen></iframe>
			</div>
			 -->
			<div class="comment-block">
				<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/<?=($_ENV['lang_type']=='th') ? 'th_TH' : 'en_EN';?>/sdk.js#xfbml=1&version=v2.7&appId=472027116183953";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-comments" data-href="<?=Site::$webMain;?><?=getParam("1")?>/<?=getParam("2")?>/<?=getParam("3")?>" data-width="650" data-order-by="reverse_time"></div>
					
			</div>
			
			
		</div>
	</div>
</div>

<div class="col3 last">
	<div class="other">
		<div class="other-top">
			<span class="col3">
				<img src="images/sub/other.png" width="45" height="43" />
				
			</span> <span class="col9 last"><?=$this->lang->line("other_treatment");?></span>
		</div>
		<div class="other-mid">
			<ul>
				
				<?php  for($i=0;$i<count($otherRs);$i++){
					
					$link = base_url().getParam("1")."/detail/".$otherRs[$i]["id"];
					
					@$subject 		= ($_ENV['lang_type']=='th') ? $otherRs[$i]["subject"] : $otherRs[$i]["subject_en"];
					@$title   		= ($_ENV['lang_type']=='th') ? $otherRs[$i]["title"]   : $otherRs[$i]["title_en"];
				
					$display_image  = ($otherRs[$i]["display_image"]) ? $otherRs[$i]["display_image"] : "images/default.jpg" ;
					
					$style_class = ($otherRs[$i]["recommend"]) ? 'special' : 'new';
					$recomed_new = ($otherRs[$i]["recommend"]) ? getRecomendImg($otherRs[$i]["recommend"]) : getNewImg($otherRs[$i]["create_date"],Site::$newIcon);
					?>
				<li>
					<span class="o-pic">
						<a href="<?=$link?>"><img src="<?=$display_image?>" width="226" height="127" /></a>
							<div class="<?=@$style_class?>"><?=@$recomed_new;?></div>
					</span>
					<span class="o-text">
							<div class="o-topic">
								<a href="<?=$link?>"><?=$subject?></a>
							</div>
							<div class="o-detail"><?=@$title?></div>
					</span>
				</li>
				
				<?php } ?>
			</ul>
		</div>
		<div class="other-bottom">
			<div class="more">
				<a href="<?=base_url().getParam('1');?>"><?=$this->lang->line("view_all");?></a>
			</div>
		</div>
	</div>
	
</div>

<link href="<?=base_url()?>style/detail.css" rel="stylesheet" type="text/css" />
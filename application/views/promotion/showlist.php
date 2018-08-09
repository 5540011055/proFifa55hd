<div class="promotion-sub-head">
<span class="fa-stack fa-lg font-28">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-trophy fa-stack-1x fa-inverse"></i>
</span>
<?=$this->lang->line("928-pro");?></div>

<?php 

	for($i=0,$j=1;$i<count($rs);$i++,$j++){ 

		$image_pro =($rs[$i]["display_image"]) ? $rs[$i]["display_image"] : "images/default.jpg";
?>

<div class="body-main-sub-in clearfix promotion-list-sub">
	<div class="col-md-5">
		<img src="<?=$image_pro;?>" class="max-w" />
	</div>
	<div class="col-md-7 last">
		<span class="bullet-no top-2"><?=$j?></span> <span  class="pro-subject"> <?=$rs[$i]["subject"];?></span>
		<div  class="pro-descript"> <?=str_replace("<li>","<li><span>",$rs[$i]["description"]);?> </div>
	</div>
</div>

<?php } ?>




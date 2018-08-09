<h1 class="h-text-contact-sub">
<span class="fa-stack fa-lg font-28">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-gamepad fa-stack-1x fa-inverse"></i>
</span> <?=getPicContent();?></h1>

<br>
<?=@$rs[0]["description"];?>

<div class="div-page">
	<div class="ajax-wait-page" >
		<span><img alt="" src="images/hourglass.gif" width="40"></span>
		<span><b><?=$this->lang->line("pleasewait");?></b></span>
	</div>
	<?=$paginator?>
</div>

<script>
	var uri = '<?=base_url().@getParam("1")?>';

	$(function(){
	    $('.paginate').on('click',function(){
		   $page = $('.paginate a').attr('href');
		   $pageind = $page.indexOf('page=');
		   $page = $page.substring(($pageind+5));

		   $(".ajax-wait-page").show();
		   
		   $.post(uri+"/?actionfunction=true&page="+$page, function( data ) {

			   $(".ajax-wait-page").hide();
			   $(".paginate").remove();
			   $(".body-main-sub").hide().append(data).fadeIn("slow");
			        
		   });
		return false;
		});
		
	});
</script>

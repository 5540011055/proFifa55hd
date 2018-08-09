<div class="body-main-sub-in">

<h1 class="h-text-contact-sub">
<span class="fa-stack fa-lg font-28">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i>
</span> <?=$this->lang->line("livescore")?></h1>
		
	<iframe src="http://free.thscore.co/asianbookie.htm" width="100%" height="1600"  scrolling="auto" frameborder="0"></iframe>
   
    <br>
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
			   $(".body-main-sub-in").hide().append(data).fadeIn("slow");

			   $('html, body').animate({
			        scrollTop: ($(".listf-"+$page).offset().top - 20)
			    }, "fast");
			        
		   });
		return false;
		});
		
	});
</script>

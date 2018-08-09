<div class="body-main-sub-in listf-<?=$page_temp;?>">

<div class="col-md-12">
<div id="post-146" class="post-146 page type-page status-publish hentry">
	    
	<div class="eyesports-entry-content">
		<div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="eyesports-blog eyesports-blog-grid"><ul class="row">
        
        <?php 
        
        	for($i=0;$i<count($rs);$i++){
        		
        		$link = base_url().getParam('1')."/detail/".$rs[$i]["id"];
        		
        		@$subject 		=  $rs[$i]["subject"];
        		@$title   		=  $rs[$i]["title"] ;
        		$hits	  		=  number_format($rs[$i]["hits"]);
        		$create_date    =  shortEnDate($rs[$i]['create_date']);
        		
        		$display_image  =  $rs[$i]["display_image"] ? $rs[$i]["display_image"]  : 'images/default.jpg' ;
        		
        
        ?>
        
        <li class="col-md-4">
			<div class="eyesports-blog-wrap">
	            <figure> 
	            	<a href="<?=$link?>"><img alt="" src="<?=$display_image?>"></a>
	            </figure>

	            <div class="eyesports-blog-text">

	                    <h2><a href="<?=$link?>"><?=$subject?></a></h2>
	                    <div class="eyesports-grid-time">
	                    	<span>
	                    		<i class="fa fa-clock-o"></i>
	                    		<?=$create_date?></span>
	                    	
									<a class="fa fa-angle-right" href="<?=$link?>"></a>

										                    </div>

	            </div>
            </div>

        </li>

        <?php } ?>
               
      
        </ul></div></div></div></div></div>
	</div><!-- .eyesports-entry-content -->

	</div><!-- #post-## -->
</div>

<div class="div-page">
	<?=$paginator?>
</div>

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

			   $('html, body').animate({
			        scrollTop: ($(".listf-"+$page).offset().top - 20)
			    }, "fast");
			        
		   });
		return false;
		});
		
	});
</script>
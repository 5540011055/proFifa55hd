<div class="outter-wrapper body-wrapper wrapper-news">
	<div class="wrapper ad-pad-first clearfix">
	
	
	<div class="col-xs-12">
					<div class="simple-column">
						<div class="heading heading-12">
							<p ><?=$this->lang->line("sport-news");?></p>
							<h2 class="wow zoomInUp"><?=$this->lang->line("news-ball");?></h2>
						</div>
					</div>
			</div>

		<div class="row news-blog">
			<div class="col-md-8 mgr-top">
                            <div class="blog-container">
                                
                                <div class="row work">
                                    
                                    <?php 
										$db = getDBO();
										
										/*$db->setQuery("SELECT id,subject,display_image,hits,create_date FROM news_information WHERE status = '1' ORDER BY recommend = '1' DESC,id DESC LIMIT 8");*/
										$db->setQuery("SELECT id,subject,display_image,hits,create_date FROM news_information WHERE status = '1' ORDER BY id DESC LIMIT 8");
										$rs_news = $db->loadAssocList();
										
										$time_sec = 0;
										
										for($i=0;$i<count($rs_news);$i++){
											
											$time_sec   = $time_sec + 0.2;
											$class_news = ($i>1) ? 'uefa-2016' : 'uefa-2017' ;
											
											$link = base_url()."news/detail/".$rs_news[$i]["id"];
											$image_news = ($rs_news[$i]["display_image"]) ? $rs_news[$i]["display_image"] : base_url().'images/default.jpg' ;
											$subject = $rs_news[$i]["subject"];
											
											$create_date = shortEnDate($rs_news[$i]['create_date']);
											 
										
											
										if($i>1){ ?>
												
											<div class="col-md-6 work-item  wow zoomIn" data-wow-delay="<?=$time_sec?>s">
                                        <div class="blog-items-sm">
                                            <a href="<?=$link?>">
                                                <div class="thumbnail">
                                                    <img src="<?=$image_news?>" width="120" height="120" alt="">
                                                </div>
                                                <div class="blog-content">
                                                    <!-- <span><?//=$this->lang->line('hotnews');?></span>  -->
                                                    <h3><?=$subject?></h3>
                                                    <p><i class="fa fa-clock-o"></i> <?=$create_date?> </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>	
												
								<?php 	}else{ ?>
												<div class="col-md-6 work-item  wow zoomIn" data-wow-delay="<?=$time_sec?>s">
			                                        <div class="blog-items">
			                                            <a href="<?=$link?>">
			                                                <span><?=$this->lang->line('hotnews');?></span>
			                                                <img src="<?=$image_news?>" style="height: 230px;">
			                                                <div class="blog-content-title">
			                                                    <h3><?=$subject?></h3>
			                                                    <span><i class="fa fa-clock-o"></i><?=$create_date?></span>
			                                                </div>
			                                            </a>
			                                        </div>
			                                    </div>	
								<?php 		}
										} // end for loop

								?>  
                                    
                                </div>
                            </div>
                            
                            <hr class="hr-pro">
			
			<a href="<?=base_url()?>news/index/<?=$this->lang->line("news-ball");?>" class="btn btn-danger btn-lg pull-right wow zoomIn" data-wow-delay="1s" data-animate-offset="50" role="button" id="more-news"> <i class="fa fa-plus-circle promo-btn" aria-hidden="true"></i> <?=$this->lang->line("news-other");?></a>
			
                            
                        </div>
			<!-- end of /. col -->
			
			
				<div class="col-md-4 mgr-top wow zoomIn" data-wow-delay="1.2s" >
				
					<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffifa55hd&tabs=timeline&width=340&height=700&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=472027116183953" width="340" height="700" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>



				</div>
			</div>
				<!-- end of /. sidebar -->
			
			<!-- end of /. col -->
		</div>

	</div>
</div>








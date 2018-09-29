<div class="outter-wrapper body-wrapper promotion-theme">
	<div class="wrapper section-promotion clearfix">

		<div class="col-md-6">
			 <img src="<?//=base_url()?>images/promotion/promote.png" class="img-responsive wow tada" data-wow-offset="50" data-wow-delay="1.5s" style="margin-top: 15%;"> 

		</div>

		<div class="col-md-6 last">
			<h3><?=$this->lang->line("promotion");?></h3>

			<p><?=$this->lang->line("promotion-head");?></p>

			<!-- <ul class="promotion">
				
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
			</ul> -->
			<h4>โปรสมัครใหม่</h4>
			<ul class="promotion">
				<li class="wow bounceInRight" data-wow-delay="<?=$time_sec?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr" aria-hidden="true"></i>  
							โปรแรกเข้า เปิดไอดีเล่น ฝากขั้นต่ำ 100 บาท รับเครดิต 100 บาท เล่นได้ทุกอย่างไม่อั้น
				</li>
				<li class="wow bounceInRight" data-wow-delay="<?=$time_sec?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr" aria-hidden="true"></i>  โปรลองเล่น ช่วงเวลา 08.00-24.00 ไม่ต้องฝาก รับเครดิต 200 บาท เล่นได้เฉพาะฟุตบอลเท่านั้น เทิร์น 20 เท่า
				</li>
				<li class="wow bounceInRight" data-wow-delay="<?=$time_sec?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr" aria-hidden="true"></i>  โปรคูณสอง สมัครขั้นต่ำ 1000 บาท รับเพิ่มอีก 1000 บาท เทิร์น 10 เท่า เล่นได้ทุกอย่าง แจกสูงสุด 1000 บาท
				</li>
				<li class="wow bounceInRight" data-wow-delay="<?=$time_sec?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr" aria-hidden="true"></i>  โปรแนะนำพิเศษ สมัครครั้งแรกได้รับเพิ่ม 20% เล่นได้ทุกอย่าง เทิร์นเพียง 5 เท่า รับเพิ่มสูงสุดถึง 1000 บาท
				</li>
				

			</ul>
			<h4>โปรสมาชิก</h4>
			<ul class="promotion">
				<li class="wow bounceInRight" data-wow-delay="<?=$time_sec?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr" aria-hidden="true"></i>  โปรแรก ทุกยอดฝาก รับ 5% สูงสุด 1000 บาทต่อครั้ง เทิร์น 3 เท่า เล่นได้ทุกอย่าง
				</li>
				<li class="wow bounceInRight" data-wow-delay="<?=$time_sec?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr" aria-hidden="true"></i>  โปรสอง ทุกยอดฝาก รับ 10% สูงสุด 1000 บาทต่อครั้ง เทิร์น 5 เท่า
				</li>
				<li class="wow bounceInRight" data-wow-delay="<?=$time_sec?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr" aria-hidden="true"></i>  โปรดีต่อใจ ยอดฝาก 5000 บาทขึ้นไป รับ 10% เทิร์น 3 เท่า สูงสุด 2000 บาท
				</li>
				<li class="wow bounceInRight" data-wow-delay="<?=$time_sec?>s"  >
							<i class="fa fa-chevron-circle-right icon-maginr" aria-hidden="true"></i>  โปรพิเศษ - แนะนำเพื่อน รับ 20% สูงสุด 1000 บาท เทิร์น 3 เท่า 
				</li>
				

			</ul>
			
			<hr class="hr-pro">
			
			<a href="<?=base_url()?>promotion/index/<?=$this->lang->line("promotion");?>" class="btn btn-danger btn-lg pull-right Parent slideInUp animated" data-animate-offset="50" role="button" id="more-promotion"> <i class="fa fa-plus-circle promo-btn" aria-hidden="true"></i> <?=$this->lang->line("promotion-more");?></a>
			
		</div>

	</div>
</div>








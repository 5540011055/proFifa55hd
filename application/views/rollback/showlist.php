<div class="body-main-sub-in listf-<?=$page_temp;?>">

	<p>
		<span style="color: #c1212c"><span style="font-size: 42px"><span
				style="font-family: pslxkittithadabold">ดูรายการเล่นย้อนหลัง FIFA55</span></span></span>
	</p>

	<p>&nbsp;</p>

	<p>
		<span style="font-size: 26px"><span
			style="font-family: thsarabunnewregular">1. ทำการล็อกอิน (login)
				โดยเข้าเว็บ FIFA55 จากนั้นกรอก User และ Password ของท่าน แล้วกดปุ่ม
				LOGIN</span></span>
	</p>

	<p>
		<img class="img-responsive"
			src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_4add77c513ac1b8.jpg" />
	</p>

	<p>&nbsp;</p>

	<p>
		<span style="font-size: 26px"><span
			style="font-family: thsarabunnewregular">2.
				ระบบจะแสดงรายละเอียดในรายการเล่นของท่าน
				เป็นอันเสร็จสิ้นการตรวจสอบรายการย้อนหลัง</span></span>
	</p>

	<p>
		<img class="img-responsive"
			src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_c66413a7fb7cbca.jpg" />
	</p>

	<p>&nbsp;</p>

	<p>
		<span style="font-size: 26px"><span
			style="font-family: thsarabunnewregular">3. เมื่อเลือกวันที่
				ที่ท่านต้องการตรวจสอบแล้ว ระบบจะแสดงรายการเล่นของวันนั้นๆ
				ให้ท่านกดเลือกรายการย่อยที่ท่านต้องการตรวจสอบ</span></span>
	</p>

	<p>
		<img class="img-responsive"
			src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_398ae2085b3ba66.jpg" />
	</p>

	<p>&nbsp;</p>

	<p>
		<span style="font-size: 26px"><span
			style="font-family: thsarabunnewregular">4. หลังจากกดปุ่มค้นหา
				ระบบจะแสดงรายการเป็นวันที่ที่ท่านเล่น และยอดรายการเล่นในแต่ละวัน
				ให้ท่านกดเลือกวันที่ที่ท่านต้องการตรวจสอบ </span></span>
	</p>

	<p>
		<img class="img-responsive"
			src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_cb695722554fe00.jpg" />
	</p>

	<p>&nbsp;</p>

	<p>
		<span style="font-size: 26px"><span
			style="font-family: thsarabunnewregular">5. เมื่อกดปฏิทิน
				ให้ท่านเลือกช่วงวันที่ท่านต้องการตรวจสอบ
				โดยเลือกสองครั้งคือวันที่เริ่มต้น และวันที่สิ้นสุด แล้วกดปุ่ม
				&ldquo;ค้นหา&rdquo; </span></span>
	</p>

	<p>
		<img class="img-responsive"
			src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_608852e33d8d7ef.jpg" />
	</p>

	<p>&nbsp;</p>

	<p>
		<span style="font-size: 26px"><span
			style="font-family: thsarabunnewregular">6. ในหน้ารายการรวม
				ให้ท่านกดที่ปฏิทิน
				เพื่อเลือกช่วงเวลาที่ท่านต้องการจะตรวจสอบรายการย้อนหลัง </span></span>
	</p>

	<p>
		<img class="img-responsive"
			src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_3fa34ac33ecc6ba.jpg" />
	</p>

	<p>&nbsp;</p>

	<p>
		<span style="font-size: 26px"><span
			style="font-family: thsarabunnewregular">7.
				เมื่อเข้ามาแล้วให้ดูเมนูข้างบน ให้กดที่เมนู &ldquo;รายการรวม&rdquo;
				(Statement) จะไปยังหน้ารายการเล่นรวม </span></span>
	</p>

	<p>&nbsp;</p>

	<p>&nbsp;</p>

	<p>&nbsp;</p>


	<div class="div-page">
		<div class="ajax-wait-page">
			<span><img alt="" src="images/hourglass.gif" width="40"></span> <span><b><?=$this->lang->line("pleasewait");?></b></span>
		</div>
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
			   $(".body-main-sub-in").hide().append(data).fadeIn("slow");

			   $('html, body').animate({
			        scrollTop: ($(".listf-"+$page).offset().top - 20)
			    }, "fast");
			        
		   });
		return false;
		});
		
	});
</script>

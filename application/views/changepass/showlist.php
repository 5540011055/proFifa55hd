<div class="body-main-sub-in listf-<?=$page_temp;?>">

	<p><span style="color:rgb(193, 33, 44); font-family:pslxkittithadabold; font-size:42px">วิธีเปลี่ยนรหัสผ่าน FIFA55</span></p>

<p><span style="font-size:26px"><span style="font-family:thsarabunnewregular">1. เมื่อท่านสมาชิกได้รับ Username และ Password จากทีมงานแล้ว นำมาใส่ในช่องตามรูป</span></span><img class="img-responsive" src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_d8f96776b309612.jpg" /></p>

<p>&nbsp;</p>

<p><span style="font-size:26px"><span style="font-family:thsarabunnewregular">2. เมื่อเข้ามาแล้วให้ดูเมนูข้างบน ให้กดที่เมนู &ldquo;เปลี่ยนรหัสผ่าน&rdquo; (Change Password) จะไปยังหน้าเปลี่ยนรหัสผ่าน</span></span><img class="img-responsive"  src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_671df72f8d1b181.jpg" /></p>

<p>&nbsp;</p>

<p><span style="font-size:26px"><span style="font-family:thsarabunnewregular">3. ท่านจะเข้ามายังหน้าเปลี่ยนรหัสผ่านให้กรอกรหัสผ่านปัจจุบัน รหัสผ่านใหม่ และยืนยันรหัสผ่านใหม่อีกครั้ง จากนั้นให้กด &ldquo;<span style="color:red">บันทึก</span>&rdquo;</span></span></p>

<p><img class="img-responsive"  src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_980c939ac99411b.jpg" /></p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><span style="color:rgb(193, 33, 44); font-family:pslxkittithadabold; font-size:42px">วิธีเปลี่ยนภาษา FIFA55</span></p>

<p><span style="font-size:26px"><span style="font-family:thsarabunnewregular">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; การเปลี่ยนภาษาใน FIFA55 หากท่านต้องการเปลี่ยนภาษา จากอังกฤษเป็นไทย หรือจากไทยเป็นอังกฤษนั้น ทำได้ไม่ยาก โดยมีขั้นตอนดังนี้</span></span></p>

<p>&nbsp;</p>

<p><span style="font-size:26px"><span style="font-family:thsarabunnewregular">1. ทำการล็อกอิน (login) โดยเข้าเว็บ FIFA55 จากนั้นกรอก User และ Password ของท่าน แล้วกดปุ่ม LOGIN</span></span></p>

<p><img class="img-responsive"  src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_d8f96776b309612.jpg" /></p>

<p>&nbsp;</p>

<p><span style="font-size:26px"><span style="font-family:thsarabunnewregular">2. เมื่อเข้ามาแล้ว ให้สังเกตที่มุมขวาบน จะมีกล่องภาษาให้เลือก ให้ท่านกดเลือกภาษาที่ท่านต้องการ</span></span></p>

<p><img class="img-responsive"  src="http://www.fifa55hd.com/backoffice/../files/com_linktoplay/2017-03/2017-03_b96a5364466ceec.jpg" /></p>

<p>&nbsp;</p>

<p><span style="font-family:thsarabunnewregular; font-size:26px">3. เพียงเท่านี้หน้าเว็บก็จะเปลี่ยนเป็นภาษาที่ท่านต้องการ&nbsp;</span></p>
	
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

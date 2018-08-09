<?
	include("../application.php");
	$AtMail=ereg_replace("www.","",$run_on);
?>
<script>
	var page="http://mail.<?=$AtMail?>/webmail/index.php?lid=th&tid=default&f_user=&six=&f_email=info@<?=$AtMail?>";
	document.location.href=page;
</script>
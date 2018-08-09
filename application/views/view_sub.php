<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"> <!--<![endif]-->

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta content="black" name="apple-mobile-web-app-status-bar-style">
        
       
		<title><?=getGeneralConfig("title");?></title>
		<link rel="icon" href="images/logoicon.ico">
		<base href="<?=base_url()?>" />
        <meta name="description" content="<?=getGeneralConfig("description");?>" />
		<META NAME="ROBOTS" CONTENT="INDEX,FOLLOW" /> 
		<META NAME="KEYWORDS" CONTENT="<?=getGeneralConfig("keyword");?>" />
		
		<meta property="og:image" content="http://www.fifa55hd.com/files/com_banner/2017-06/2017-06_7fa4e872121ae8e.gif"  />
		
		<!-- jQuery 2.1.3 -->
		<script type="text/javascript" src="<?=base_url()?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
        
      
		<!-- Style Sheets -->
		<link href="<?=base_url()?>font.css" rel="stylesheet" type="text/css" />
		
		
		<!-- Styling -->
		<link href="<?=base_url()?>style/core_sub.css" rel="stylesheet">
		
       <script>
			var txt_blank    = '<?=$this->lang->line("valid_blank");?>';
			var txt_tel      = '<?=$this->lang->line("txt-phone2");?>';
			var txt_success  = '<?=$this->lang->line("valid_success");?>';
			var txt_fail     = '<?=$this->lang->line("valid_fail");?>';
			var exits_tel    = '<?=$this->lang->line("exits_tel");?>';
		</script>
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123354254-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-123354254-1');
		</script>
</head>


<body>

<!-- MAIN PAGE CONTAINER -->
<div class="boxed-container">

	<?php $this->load->view("homepage/header"); ?>
	
	
	<div class="outter-wrapper paralax-block" style="padding-top: 0; padding-bottom: 3em; margin-top: 0; background: linear-gradient( rgba(25,25,25, 0.8), rgba(25,25,25, 0.8) ), url(img/next-match-bg.jpg);-webkit-background-size: cover; background-size: cover; background-position: 0px -20px;" data-stellar-background-ratio="0.75">		
	    	<div class="wrapper clearfix wp-head">
	    		<h1 style="font-size: 45px; font-family: 'PSLxKittithadabold'; padding: 0;"><?=getPicContent();?></h1>
	    		<!--<p class="col-2-2" style="padding: 0; margin: 0; font-family: 'THSarabunNewRegular'; font-size: 30px; color: #c7e0e8;">"<?=getGeneralConfig("company_slogan");?>"</p>-->
	    		<p class="col-2-2" style="padding: 0; margin: 0; font-family: 'THSarabunNewRegular'; font-size: 30px; color: #c7e0e8;">"<?=$txt_content;?>"</p>
	    	</div>
    	</div>
    	
    	<?php $this->load->view("subpage/breadcrumb"); ?>
    	
    	<div class="outter-wrapper body-wrapper" style="min-height: 600px !important;">
			
		<div class="wrapper blog-roll ad-pad clearfix">
		
			<!-- Start Main Column  -->
			<div class="col-sm-12 col-md-9 body-sub screen-w-right-in">
			
				<div class="clearfix post body-main-sub"><?=$VIEW_BODY?></div>
	
			</div>
			
			<!-- Start Right Sidebar  -->
			<aside class="col-sm-12 col-md-3 screen-w-right-2">
				<?php $this->load->view("subpage/contactall"); ?>
			</aside>
			
	
		</div>
	</div>
	
	
	 <?php $this->load->view("homepage/footer"); ?>  

</div>

	 <?php $this->load->view("homepage/menuphone"); ?>

		
		<link href="<?=base_url()?>style/style-switcher.css" rel="stylesheet">
		
		
		<!-- FontAwesome 4.3.0 -->
		<link href="<?=base_url()?>plugins/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>style/jquery.sidr.light.css">
        
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>js/animate.css-master/animate.min.css"> 

		<!-- Pace loading -->
		<link href="<?=base_url()?>plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
		<script src="<?=base_url()?>plugins/pace/pace.min.js" type="text/javascript"></script>
		
 	    <script type="text/javascript" src="<?=base_url()?>js/animate.css-master/dist/wow.min.js"></script>  
		
		<script type="text/javascript" src="<?=base_url()?>js/modernizr-2.6.2-respond-1.1.0.min.js"></script> 
		
		<!--Start of Zendesk Chat Script-->
		<script type="text/javascript">
			window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
			d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
			_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
			$.src="https://v2.zopim.com/?4ecMQx2oCFaulk7Xe6sYv7LR7WNccj8p";z.t=+new Date;$.
			type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");

			  $zopim(function() {
				    $zopim.livechat.button.setOffsetVerticalMobile(60);
				    $zopim.livechat.button.setOffsetHorizontalMobile(2);
				  });
		</script>
		<!--End of Zendesk Chat Script-->
		
		<!-- /.boxed-container -->

		<script type="text/javascript" src="<?=base_url()?>js/jquery.sidr.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/cleantabs.jquery.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/fitvids.min.js"></script>
		
		<script type="text/javascript" src="<?=base_url()?>js/jquery.stellar.min.js"></script>

		<script type="text/javascript" src="<?=base_url()?>js/jquery.stellar.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/toggle.js"></script>
		
		<script type="text/javascript" src="<?=base_url()?>js/main.js"></script>
		
		<script type="text/javascript" src="<?=base_url()?>js/contactform.js"></script>  
		
		<script> new WOW().init(); </script>
		<script type="text/javascript">
	    $(function(){
	      if (!Modernizr.svg) {
	        $('img[src*=".svg"]').attr('src', function() {
	          return $(this).attr('src').replace('.svg', '.png');
	        });
	      }
	    });
		</script>

<style>
	.footer-fix {
	    z-index: 99;
	    position: fixed;
	    bottom: 0;
	    left: 0;
	    right: 0;
	    padding: 0;
	    margin: 0;
	    overflow: hidden;
	    background: #c1212c;
	    background: -moz-linear-gradient(top, #c1212c 0, #7c050a 100%);
	    background: -webkit-linear-gradient(top, #c1212c 0, #7c050a 100%);
	    background: linear-gradient(to bottom, #c1212c 0, #7c050a 100%);
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#c1212c', endColorstr='#7c050a', GradientType=0);
	}
	
	.footer-fix li:nth-child(1) {
	    border-right: 1px solid #bb4a4a;
	}
	

	.footer-fix li:nth-child(2) {
	    border-right: 1px solid #bb4a4a;
	}
	
	
	
	
	.footer-fix li {
	    float: left;
	    width: 33.33%; 
/*  		width: 50%; */
	    list-style: none;
	    text-align: center;
    padding: 5px 0; 

/* 		padding: 10px 0; */
	}
	
	.footer-fix li img {
	    height: 45px;
	}
	
	@media screen and (max-width: 767px) {
		.visible-xs {
		    	display: block !important;
			}
	}
	
	@media screen and (max-width: 770px) {
		.visible-xs {
		    	display: block !important;
			}
	}	
</style>

</body>
</html>
   
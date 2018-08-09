<div class="top">
	<div class="container">
		<div class="pre-header-area">
			<div class="pre-header-left left" id="top-h-lef">
				<!-- Second Nav -->
				<ul>
					<li><a href="<?=base_url()?>homepage"><?=getGeneralConfig("title");?></a></li>
				</ul>
			</div>
			
			<div class="pre-header-right right">
				<ul class="clearfix">
                   <li>
                   <!--<a href="<?=base_url()?>register/index/<?=$this->lang->line("register");?>"><?=$this->lang->line("register");?></a></li> <span class="pipe-bar">| &nbsp;</span>-->
                   <a href="https://line.me/R/ti/p/%40fifa55hd"><?=$this->lang->line("register");?></a></li> <span class="pipe-bar">| &nbsp;</span>
                   <li><a href="<?=base_url()?>linktoplay/index/<?=$this->lang->line("linktoplay");?>"><?=$this->lang->line("linktoplay");?></a></li>         
               </ul>
			</div>
			
		</div>
	</div>
</div>
<!-- /.top -->

<!-- HEADER -->
<div class="header-container">
<div class="container">
<header class="header">
<div class="header__logo">

<a class="logo" href="<?=base_url()?>homepage">
	<img class="img-responsive" src="<?=base_url()?>images/logo.png" alt="<?=getGeneralConfig("company");?>" />
</a>

			<div id="mobile-header">
				<a id="responsive-menu-button" href="#sidr-main">
				  <em class="fa fa-bars" style="font-size: 45px;color: #fdfdfd;"></em> <?//=$this->lang->line("menu");?> <!-- <span class="menu-short"></span> -->
				</a>
			</div>
</div>

			

<div class="header-navigation" id="navigation-only">
	
	<ul class="menuHideBtn">
		<li><a id="closebtn" class="fa">&#xf00d;</a></li>
	</ul>

	<nav class="collapse navbar-collapse" id="cargopress-navbar-collapse">
	
				<ul class="main-navigation js-main-nav js-dropdown">
							<li class="nav-parent"><a href="<?=base_url()?>homepage"> <i class="fa fa-home" aria-hidden="true"></i> <?=$this->lang->line("homepage");?></a></li>
						    
						    <li class="nav-parent">
						    	<!--<span class="pipe">|</span> <a href="<?=base_url()?>register/index/<?=$this->lang->line("register");?>"><?=$this->lang->line("register");?></a> -->
						    	<span class="pipe">|</span> <a href="https://line.me/R/ti/p/%40fifa55hd"><?=$this->lang->line("register");?></a> 
						    </li>
						    
						    <li class="nav-parent">
						    	<span class="pipe">|</span> <a href="<?=base_url()?>promotion/index/<?=$this->lang->line("promotion");?>"><?=$this->lang->line("promotion");?></a>
						    </li>
						    
						    
						     <li class="nav-parent">
						    	<span class="pipe">|</span> <a href="<?=base_url()?>withdraw/index/<?=$this->lang->line("wihtdraw2");?>"><?=$this->lang->line("wihtdraw");?></a>
						    </li>
						    
						      <li class="nav-parent">
						    	 <span class="pipe">|</span> <a href="<?=base_url()?>howtoplay/index/<?=$this->lang->line("how-to-play");?>"><?=$this->lang->line("how-to-play");?></a>
						    </li>
						    <style>
.dropbtn{
	cursor: pointer;
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
/*    z-index: 1;*/
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    border-left: 2px solid #88050b;
}


.show {display: block;}
</style>
						    <li class="nav-parent dropdown dropbtn" onclick="myFunction();" >
						    	 <span class="pipe">|</span> <a >ฟุตบอล <i class="fa fa-caret-down" style="font-size:13px;"></i></a>
								  <div id="myDropdown" class="dropdown-content">
								   <a href="<?=base_url()?>news/index/<?=$this->lang->line("news-ball");?>"><?=$this->lang->line("news-ball");?></a>
								   <a href="<?=base_url()?>livescore/index/<?=$this->lang->line("livescore");?>"><?=$this->lang->line("livescore");?></a>
								   <a href="<?=base_url()?>dooball/index/<?=$this->lang->line("doo-ball");?>"><?=$this->lang->line("doo-ball");?></a>
								  </div>
						    </li>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
	console.log('dropdown show');
	$('#myDropdown').toggle();
//    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
$(window).click(function() {
//	console.log(2);
	$('#myDropdown').hide()
//Hide the menus if visible
});

$('.dropbtn').click(function(event){
//	console.log(1);
    event.stopPropagation();
});
</script>
						     <li class="nav-parent nav-hide">
						    	 <span class="pipe">|</span> <a href="<?=base_url()?>news/index/<?=$this->lang->line("news-ball");?>"><?=$this->lang->line("news-ball");?></a>
						    </li>		
						    
						     <li class="nav-parent nav-hide">
						    	 <span class="pipe">|</span> <a href="<?=base_url()?>livescore/index/<?=$this->lang->line("livescore");?>"><?=$this->lang->line("livescore");?></a>
						    </li>
						    
						     <li class="nav-parent nav-hide">
						    	 <span class="pipe">|</span> <a href="<?=base_url()?>dooball/index/<?=$this->lang->line("doo-ball");?>"><?=$this->lang->line("doo-ball");?></a>
						    </li>			    
						    
						     <li class="nav-parent nav-hide">
						    	 <span class="pipe">|</span> <a href="<?=base_url()?>linktoplay/index/<?=$this->lang->line("linktoplay");?>"><?=$this->lang->line("linktoplay");?></a>
						    </li>						    
						    <li class="nav-parent">
						    	<span class="pipe">|</span> <a href="<?=base_url()?>contactus/index/<?=$this->lang->line("contactus");?>"><?=$this->lang->line("contactus");?></a>
						    </li>
				</ul>
	</nav>
</div>
<div class="header-widgets">


<?php if(getGeneralConfig("company_callcenter")!=""){ ?>
<div class="widget-icon-box wow zoomIn" data-wow-delay="0.2s">
	<div class="icon-box">
		<h4 class="icon-box-title"><img src="<?=base_url()?>images/contact/svg/mobile-phone.svg" style="max-width: 22px;" /> <?=$this->lang->line("callcenter");?></h4>
		<span class="icon-box-subtitle"><?=getGeneralConfig("company_callcenter");?></span>
		
	</div>
</div>
<?php } ?>

<div class="widget-icon-box wow zoomIn" data-wow-delay="0.4s">
	<div class="icon-box" style="cursor: pointer;">
		<h4 class="icon-box-title"><img src="<?=base_url()?>images/contact/svg/line.svg" style="max-width: 22px;" /> <?=$this->lang->line("lineid");?></h4>
		<!--<span class="icon-box-subtitle" onclick="window.open('https://line.me/ti/p/<?=getGeneralConfig("company_line");?>', '_blank')">  <?=getGeneralConfig("company_line");?></span>-->
		<span class="icon-box-subtitle" onclick="window.open('https://line.me/R/ti/p/%40fifa55hd', '_blank')">  <?=getGeneralConfig("company_line");?></span>
	</div>
</div>

<div class="widget-icon-box wow zoomIn" data-wow-delay="0.6s" >
	<div class="icon-box" style="cursor: pointer;">
		<h4 class="icon-box-title"><img src="<?=base_url()?>images/contact/svg/facebook.svg" style="max-width: 22px;" />  <?=$this->lang->line("facebook");?></h4>
		<!--<span class="icon-box-subtitle" onclick="window.open('<?=getGeneralConfig("company_facebook_link");?>', '_blank')">  <?=getGeneralConfig("company_facebook");?></span>-->
		<span class="icon-box-subtitle" onclick="window.open('http://fifa55hd.com/', '_blank')">  <?=getGeneralConfig("company_facebook");?></span>
	</div>
</div>

</div>

</header>

</div>

</div>
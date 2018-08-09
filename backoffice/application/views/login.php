<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?=getGeneralConfig("title");?> :: <?=getGeneralConfig("admin_title");?></title>
<link rel="icon" href="images/logoicon.ico">

<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="phuwanart k.">


<script type="text/javascript">
</script>
<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
<link href="assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/webarch.css" rel="stylesheet" type="text/css" />

  <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="bootrap_css/font-awesome.min.css">

</head>


<body class="error-body no-top">
	<div class="container">
		<div class="row login-container column-seperation">
			<div class="col-md-5 col-md-offset-1">
				<p style="margin: 0 0  -5px -7px;">
					<img src="images/logologin.png" width="310">
				</p>
				<h3>Sign in to <?=getGeneralConfig("admin_title");?></h3>
			   <hr style="border-bottom: 1px solid #e5e9ec;width: 85%;">
			   <p >
			    	If you have any problem, Please contact.<br>
			    	 <a href="mailto:<?=getConfig("admin_mail");?>"> <i class="fa fa-envelope-o" aria-hidden="true"></i> <?=getConfig("admin_mail");?></a>
			    </p>
			    <br>
				
				

			
			</div>
			<div class="col-md-5">
				<br>
				<form action="authentication/login" class="login-form validate" id="login-form" method="post" name="entryform" >
					<div class="row">
						<div class="form-group col-md-10">
						<div class="alert alert-danger collapse" role="alert" id="login_flase"> <strong>Invalid username or password</strong><br> Please check and login again. </div>
						
							<i class="fa fa-user"></i> <label class="form-label"> Username</label> 
							<input class="form-control" id="txtusername" name="username" type="text" maxlength="20"  required >
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-10">
						    
							<i class="fa fa-lock"></i> <label class="form-label"> Password</label> <span class="help"></span>
							<input class="form-control" id="txtpassword" name="password" type="password" maxlength="20" autocomplete="off" required>
						</div>
					</div>
					
					
					
					<div class="row">
						<div class="control-group col-md-10">
							<div class="checkbox checkbox check-success">
							    <input type="hidden" name="baseurl" id="baseurl" value="<?=base_url()?>" >
								<input id="checkbox1" type="checkbox" value="1" checked="checked"> <label for="checkbox1">Remember me</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10">
							<button id="btn-login" class="btn btn-danger btn-cons pull-right" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		
		<div class="row">
		 	<div class="col-md-12"> <hr style="border-bottom: 1px solid #e5e9ec;"><center><?=getGeneralConfig("company2");?> © <?=getYear(@getConfig("create_date"));?> all right reserved.</center></div>
		</div>
		
	</div>

	<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-block-ui/jqueryblockui.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
	<script src="assets/authensystem.js" type="text/javascript"></script>
	
</body>
</html>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
   	<title><?=getGeneralConfig("title");?> :: <?=getGeneralConfig("admin_title");?></title>
   	<link rel="icon" href="images/logoicon.ico">
    <base href="<?=base_url()?>" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
   
    <!-- FontAwesome 4.3.0 -->
    <link href="dist/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    
    
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    
    
    <!-- jQuery 2.1.3 -->
    <script type="text/javascript" src="<?=base_url()?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="<?=base_url()?>plugins/jquery-ui.min.js" type="text/javascript"></script>
   
    <script type="text/javascript" src="<?=base_url()?>js/system.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>font.css" type="text/css">
   
   
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
      $.widget.bridge('uibutton', $.ui.button);
    </script> -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url()?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
    
    <link href="<?=base_url()?>js/iCheck/all.css" rel="stylesheet" type="text/css" />
       
    
    <!-- Uploadifive -->
         <script src="<?=base_url()?>js/uploadifive/jquery.uploadifive.min.js" type="text/javascript"></script>
         <link rel="stylesheet" href="<?=base_url()?>js/uploadifive/uploadifive.css" /> 
        <!-- END Uploadify  -->
        
   <link type="text/css" rel="stylesheet" href="<?=base_url()?>js/jquery.autocomplete.css" />
   <script type="text/javascript" src="<?=base_url()?>js/jquery.autocomplete.js"></script>
    
    
      <!-- Ckeditor -->
    <script type="text/javascript" src="<?=base_url()?>js/tiny_mce/jquery.tinymce.js"></script> 
    <script src="<?=base_url()?>js/ckeditor/ckeditor.js"></script>   
        
    <script>
       var base_url = '<?=base_url()?>';
    </script>
        
      <!--  <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>  --> 
        <!-- END Ckeditor -->  
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="dist/js/html5shiv.js"></script>
        <script src="dist/js/respond.min.js"></script>
    <![endif]-->
 
    
  </head>
<body class="<?=getThemeConfig()?> sidebar-mini" >

<?php 
      @$root_url = "../".base_url();
      @$user  = getLogedInUser();
?>
    
    <div class="wrapper fixed">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url()?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"> <!-- <img src="images/logohead.png" width="28"> --></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"> <!-- <img src="images/logohead.png" width="28">  --><b><?=getGeneralConfig('company2')?></b> &nbsp;&nbsp;</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
           
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              
                  <span class="hidden-xs"><i class="fa fa-user"></i> &nbsp; <?=$user["fullname"]?> </span>
                  &nbsp; <i class="fa fa-sort-desc fa-3"></i>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?=getImageRatioPerson($user["avatar"],120,120)?>" class="img-circle" alt="User Image" />
                    <p>
                    <?=$user["fullname"]?><br>
                      <small><b>Last Login:</b> <?=$user["last_login"]?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <li class="user-body">
							<div class="col-xs-6 text-center btn_pop" >
								<a href="<?=base_url()?>edit_profile">ข้อมูลส่วนตัว</a>
							</div>


							<div class="col-xs-6 text-center btn_pop">

								<a href="<?=base_url()?>changepass">เปลี่ยนรหัสผ่าน</a>
							</div>

						</li>
               
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!-- 
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div> -->
                    <div class="pull-right">
                      <a href="<?=base_url()?>authentication/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
           
              
            </ul>
          </div>
        </nav>
      </header>
     
     
     
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
       	
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=getImageRatioPerson($user["avatar"],120,120)?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p style="font-weight: bold; font-size: 12px; color: rgb(240, 173, 78);"><?=@$user["fullname"]?></p>
               <p style="font-size: 12px;color:#d2d6de;"> <?=getusersClassName($user["userclass"]);?></p>
               <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
               
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form"></form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" id="navi">
            <li class="header">MAIN NAVIGATION</li>
           
           
            <?PHP  /* see application/libraries/util/funcUntil.php */
                    funcUtil::getLoadMenu();
            ?>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <?php 
             $menuName  =  funcUtil::getMenuname(getParam(1,'dashboard'));
       ?>
        <section class="content-header">
          <h1 style="font: 26px/24px 'supermarket', Arial, sans-serif;">
            <?=$menuName?>
            <small></small>
          </h1>
          
          
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> หน้าหลัก</a></li>
            <li <?=((!getParam('1')) || (getParam('1')=='dashboard') ) ? 'class="active"' : '' ;?>><?=funcUtil::getBreadcrumb(getParam(1,'dashboard'))?></li>
            
            <?php if(getParam('1')!='dashboard' && getParam('1')!="" ){ ?>
                     <?php if(!getParam('2')){?>
                           <li><?=funcUtil::getMenuname(getParam(1,'dashboard'))?></li>    
                     <?php }else{?>
                               <li class="active"><a href="<?=base_url().getparam('1')?>"><?=funcUtil::getMenucontrolName(getParam(1,'dashboard'))?></a></li>
                     <?php } ?>
                     
            <?php } ?>
            
            <?php if(@getParam('2')){ ?> <li class="active"><?=$data['menuName']?></li> <?php } ?>
          </ol>
        </section>
       
        <section class="content">  
          	<?=(funcUtil::page_permission()) ? $body :  $this->load->view('not_permission');?>
        </section>
   
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> <?=getConfig("version")?>
        </div>
        <strong>Copyright &copy; <?=getYear(@getConfig("create_date"));?> <?=getGeneralConfig("company2");?>.</strong> All rights reserved.
      </footer>
     
     
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->



			  <!-- Modal -->
		<div class="modal fade" id="boltplswaitdlg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="vertical-alignment-helper">
		<div class="modal-dialog vertical-align-center" style="width: 310px;">
			<div class="modal-content">
				<div class="modal-body bodyradius">
					<div class="rb">
						<div class="wbf text-center">
							<h4>
								<i class="fa fa-refresh fa-spin"></i> &nbsp; Please wait ...
							</h4>
						</div>
						<br>
					</div>

					<div class="progress progress-md  active">
						<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
							<span class="sr-only">100% Complete</span>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>
  
 <!-- pop box for del item -->  
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
            
                <div class="modal-header box-danger" style="background-color: #428bca; color: #FFF;" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> ยืนยันการลบข้อมูล</h4>
                </div>
            
                <div class="modal-body">
                    <p><b>ต้องการลบข้อมูลที่ได้ทำการเลือก ?</b></p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <a class="btn  btn-success btn-ok"><i class="fa fa-trash-o"></i> ยืนยัน</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> ยกเลิก</button>
                </div>
            </div>
        </div>
</div>

 <!-- pop box for del many item -->  
<div class="modal fade" id="confirm-deleteall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header box-danger" style="background-color: #428bca; color: #FFF;" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> ยืนยันการลบข้อมูล</h4>
                </div>
            
                <div class="modal-body">
                    <p><b>ต้องการลบข้อมูลที่ได้ทำการเลือก ?</b></p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <a class="btn  btn-success btn-ok"><i class="fa fa-trash-o"></i> ยืนยัน</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> ยกเลิก</button>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="vertical-alignment-helper">
		<div class="modal-dialog vertical-align-center">
		
			<div class="modal-content">
				 <div class="modal-body">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: -10px;margin-bottom: 5px;">&times;</button>
		        <div id="vdo-sample" align="center" class="embed-responsive embed-responsive-16by9">
		           
		        </div>
		      </div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="show-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="vertical-alignment-helper">
		<div class="modal-dialog vertical-align-center">
			<div class="modal-content">
				<div class="modal-header box-danger" style="background-color: #428bca; color: #FFF;" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">หลักฐานการโอนเงิน</h4>
                </div>
			
				 <div class="modal-body">
			        <div class="paste-img"></div>
		        </div>
		      </div>
			</div>
		</div>
	</div>
</div>





    <!-- Sparkline -->
    <script src="<?=base_url()?>plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?=base_url()?>plugins/knob/jquery.knob.js" type="text/javascript"></script>
    
   
    <!-- Bootstrap 
    <script src="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> WYSIHTML5 -->
    <!-- Slimscroll -->
    <script src="<?=base_url()?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?=base_url()?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>dist/js/app.min.js" type="text/javascript"></script>    
    
    <!-- <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>  -->
    
    <script src="<?=base_url()?>js/iCheck/icheck.min.js" type="text/javascript"></script>
    
    
    <link href="<?=base_url()?>js/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.css" rel="stylesheet">
    <script src="<?=base_url()?>js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.th.min.js"></script>    
    
    <link href="<?=base_url()?>dist/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="<?=base_url()?>dist/js/bootstrap-toggle.min.js"></script>
    
    <script src="dist/js/demo.js"></script>


<script>



    var timeoutId               = null; 
       
    $(function(){
        $('a, select, input, button, div, span').tooltip({
            show    : null,
            position: {
                my: "left top",
                at: "left bottom"
            },
            open: function( event, ui ) {
                ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
            },
            content: function(){
                if ( $(this).is('[data-title]') ) {
                    return '<img src="'+$(this).parent().find('input[type=hidden]').val()+'" />';
                }
                return $(this).attr( "title" );
            }
        });
  
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        
    });
   

    $(function(){
        
        $(document).ajaxStart(function() {
            startAjax();
        });

         $(document).ajaxStop(function() {

        	    //setTimeout(function(){
        		 $("#boltplswaitdlg").modal('toggle');
        		// $(".modal-backdrop ").hide();
        	   //}, 800); 
        	 

        });

        
    });
    
    
    function startAjax(){
    	/*$('#boltplswaitdlg').modal({
            show: true
        }); */

    	$('#boltplswaitdlg').modal('show');
    }
    
    $('#confirm-delete').on('show.bs.modal', function(e) {
		$('#confirm-delete').find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#confirm-deleteall').on('show.bs.modal', function(e) {
	   $('#confirm-deleteall').find('.btn-ok').attr('onclick',$(e.relatedTarget).data('href'));
    });

    $('#videoModal').on('hidden.bs.modal', function () {
		$('#vdo-sample').html("Video Not Found");
	})	
</script>

<?php funcUtil::getSlideMenu(); // special for slide menu ?>
   
 </body>
</html>
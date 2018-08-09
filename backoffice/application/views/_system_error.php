<!DOCTYPE html>
<html lang="en"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Error Logs</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
   <script type="text/javascript" src="<?=base_url()?>js/jquery-1.7.2.min.js"></script>
   <script type="text/javascript" src="<?=base_url()?>js/ui/js/jquery-ui-1.8.21.custom.min.js"></script>
        
    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="<?=base_url()?>bootrap_css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>bootrap_css/style.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?=base_url()?>bootrap_css/line-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>bootrap_css/font-awesome.min.css">

    <!-- CSS Theme -->    
    <link rel="stylesheet" href="<?=base_url()?>bootrap_css/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="http://htmlstream.com/preview/unify-v1.5/assets/css/custom.css">

    <style>
            .redirect{
                padding: 0px 3px 2px 3px;
               color: #7A7A7A;
margin: 0;
padding: 0;
border: 0;
outline: 0;
font-size: 13px;
vertical-align: baseline;
            }
            #redirect-sec{
                font-size: 18px;
                font-weight: bold;
                color: rgb(255, 0, 82);
            }
        </style>

<div class="wrapper">
    <!--=== Header ===-->    
    <div class="header">
      
    
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
    <!--=== End Header ===-->    

    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs" style="background: rgb(80, 80, 78);">
        <div class="container">
           
            <h1 class="pull-left" style="color: rgb(255, 177, 12);"> <i class="fa fa-warning"></i>Error Logs</h1>
           
        </div>
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content">		
        <!-- Funny Boxes -->
            <div class="alert alert-block alert-danger fade in">
                <button class="close" type="button"  onclick="window.location='<?=@$page?>'">×</button>
                <h4 style="border-bottom: 1px solid #F1CBCB;"><i class="fa fa-warning" ></i>Error : <?=@$msg?></h4>
 <div class="redirect" style="text-align:center;">
            กรุณารอ&nbsp;<span id="redirect-sec">5</span>&nbsp;วินาที&nbsp;เพื่อไปยังหน้าถัดไป<br />
            หรือกดที่นี่ &nbsp;  <a class="btn-u btn-u-red" href="<?=@$page?>"> <?=lang('Continue','Continue')?> </a></div>        
</div><!--/container-->		
  

</div><!--/wrapper-->
  <script>
            function nextPage(delay){
                $('#redirect-sec').text(--delay);
                if(delay>0){
                    setTimeout("nextPage("+delay+");",1200);
                }else{
                    window.location="<?=@$page?>";
                }
            }
            $(function(){
                setTimeout("nextPage(5);", 1200);
            })
        </script>
</body></html>

	
		<div id="alert1"  class="alert alert-danger alert-dismissable" style="height: auto;  color: #a94442 !important; background-color: #f2dede !important;border-color: #ebccd1;">
                   	 <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                   		 <h3><i class="fa fa-warning"></i>ไม่มีสิทธิ์ในการใช้งานหน้านี้</h3><hr>
						 <font style="font-size: 18px;">กรุณาติดต่อผู้ดูแลระบบ</font><br><br>
						 
						 <font style="font-size: 16px;">
							  <span class="fa-stack fa-xs">
  									<i class="fa fa-circle fa-stack-2x"></i>
  									<i class="fa fa-user fa-stack-1x fa-inverse"></i>
							  </span>&nbsp;<?=getConfig('admin_name')?><br>
							  
							  <span class="fa-stack fa-xs">
  									<i class="fa fa-circle fa-stack-2x"></i>
  									<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
							  </span>&nbsp;<?=getConfig('admin_phone')?><br>
							  
							  <span class="fa-stack fa-xs">
  									<i class="fa fa-circle fa-stack-2x"></i>
  									<i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
							  </span>&nbsp;<a style="color:#a94442" href="mailto:<?=getConfig("admin_mail");?>"><?=getConfig("admin_mail");?></a>
						 </font>    
						  <br><br><br><br>
        </div>
	
	
		
		<br /> <br />

<style>
 .redirect{ padding: 0px 3px 2px 3px;
            color: #0E0C49;
			margin: 0;
			padding: 0;
			border: 0;
			outline: 0;
			font-size: 15px;
			vertical-align: baseline;
}#redirect-sec{
             font-size: 18px;
             font-weight: bold;
             color: rgb(255, 0, 82);
 }
</style>
$(function() {
				$("#txtusername").keyup(function() {
  				    $("#login_flase").fadeOut("slow");
  				});
		});


		$("#login-form").submit(function() {

			 var url = $("#baseurl").val();

              if( ($('#txtusername').val() != "") && ($('#txtpassword').val() != "")  ){ 
                  
           	    $.post( "authentication/login", { username : $('#txtusername').val(), password : $('#txtpassword').val() }).done(function(data) {
           	    	if(data){
           	    	   window.location.href = url;
               	     }else{
               	    	     $("#login_flase").fadeIn("slow");
                	    	 $('#txtusername').val("");
                	    	 $('#txtpassword').val("");
                	    	 
                   	}

           	   });
                     return false;
              	   
              }
	   });
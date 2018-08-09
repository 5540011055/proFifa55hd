$(document).ready(function() {

   
    $('#contactus-form').formValidation({
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	
        	
        	textfield: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกหัวข้อ'
                      },
                      stringLength: {
                          min: 4,
                          message: ' '
                      }
                  }
              },
              

            
            
        }
    });
    
   
    
});





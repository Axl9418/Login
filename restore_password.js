$( document ).ready(function() {

	$('#restore_pass').validate({

	    rules: {	            
	            password: {
	            	required: true,
					minlength: 6,
	            },
	            con_password:{
	            	required:true,
	            	minlength:6,
	            	equalTo : "#password"
	            }
	        },
	    messages: {	    	
	    	password: {
	    		required: "Please, enter a password.",
				minlength: jQuery.validator.format("Your password should contain at least {0} characters")
	    	},
	    	con_password:{
	    		required: "Please, confirm your password.",
	    		equalTo: "Please enter the same password again."
	    	}
	    }

	    
	});

});



//falta pasar el token
function restore_pass(id){

	var restoreData = {
		 	userId: id,	
		 	
		 	password: $('#password').val(),
			con_password: $('#con_password').val()
		}

console.log('Funciona');
/*
			 
			 $.ajax({
						url:"http://localhost/Portfolio/Login/update_password.php",
						type: "POST",
						dataType: 'json',
						data: {data: JSON.stringify(restoreData)},
						  
					});
*/
	
}
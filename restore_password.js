var user_id=0;
var	user_token=0;


function restore_pass(id, token){

	user_id= id;
	user_token= token;
	
}



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
	    },
				submitHandler: function( update ) {						
					$.ajax({
					  url: "http://localhost/Portfolio/Login/update_password.php",
				 	  type: "POST",
					  data: {
					  	user_id,
					  	user_token,
					    password: $('#password').val(),				    
					    con_password: $('#con_password').val()	    
					  },
				  success: function( result ) {				

				  		if(result != false){
					  		$('#msg').html(result); 
							$('#dialog').modal('show');	
					  	}
					  	else{
					  		window.location.href = "http://localhost/Portfolio/Login/login.html";
					  	}  	
								  					  						  	

				  }

					});
				}

	    
	});

	

});



/*
function restore_pass(id, token){

	var restoreData = {
		 	userId: id,	
		 	userToken: token,
		 	password: $('#password').val(),
			con_password: $('#con_password').val()
		}
		//console.log(restoreData);
	
}
*/



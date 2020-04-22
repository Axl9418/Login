$( document ).ready(function() {

	$('#forgot_pass').validate({

	    rules: {	            
	            email: {
	                required: true,
	                email: true
	            }
	        },
	    messages: {	    	
	    	email: {
	    		required:"Please enter a email addres",
	    		email: "Invalid email addres."
	    	}
	    },

	    submitHandler: function(send) {
	        $.ajax({
				  url: "http://localhost/Portfolio/Login/forgot_password.php",
				  type: "POST",
				  data: {
				    email: $('#email').val()			    				    
				  },
				  success: function( result ) {				  	
					  	$('#msg').html(result);
					  	console.log('entro'); 
						$('#dialog').modal('show');	

						$("#dialog").on("hidden.bs.modal", function () {
					    	window.location.replace("http://localhost/Portfolio/Login/login.html");					    	
						});
					  	
				  }

		  	});

	    }

	});

});
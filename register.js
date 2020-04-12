// A $( document ).ready() block.
$( document ).ready(function() {


	$('#register').validate({

	    rules: {
	            username: {
	                required: true
	            },
	            email: {
	                required: true,
	                email: true
	            },
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
	    	username: "Please enter a username.",
	    	email: {
	    		required:"Please enter a email addres",
	    		email: "Invalid email addres."
	    	},
	    	password: {
	    		required: "Please, enter a password.",
				minlength: jQuery.validator.format("Your password should contain at least {0} characters")
	    	},
	    	con_password:{
	    		required: "Please, confirm your password.",
	    		equalTo: "Please enter the same password again."
	    	}
	    },

	    submitHandler: function(register) {
	        $.ajax({
				  url: "http://localhost/Portfolio/Login/register.php",
				  type: "POST",
				  data: {
				    username: $('#name').val(),
				    email: $('#email').val(),
				    password: $('#password').val(),
				    con_password: $('#con_password').val()
				  },
				  success: function( result ) {					

					$('#msg').html(result); 
					$('#dialog').modal('show'); 

					
					$("#dialog").on("hidden.bs.modal", function () {
					    window.location.replace("http://localhost/Portfolio/Login/login.html");

					});
   

				  }

		  	});
	    }
	});


});
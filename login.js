// A $( document ).ready() block.
$( document ).ready(function() {


	$('#login').validate({

	    rules: {
	            username: {
	                required: true
	            },	            
	            password: {
	            	required: true
	            }
	        },
	    messages: {
	    	username: "Please enter a username.",	    	
	    	password: "Please, enter a password."
	    },

	    submitHandler: function(login) {
	        $.ajax({
				  url: "http://localhost/Portfolio/Login/login.php",
				  type: "POST",
				  data: {
				    username: $('#username').val(),				    
				    password: $('#password').val(),				    
				  },
				  success: function( result ) {	

				  	$('#msg').html(result); 
					$('#dialog').modal('show');	

				  }

		  	});

	    }
	});

	
});


function newEmail(id, username, email){
	 var userData = {
	 	userId: id,
	 	user: username,
	 	mail: email
	 }
	 $.ajax({
				url:"http://localhost/Portfolio/Login/resend_mail.php",
				type: "POST",
				dataType: 'json',
				data: {data: JSON.stringify(userData)},


				  success: function(response) {	

				  	//$('#dialog').modal('hide');	
				  	console.log("pito pues" + response);

				  },
			      error: function (xhr, status, error) {
			        console.log("error text" + xhr.responseText);
			        console.log("status" + status);
			        console.log("error" + error);
			      },
			      complete: function () {
			        // Handle the complete event
			        alert(" completed " );
			      }
			});

	
}
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

					  	if(result != false){
					  		$('#msg').html(result); 
							$('#dialog').modal('show');	
					  	}
					  	else{
					  		window.location.href = "http://localhost/Portfolio/Login/main.php";
					  	}

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

				  	if(response == true){
				  		$('form :input').val('');
				  		$('#msg').html("A new email with the instructions to finish the register has been sent to " +  email); 
				 	 }

				  }
			});

	
}
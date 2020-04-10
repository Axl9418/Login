// A $( document ).ready() block.
$( document ).ready(function() {
		$( "#button" ).click(function() {

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


							 

						    /*
						    //delay page
						    setTimeout(
							  function() 
							  {
							    //do something special
							  }, 5000);

						    //redirect
						    window.location.replace("http://localhost/Portfolio/Login/login.php");
						    */
						  }



				  	});

				  	return false;

		});	

});
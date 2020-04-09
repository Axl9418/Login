/*
var check = function() {

  if (document.getElementById('password').value == document.getElementById('con_password').value) {
		    document.getElementById('msg').style.color = 'green';
		    document.getElementById('msg').innerHTML = 'matching';
  } 
  else {
		    document.getElementById('msg').style.color = 'red';
		    document.getElementById('msg').innerHTML = 'not matching';
  }
}
*/

// A $( document ).ready() block.
$( document ).ready(function() {
		$( "#dialog" ).dialog({
		    autoOpen: false,
		      buttons: {
		        Ok: function() {
		          $( this ).dialog( "close" );
		        }
		      }
		  });
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
				    
							$('#dialog').html(result).dialog('open');


							 

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
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo base_url(); ?>favicon.ico">
        <title>Lottary Login</title>
        <!-- Bootstrap core CSS -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="<?php echo base_url(); ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
		
		<link rel='stylesheet' href="<?php echo base_url('assets/css/style.css');?>" type="text/css" />
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        
    </head>
  
	<div class="login-form">
		<form action="/examples/actions/confirmation.php" method="post">
			<h2 class="text-center">Create Account</h2>       
			<div class="form-group">
				<input type="text" name="fname" class="form-control" placeholder="Full Name" required="required">
			</div>      
			<div class="form-group">
				<input type="text" name="email" class="form-control" placeholder="Email" required="required">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Password" required="required">
			</div>
			<div class="form-group">
				<input type="text" name="phone" class="form-control" placeholder="Phone" required="required">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Save</button>
			</div>      
		</form>
		<p class="text-center"><a href="#">Login</a></p>
	</div>
           
			
        <script>
		function opt_process(){
		var email = $("#login_email").val();
		var password = $("#password").val();
			$.post("<?php echo base_url("users/login_auth") ?>", {
					email: email,
					password: password
			 })
			.done(function(data) {
				var response = jQuery.parseJSON(data);
				if (response.error == "0") {
					$(".statusMsg").html("");
				}
				
					if (response.error == "1") {
					$(".statusMsg").html('<div id="danger-alert" class="alert alert-danger fade in left20 right20"><a href="#" class="close" data-dismiss="alert">&times;</a>'+response.message+'</div>');
					setTimeout(function() {
					}, 3000);
				} 
				else if (response.auth_type == "1") {
					console.log(response.redirect)
				   window.location.href=response.redirect; 
				} 
				else if (response.auth_type == "2") {
				   $('#user-otp').modal('show');
				   $(".message").html('<div id="success-alert" class="alert alert-success fade in left20 right20"><a href="#" class="close" data-dismiss="alert">&times;</a>'+response.message+'</div>');
				} 
			});
		}
		function validate_otp(){
			 var otp = $("#otp").val();
                   
                    $.post("<?php echo base_url("users/otp_verification"); ?>", {otp: otp})
                        .done(function(data) {
                            var obj = JSON.parse(data);
							
                           if((obj.error=="0") && (obj.force_change_password!="1"))
                           {
                            location.reload();
                           }
							else if((obj.error=="0") && (obj.force_change_password==1))	{
							window.location.href = "<?php echo base_url('/users/change_password');?>";
							}					   
                            else {
                                $(".message").html('<div id="danger-alert" class="alert alert-danger fade in left20 right20"><a href="#" class="close" data-dismiss="alert">&times;</a>Otp does not match.</div>');
                            }
                           
                        });
		}
            $(document).ready(function() {  
					
							
				$("#loginSubmit").click(function() {
                    opt_process();
                });				
				$('#otp').keypress(function (e) {
					var key = e.which;					
					if(key == 13)
					validate_otp(); 				 
					
				});
				
				$("#login_email,#password").keypress(function (e) {				
					var key = e.which;
					if (key == 13)  // the enter key code
					{
						opt_process();						
					}
				});			
						
                $("#change_password").click(function() {
                    var email = $("#email").val();
                    $.post("<?php echo base_url("users/doforget") ?>", {
                                email: email
                            })
                        .done(function(data) {
                            if (data == "true") {
                                $(".message").html('<div id="success-alert" class="alert alert-success fade in left20 right20"><a href="#" class="close" data-dismiss="alert">&times;</a>Please check your email, email and password id sent to you.</div>');
                                setTimeout(function() {
                                    window.location.reload();                                    
                                }, 3000);
                            } else {
                                $(".message").html('<div id="danger-alert" class="alert alert-danger fade in left20 right20"><a href="#" class="close" data-dismiss="alert">&times;</a>Den angiva e-postadressen finns inte registrerad. </div>');
                            }
                        });
                });
                $("#otp_verify").click(function() {
                  validate_otp(); 
                });
                if ($(".result-popup").hasClass("success")) {
                    $('#result-success').modal('show');
                }
                if ($(".result-popup").hasClass("error")) {
                    $('#result-error').modal('show');
                }
            });
			
        </script>
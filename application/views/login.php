<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/sign.css');?>" />
	<script>

	</script>
    </head>
  <body>
    <div class="container">
    <?php echo form_open('Welcome/verifying','id="loginForm" name="loginForm" class="form-sign"'); ?>
		<h4 class="form-sign-heading" style="text-align:center;">Sign in to Timing</h4>
		<input type="text" name="builderUsername" value="<?php if(isset($cookieUsername)){echo htmlspecialchars($cookieUsername);} ?><?php echo set_value('builderUsername'); ?>" class="form-control sign-in" placeholder="Username" required autofocus>
		<input type="password" name="builderPassword" class="form-control sign-in" placeholder="Password" required>
		<a class="btn btn-primary btn-block" onclick="signin()">Continue</a>
		<p style="text-align:center;">New to Timing? <a href="<?php echo site_url('Welcome/register'); ?>">Create an account</a>.</p>
		<div class="alert alert-danger" style="display:none;"></div>
    <div class="alert alert-success" style="display:none;"></div>
	</form>

    </div> <!-- /container -->

    <script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <script>
	function signin(){
		var username=$('[name=builderUsername]').val().trim() || '';
		var password=$('[name=builderPassword]').val() || '';
		if(username.length < 5 || password.length < 6){ 
			$('.alert').hide();
			$('.alert-danger').html('Incorrect username or password.').show();
			return;
		}else{
			$('.alert').hide();
			//$('#loginForm').submit(); #replaced by AJAX-style
      $.ajax({
        type:'post',
        url:"<?php echo site_url('Welcome/verifying'); ?>",
        data:{builderUsername:username,builderPassword:password},
        success:function(response,status,xhr){
 			    if(response=='1'){
            $('.alert-success').html('Signing in...').show();
            setTimeout('location.href="<?php echo site_url("Cuser/index"); ?>"',500);
          }else if(response=='0'){
            $('.alert-danger').html('Incorrect username or password.').show();
          }else{
            alert('something went wrong!');
          }
		    }
      })
		}
	}
    </script>

  </body>
</html>

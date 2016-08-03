<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/signin.css');?>" />
	<script>

	</script>
    </head>
  <body>
    <div class="container">
    <?php echo form_open('Welcome/verifying','id="loginForm" name="loginForm" class="form-signin"'); ?>
		<h4 class="form-signin-heading">Sign in to Timing</h4>
		<input type="text" name="builderUsername" value="<?php echo set_value('builderUsername'); ?>" class="form-control" placeholder="Username" required autofocus>
		<input type="password" name="builderPassword" class="form-control" placeholder="Password" required>
		<button type="submit" class="btn btn-primary btn-block">Go ~</button>
		<p style="margin-top:7px;">New to Timing? <a href="<?php echo site_url('Welcome/register'); ?>">Create an account</a>.</p>
	</form>

    </div> <!-- /container -->

    <script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('public/js/bootstrap.min.js');?>" type="text/javascript"></script>
  </body>
</html>

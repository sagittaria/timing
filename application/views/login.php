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
		<h2 class="form-signin-heading">Please sign in</h2>
		<input type="text" name="builderUsername" value="<?php echo set_value('builderUsername'); ?>" class="form-control" placeholder="Username" required autofocus>
		<input type="password" name="builderPassword" class="form-control" placeholder="Password" required>
		<p >Not have a username? <a href="<?php echo site_url('Welcome/register'); ?>">register now</a></p>
		<button type="submit" class="btn btn-lg btn-primary btn-block">Go ~</button>
	</form>

    </div> <!-- /container -->

    <script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('public/js/bootstrap.min.js');?>" type="text/javascript"></script>
  </body>
</html>

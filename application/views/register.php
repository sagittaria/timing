<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/sign.css');?>" />
	<script>

	</script>
    </head>
  <body>
    <div class="container">
    <?php echo form_open('Welcome/register','id="regForm" name="regForm" class="form-sign"'); ?>
	<h4 class="form-sign-heading" style="text-align:center;">Sign up to Timing</h4>
	<div class="form-group"><label for="builderUsername">Username</label>
	<input id="builderUsername" type="text" name="builderUsername" value="<?php echo set_value('builderUsername'); ?>" class="form-control sign-up" required>
		<?php echo form_error('builderUsername'); ?>
	</div>
	<div class="form-group"><label for="builderPassword">Password</label>
	<input id="builderPassword"type="password" name="builderPassword" class="form-control sign-up" required>
		<?php echo form_error('builderPassword'); ?>
	</div>
	<div class="form-group"><label for="builderEmail">Email</label>
	<input id="builderEmail" type="email" name="builderEmail" value="<?php echo set_value('builderEmail'); ?>" class="form-control sign-up" required>
		<?php echo form_error('builderEmail'); ?>
	</div>
	<button type="submit" class="btn btn-success btn-block">Create an account</button>
	<p style="text-align:center;margin-top:7px;">Already have one? <a href="<?php echo site_url('Welcome/index'); ?>">Sign in</a>.</p>
	</form>

    </div> <!-- /container -->

    <script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('public/js/bootstrap.min.js');?>" type="text/javascript"></script>
  </body>
</html>

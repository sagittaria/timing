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
	<script>

	</script>
    </head>
  <body>
    
    <?php echo form_open('Welcome/verifying','id="loginForm" name="loginForm"'); ?>
		<input type="text" name="builderUsername" value="<?php echo set_value('builderUsername'); ?>" >kasoya<br>
		<input type="password" name="builderPassword" >123456<br>
		<input type="submit"  value="Login"> or <a href="<?=site_url('Welcome/register')?>"> register</a>
	</form>


    <script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('public/js/bootstrap.min.js');?>" type="text/javascript"></script>
  </body>
</html>
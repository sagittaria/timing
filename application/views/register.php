<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css');?>" />

	<script>

	</script>
  </head>
  <body>

    <?php echo form_open('Welcome/register','id="regForm" name="regForm"'); ?>
	<input type="text" name="builderUsername" value="<?php echo set_value('builderUsername'); ?>" >
		<?php echo form_error('builderUsername'); ?><br>
	<input type="password" name="builderPassword" >
		<?php echo form_error('builderPassword'); ?><br>
	<input type="text" name="builderEmail" value="<?php echo set_value('builderEmail'); ?>" >
		<?php echo form_error('builderEmail'); ?><br>
	<input type="submit" value="Sign Up">
	</form>
	
    <script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('public/js/bootstrap.min.js');?>" type="text/javascript"></script>

  </body>
</html>

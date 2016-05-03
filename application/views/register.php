<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/reset.css');?>" />
	<style type="text/css">

	</style>	
</head>
<body>

<?php echo form_open('Welcome/register'); ?>
	<input type="text" name="builderUsername" value="<?php echo set_value('builderUsername'); ?>"/>
	<input type="password" name="builderPassword" />
	<input type="text" name="builderEmail" value="<?php echo set_value('builderEmail'); ?>"/>
	<input type="submit" value="Sign Up"/>
</form>
<?php echo validation_errors(); ?>

</body>
</html>
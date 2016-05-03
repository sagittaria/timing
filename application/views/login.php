<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/reset.css');?>" />
	<style type="text/css">

	</style>
</head>
<body>

	<?php echo form_open('Welcome/verifying'); ?>
		<input type="text" name="builderUsername"/>
		<input type="password" name="builderPassword"/>
		<input type="submit" value="Login"/> or register<a href="register"> here&nbsp;</a>
	</form>
</body>
</html>
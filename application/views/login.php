<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('public/jquery.validate.js');?>" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/reset.css');?>" />
	<style type="text/css">

	</style>
	<script>
		$.validator.setDefaults({
			submitHandler: function() {
				document.form.submit();
				//alert('submitted');
			}
		});
		$().ready(function() {
			// validate the comment form when it is submitted
			$("#loginForm").validate();
		});
	</script>
</head>
<body>

	<?php echo form_open('Welcome/verifying','id="loginForm"'); ?>
		<input type="text" name="builderUsername" value="<?php echo set_value('builderUsername'); ?>" minlength='5' required/><br>
		<input type="password" name="builderPassword" required/><br>
		<input type="submit" class="submit" value="Login"/> or <a href="register"> register</a> ?
	</form>
</body>
</html>
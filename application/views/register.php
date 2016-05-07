<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sign Up</title>
	<script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('public/jquery.validate.js');?>" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/reset.css');?>" />
	<style type="text/css">
		#regFrom p{
			display:inline;
		}
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
			$("#regFrom").validate();
		});
	</script>
</head>
<body>

<?php echo form_open('Welcome/register','id="regFrom"'); ?>
	<input type="text" name="builderUsername" value="<?php echo set_value('builderUsername'); ?>" minlength="5"  required />
		<?php echo form_error('builderUsername'); ?><br>
	<input type="password" name="builderPassword" minlength="6" required />
		<?php echo form_error('builderPassword'); ?><br>
	<input type="text" name="builderEmail" value="<?php echo set_value('builderEmail'); ?>" class="email" required />
		<?php echo form_error('builderEmail'); ?><br>
	<input type="submit" class="submit" value="Sign Up"/>
</form>


</body>
</html>
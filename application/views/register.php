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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/HeaderAndFooterForWelcome.css');?>" />    
	<script>

	</script>
    </head>
  <body>
    <div class="blog-masthead">
      <div class="container" >
        <nav class="blog-nav">
          <span class="blog-nav-item brandIcon">Timing, tic tac toc</span>
          <a class="blog-nav-item" href="<?php echo site_url('Cuser/index');?>">Home</a>
          <a class="blog-nav-item" href="<?php echo site_url('Cuser/addBlock');?>">New Block</a>
          <a class="blog-nav-item" href="<?php echo site_url('Welcome/manual');?>">Manual</a>
        </nav>
      </div>
    </div>
  <div style="clear:both;height:35px;"></div>
  <div class="container"><!--《/div》在footer里-->
  
    <div class="container">    
    <?php echo form_open('Welcome/register','id="regForm" name="regForm" class="form-sign"'); ?>
	<h4 class="form-sign-heading" style="text-align:center;">Sign up for Timing</h4>
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

	<div class="alert alert-danger" style="display:none;"></div>

	<a class="btn btn-success btn-block" onclick="signup()">Create an account</a>
	<p style="text-align:center;margin-top:7px;">Already have one? <a href="<?php echo site_url('Welcome/index'); ?>">Sign in</a>.</p>
	</form>

    </div> <!-- /container -->

      <script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
      <script src="<?php echo base_url('public/js/bootstrap.min.js');?>" type="text/javascript"></script>
      <script>
	  function signup(){
		if(jsvalidate()){
		  $('#regForm').submit();
		}else{
		  return;
		}
	  }
	  function warn(msg){
		$('.alert').hide();
		$('.alert').html(msg).show();
	  }
	  function jsvalidate(){
		var username = $('[name=builderUsername]').val().trim() || '';
    		var password = $('[name=builderPassword]').val() || '';
		var email = $('[name=builderEmail]').val();

		if(username.length === 0){ warn('Username field required.');return false; }
		if(username.length < 5){ warn('Username too short.');return false; }
		if(password.length < 6){ warn('Password at least 6 chars.');return false; }
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    		if(!re.test(email)){ warn('invalid Email address.'); return false;}

		return true;
		
	  }
      </script>


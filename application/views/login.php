<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in</title>
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/sign.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/HeaderAndFooterForWelcome.css');?>" />
	<script>

	</script>
    </head>
  <body>
      <div class="blog-masthead">
      <div class="container" style="text-align:center;">
        <nav class="blog-nav">
          <span class="blog-nav-item brandIcon">Timing, tic tac toc</span>
          <a class="blog-nav-item" href="<?php echo site_url('Cuser/index');?>">Home</a>
          <a class="blog-nav-item" href="<?php echo site_url('Cuser/addBlock');?>">New Block</a>
          <a class="blog-nav-item" href="<?php echo site_url('Welcome/manual');?>">Manual</a>
          <a class="blog-nav-item pull-right" href="<?php echo site_url('Cuser/index');?>"><span class="glyphicon glyphicon-log-in"></span> Login</a>
          <span class="blog-nav-item pull-right brandIcon" style="font-weight:normal;">Hi, there! </span>
        </nav>
      </div>
    </div>
  <div style="clear:both;height:35px;"></div>
  <div class="container"><!--《/div》在footer里-->
  
    <div class="container">
    <?php echo form_open('Welcome/verifying','id="loginForm" name="loginForm" class="form-sign"'); ?>
		<h4 class="form-sign-heading" style="text-align:center;">Sign in to Timing</h4>
		<input type="text" name="builderUsername" value="<?php if(isset($cookieUsername)){echo htmlspecialchars($cookieUsername);} ?><?php echo set_value('builderUsername'); ?>" class="form-control sign-in" placeholder="Username" required autofocus>
		<input type="password" name="builderPassword" class="form-control sign-in" placeholder="Password" required>
		<a class="btn btn-primary btn-block" id="submitBtn" onclick="signin()">Continue</a>
		<p style="text-align:center;margin-top:7px;">New to Timing? <a href="<?php echo site_url('Welcome/register'); ?>">Create an account</a>.</p>
		<p style="text-align:center;margin-top:7px;">Or take a look at the <a href="<?php echo site_url('Welcome/manual');?>">Manual</a> first?</p>
		<div class="alert alert-danger" style="display:none;"></div>
    <div class="alert alert-success" style="display:none;"></div>
	</form>

    </div> <!-- /container -->

    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
      $("#loginForm").keydown(function(e){
        var e = e || event,
        keycode = e.which || e.keyCode;
        if (keycode==13) {
          $("#submitBtn").trigger("click");
        }
      });
      
	    function signin(){
		    var username=$('[name=builderUsername]').val().trim() || '';
		    var password=$('[name=builderPassword]').val() || '';
		    if(username.length < 5 || password.length < 6){ 
			    $('.alert').hide();
			    $('.alert-danger').html('Incorrect username or password.').show();
			    return;
		    }else{
			    $('.alert').hide();
			    //$('#loginForm').submit(); #replaced by AJAX-style
          $.ajax({
            type:'post',
            url:"<?php echo site_url('Welcome/verifying'); ?>",
            data:{builderUsername:username,builderPassword:password},
            success:function(response,status,xhr){
     			    if(response=='1'){
                $('.alert-success').html('Signing in...').show();
                setTimeout('location.href="<?php echo site_url("Cuser/index"); ?>"',500);
              }else if(response=='0'){
                $('.alert-danger').html('Incorrect username or password.').show();
              }else{
                alert('something went wrong!');
              }
		        }
          })
		    }
	    }
    </script>

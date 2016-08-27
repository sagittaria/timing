<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Timing</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/HeaderAndFooterForWelcome.css');?>" />
	<script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
	<style>
	
	</style>
  <script>
    $(document).ready(function(){
        $(".blog-nav-item").each(function(){
            $this = $(this);  
            if($this[0].href==String(window.location)){  
                $this.addClass("active");  
            }  
        });  
    });
  </script>
  </head>
  <body>

    <div class="blog-masthead">
      <div class="container">
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
<?php
  require 'Parsedown.php';
  $docFile = fopen("manual.md","r") or die('User guide is missing...');
  $manual = fread($docFile,filesize("manual.md"));
  fclose($docFile);

  $parser = new Parsedown();
  echo $parser->text($manual);
  
?>
</div>


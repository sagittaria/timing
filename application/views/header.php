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
	<link href="<?php echo base_url();?>public/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script src="<?php echo base_url('public/jquery.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('public/echarts.min.js');?>"></script>
	<style>
	  html {
      position: relative;
      min-height: 100%;
    }
    
    /*
     * Masthead for nav
     */

    .blog-masthead {
      background-color: #428bca;
      -webkit-box-shadow: inset 0 -2px 5px rgba(0,0,0,.1);
              box-shadow: inset 0 -2px 5px rgba(0,0,0,.1);
    }

    /* Nav links */
    .blog-nav-item {
      position: relative;
      display: inline-block;
      padding: 10px;
      font-weight: 500;
      color: #cdddeb;
    }
    .blog-nav-item:hover,
    .blog-nav-item:focus {
      color: #fff;
      text-decoration: none;
    }

    /* Active state gets a caret at the bottom */
    .blog-nav .active {
      color: #fff;
    }
    .blog-nav .active:after {
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 0;
      margin-left: -5px;
      vertical-align: middle;
      content: " ";
      border-right: 5px solid transparent;
      border-bottom: 5px solid;
      border-left: 5px solid transparent;
    }
    .brandIcon, .brandIcon:hover, .brandIcon:focus{
      font-weight:bold;
      text-decoration: none;
      color: #fff;
    }
    
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here 
      height: 60px;
      background-color: #f5f5f5;*/
    }

    body {
      /* Margin bottom by footer height */
      margin-bottom: 60px;
    }
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
          <a class="blog-nav-item" href="#">Manual</a>
          <a class="blog-nav-item pull-right" href="<?php echo site_url('Cuser/logout');?>">Quit <span class="glyphicon glyphicon-log-out"></span></a>
          <span class="blog-nav-item pull-right brandIcon" style="font-weight:normal;">Signed in as <span class="brandIcon"><?php echo $_SESSION['name'];?></span>, </span>
        </nav>
      </div>
    </div>

  <div class="container"><!--《/div》在footer里-->


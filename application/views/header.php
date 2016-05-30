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
  </head>
  <body>
  <span style="float:left"><?php echo $_SESSION['name'];?></span><a href='<?php echo site_url('Cuser/logout');?>' style="float:right;">Logout</a>
  <div style="clear:both;"></div>
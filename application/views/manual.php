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
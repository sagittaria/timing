<?php
	if(!$bricks){
		echo "No bricks here, redirecting to <a href='".site_url('Cuser/index')."'>home</a> in 1 Sec...";
		echo "<script>setTimeout('window.location.href=\"".site_url('Cuser/index')."\"',1000)</script>";
	}else{
?>
  <div class="container">

 		<div class="row">
      <div class="col-xs-3 col-sm-5 col-md-5 col-lg-5"><span class="h2"><?php echo $tips; ?></span></div>
      <div class="col-xs-9 col-sm-3 col-md-3 col-lg-3">
		  <form method="post" class="form-inline" action="<?php echo site_url('Cuser/showMoreBricks').'/'.$blockIdInFilter.'/0'; ?>">
		  <div class="form-group"><input type="text" name="filterDate" id="filterDate" class="form-control" style="border-radius:3px;"></div>
		  <script> $(function () {	$('#filterDate').datetimepicker({viewMode:'days', maxDate:moment().format('YYYY/MM/DD'), format:'YYYY/MM/DD'});	});	</script>
		  <button type="submit" class="btn btn-default">Filter</button><span class="h6"> (Leave it blank and press Filter to view all)</span></form>
      </div>
		</div><!--row-->
	
	  <div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		    <table class="table table-striped table-bordered">
		    <tr class='success'><th style="width:7%">#</th><th style="width:25%">start</th><th style="width:20%">duration, min.</th><th style="width:40%">content</th><th>Ops</th></tr>
			    <?php $cnt=0; foreach($bricks as $brick){ ?>
				    <tr><td><?php /*echo $brick['brickId'];*/ echo ++$cnt;  ?></td>
					    <td><?php echo date('Y/m/d H:i',$brick['brickStart']); ?></td>
					    <td><?php echo $brick['brickDuration']; ?></td>
					    <td><?php echo $brick['brickContent']; ?></td>
					    <td><button class="btn btn-default btn-xs" onclick="if(confirm('Are you sure?')){deleteThisBrick(<?php echo $brick['brickId']; ?>)}">Del</button></td></tr>
			    <?php } ?>
		    </table>
	    </div>
	    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		    one more chart
	    </div>
	  </div><!--row-->
	
	<script>
		function deleteThisBrick(brickId){
			$.ajax({//异步删brick
				type:'post',
				url:'../../deleteBrick',
				data:{brickId:brickId},
				success:function(response,status,xhr){
					if(response==1){alert('succeed');location.reload();}
				}
			})
		}
	</script>

	<?php } ?>

    <div class="row">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
      <?php echo $pagination; ?>
      </div>
    </div>

  </div><!--container-->

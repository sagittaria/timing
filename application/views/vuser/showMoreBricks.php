<?php
	if(!$bricks){
		echo "No bricks here.";
	}else{
?>
		<div class="input-group">
		<form method="post"><input type="text" name="filterDate" id="filterDate">
		<script> $(function () {	$('#filterDate').datetimepicker({viewMode:'days', maxDate:moment().format('YYYY/MM/DD'), format:'YYYY/MM/DD'});	});	</script>
		<input type="submit" value="Filter"> Tips: Leave it blank and press Filter to view all</form>
		</div>

	<div class="container">
	  <div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<span style="float:right;"><?php echo $tips; ?></span>
		<table class="table table-striped table-bordered">
		<tr class='success'><th style="width:7%">#</th><th style="width:25%">start</th><th style="width:20%">duration, min.</th><th style="width:40%">content</th><th>OPs</th></tr>
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
	</div><!--container-->
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

<table></table>
<?php
	echo $pagination;
?>

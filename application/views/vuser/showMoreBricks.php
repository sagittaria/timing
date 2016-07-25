<?php
	if(!$bricks){
		echo "No bricks here.";
	}else{
?>
		<div class="input-group">
		<form method="post"><input type="text" name="filterDate" id="filterDate">
		<script> $(function () {	$('#filterDate').datetimepicker({viewMode:'days',maxDate:new Date()-2,format:'YYYY/MM/DD'});	});	</script>
		<input type="submit" value="Filter"><?=$tips; ?></form>
		</div>
	<table class="table table-striped table-bordered">
	<tr class='success'><th>#</th><th>start</th><th>duration</th><th>content</th><th>OPs</th></tr>
		<?php foreach($bricks as $brick){ ?>
			<tr><td><?=$brick['brickId']; ?></td>
				<td><?=date('Y/m/d h:i',$brick['brickStart']); ?></td>
				<td><?=$brick['brickDuration']; ?></td>
				<td><?=$brick['brickContent']; ?></td>
				<td><button class="btn btn-default" onclick="if(confirm('Are you sure?')){deleteThisBrick(<?=$brick['brickId']; ?>)}">Del</button></td></tr>
		<?php } ?>
	</table>
		
	<script>
		function deleteThisBrick(brickId){
			$.ajax({//异步删brick
				type:'post',
				url:'<?php echo site_url('CUser/deleteBrick'); ?>',
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
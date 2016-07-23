<?php
	if(!$bricks){
		echo "No bricks here.";
	}else{
?>
	<table class="table table-striped table-bordered">
	<tr class='success'><th>#</th><th>start</th><th>duration</th><th>content</th></tr>
		<?php foreach($bricks as $brick){ ?>
			<tr><td><?=$brick['brickId']; ?></td><td><?=$brick['brickStart']; ?></td><td><?=$brick['brickDuration']; ?></td><td><?=$brick['brickContent']; ?></td></tr>
		<?php } ?>
	</table>

	<?php } ?>

<table></table>
<?php
	echo $pagination;
?>
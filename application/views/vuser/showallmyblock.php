<table border="1" style="width:100%;">
<tr><th>blockId</th><th>name</th><th>description</th><th>foundation</th><th>status</th><th>onwerid</th><th>op1</th><th>op2</th><th>op3</th></tr>
<?php foreach($blocks as $block){ 
	if($block['blockStatus']==3){continue;}//不显示status=3（隐藏）的block?>
	<tr><td><?= $block['blockId']; ?></td>
		<td><?= $block['blockName']; ?></td>
		<td><?= $block['blockDescription']; ?></td>
		<td><?= $block['blockFoundation']; ?></td>
		<td><?= $block['blockStatus']; ?></td>
		<td><?= $block['builderId']; ?></td>
		<td><a onclick="blockUpdate(<?php echo $block['blockId']; ?>)">update</a></td>
		<td><a onclick="blockBuild(<?php echo $block['blockId']; ?>)">build</a></td>
		<td><a onclick="ajaxBlockDelete(<?php echo $block['blockId']; ?>)">delete</a></td>
	</tr><?php } ?>
</table>
<script>
function blockUpdate(BlockID){
	
}

function blockBuild(BlockID){
	
}

function ajaxBlockDelete(BlockID){
	$.ajax({//异步删block
		type:'post',
		url:'deleteBlock',
		data:{blockId:BlockID},
		success:function(response,status,xhr){
 			if(response==1){alert('succeed');location.reload();}
		}
	})
}
</script>
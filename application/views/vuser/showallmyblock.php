<table border="1">
<tr><th>blockId</th><th>name</th><th>description</th><th>foundation</th><th>status</th><th>onwerid</th></tr>
<?php foreach($blocks as $block){?>
	<tr><td><?= $block['blockId']; ?></td>
		<td><?= $block['blockName']; ?></td>
		<td><?= $block['blockDescription']; ?></td>
		<td><?= $block['blockFoundation']; ?></td>
		<td><?= $block['blockStatus']; ?></td>
		<td><?= $block['builderId'];} ?></td></tr>
</table>
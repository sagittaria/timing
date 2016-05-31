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
		<td><button onclick="blockUpdate(<?php echo $block['blockId']; ?>)">update</button></td>
		<td><button onclick="blockBuild(<?php echo $block['blockId']; ?>)">build</button></td>
		<td><button onclick="ajaxBlockDelete(<?php echo $block['blockId']; ?>)">delete</button></td>
	</tr><?php } ?>
</table>
<div class= "modal" id ="myModal" data-backdrop="static" data-keyboard="false" >
     <div class="modal-dialog">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span ></button>
                    <h4 class= "modal-title">lay a brick</h4>
               </div>
               <div class= "modal-body">
                    <p>here is the content</p >
               </div>
               <div class= "modal-footer">
                    <button class= "btn btn-default">add</button>
                    <button class= "btn btn-info">reset</button>
               </div>
           </div>
     </div >
  </div >

<script>
function blockUpdate(BlockID){
	
}

function blockBuild(BlockID){
	alert(BlockID);
	$('#myModal').modal('show');
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
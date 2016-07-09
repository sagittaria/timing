<table border="1" style="width:100%;">
<tr><th>blockId</th><th>name</th><th>description</th><th>foundation</th><th>status</th><th>onwerid</th><th>op1</th><th>op2</th><th>op3</th><th>op4</th></tr>
<?php foreach($blocks as $block){ 
	if($block['blockStatus']==3){continue;}//不显示status=3（隐藏）的block?>
	<tr><td><?= $block['blockId']; ?></td>
		<td><?= $block['blockName']; ?></td>
		<td><?= $block['blockDescription']; ?></td>
		<td><?= $block['blockFoundation']; ?></td>
		<td><?= $block['blockStatus']; ?></td>
		<td><?= $block['builderId']; ?></td>
		<td><button onclick="blockCheck(<?php echo $block['blockId']; ?>)">check</button></td>
		<td><button onclick="blockUpdate(<?php echo $block['blockId'].",'".$block['blockName']."','".$block['blockDescription']."',".$block['blockStatus']; ?>)">update</button></td>
		<td><button onclick="blockBuild(<?php echo $block['blockId']; ?>)">build</button></td>
		<td><button onclick="BlockDelete(<?php echo $block['blockId'].',\''.$block['blockName'].'\''; ?>)">delete</button></td>
	</tr><?php } ?>
</table>
<div class= "modal" id ="addBrickModal" data-backdrop="static" >
     <div class="modal-dialog">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span ></button>
                    <h4 class= "modal-title">lay a brick</h4>
               </div>
               <div class= "modal-body">
                    <?php echo form_open('Cuser/addBrick','id="newBrickForm" name="newBrickForm"'); ?>
					<input type="text" name="brickStart"/>
					<input type="text" name="brickDuration"/>
					<input type="text" name="brickContent"/>
					<input type="text" name="blockId" id="blockId"/>
					<input type="submit" value="Add a new Brick"/>
					</form>
               </div>
               <div class= "modal-footer">
                    <button class= "btn btn-default">add</button>
                    <button class= "btn btn-info">reset</button>
               </div>
           </div>
     </div >
</div >

<div class= "modal" id ="checkBlockModal" data-backdrop="static" >
     <div class="modal-dialog">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span ></button>
                    <h4 class= "modal-title">check bricks in this block</h4>
               </div>
               <div class= "modal-body">
                    
               </div>
               <div class= "modal-footer">
                    <button class= "btn btn-default">nothing1</button>
                    <button class= "btn btn-success">nothing2</button>
               </div>
           </div>
     </div >
</div >

<div class= "modal" id ="updateBlockModal" data-backdrop="static" >
     <div class="modal-dialog">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span ></button>
                    <h4 class= "modal-title">update this block</h4>
               </div>
               <div class= "modal-body">
                    <?php echo form_open('Cuser/updateBlock','id="updateBlockForm" name="updateBlockForm"'); ?>
					<input type="text" name="blockName" id="blockName"/>
					<input type="text" name="blockDescription" id="blockDescription"/>
					<input type="text" name="blockStatus" id="blockStatus"/>
					<input type="text" name="blockId" id="blockId"/>
	                <input type="submit" value="update block"/>
					</form>
			   </div>
               <div class= "modal-footer">

               </div>
           </div>
     </div >
</div >

<div class= "modal" id ="confirmBlockDeleteModal" data-backdrop="static" >
     <div class="modal-dialog">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span></button>
                    <h4 class= "modal-title">confirm delete this block</h4>
               </div>
               <div class= "modal-body">
               		<span id="nameOfTheBlockToBeDeleted"></span>
                    <input type="text" id="blockName"/>
					<input type="text" name="blockId" id="blockId"/>
					</form>
               </div>
               <div class= "modal-footer">
                    <button id="btnDeleteBlock" class= "btn btn-danger" disabled="disabled" onclick="ajaxBlockDelete($('#confirmBlockDeleteModal #blockId').val());">yes, I want to destroy it.</button>
               </div>
           </div>
     </div >
</div >

<script>
function blockCheck(BlockID){//显示这个block里的brick
	//alert('check: '+BlockID);
	//也准备显示到一个模态框里
	$('#checkBlockModal').modal('show');
}

function blockUpdate(BlockID,BlockName,BlockDescription,BlockStatus){//更新block
	$('#updateBlockForm #blockId').val(BlockID);
	$('#updateBlockForm #blockName').val(BlockName);
	$('#updateBlockForm #blockDescription').val(BlockDescription);
	$('#updateBlockForm #blockStatus').val(BlockStatus);
	$('#updateBlockModal').modal('show');
}

function blockBuild(BlockID){//增加block
	$('#newBrickForm #blockId').val(BlockID);
	$('#addBrickModal').modal('show');
}

function BlockDelete(BlockID,BlockName){//删除block
	$('#nameOfTheBlockToBeDeleted').text(BlockName);
	$('#confirmBlockDeleteModal #blockId').val(BlockID);
	$('#confirmBlockDeleteModal').modal('show');
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
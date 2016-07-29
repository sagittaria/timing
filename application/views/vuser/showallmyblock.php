<table id="tableOfBlocks" border="1" style="width:100%;">
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

<div id="barTypeBlock" class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="height:300px;border:1px solid red;"></div>
<script>
		var chartsData = <?php echo $chartsData;?>;
		var chartsDataX=[];
		var chartsDataY=[];
		for(i=0;i<chartsData.length;i++){
			chartsDataX.push(chartsData[i].BlockName);
			chartsDataY.push(chartsData[i].TotalDuration);
		}
		
        var myChart = echarts.init(document.getElementById('barTypeBlock'));
        var option = {
            title: {
                text: 'Total duration, min.',
				top: 'bottom',
				left: 'center',
            },
            tooltip: {},
            xAxis: {
                data: chartsDataX,
            },
            yAxis: {},
            series: [{
                name: 'total',
                type: 'bar',
                data: chartsDataY,
            }]
        };
        myChart.setOption(option);
</script>
<div id="pieTypeBlock" class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="height:300px;border:1px solid red;"></div>
<script>
		var chartsData = <?php echo $chartsData;?>;
		var chartsDataLengedData=[];
		var chartsDataSeriesData=[];
		for(i=0;i<chartsData.length;i++){
			chartsDataLengedData.push(chartsData[i].BlockName);
			var objNameValue={};
			objNameValue.name=chartsData[i].BlockName;
			objNameValue.value=chartsData[i].TotalDuration;
			chartsDataSeriesData.push(objNameValue);
		}
		
		var myChart = echarts.init(document.getElementById('pieTypeBlock'));
		var option = {
			title: {
                text: 'Block ratio',
				top: 'bottom',
				left: 'center',
            },
			tooltip: {
				trigger: 'item',
				formatter: "{a} <br/>{b}: {c} ({d}%)"
			},
			legend: {
				orient: 'vertical',
				x: 'left',
				y: 'center',
				data:chartsDataLengedData,
			},
			series: [
				{
					name:'ratio',
					type:'pie',
					radius: ['40%', '65%'],
					avoidLabelOverlap: false,
					label: {
						normal: {
							show: false,
							position: 'center'
						},
						emphasis: {
							show: true,
							textStyle: {
								fontSize: '30',
								fontWeight: 'bold'
							}
						}
					},
					labelLine: {
						normal: {
							show: false
						}
					},
					data: chartsDataSeriesData,
				}
			]
		};
        myChart.setOption(option);
</script>
<div id="lineTypeBlock" class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="height:300px;border:1px solid red;"></div>
<script>
		//var chartsData = <?php echo $chartsData; ?> ;
		//var chartsDataSeriesData=[];
		//for(i=0;i<chartsData.length;i++){

		//}
		
		var myChart = echarts.init(document.getElementById('lineTypeBlock'));
		var option ={
				title: {
					text: 'Recent Happenings',
					top:'bottom',
					left:'center',
				},
				tooltip: {
					trigger: 'axis'
				},
				grid: {
					top:'15%',
					left:'1%',
					right: '10%',
					bottom: '13%',
					containLabel: true
				},
				xAxis: {
					type: 'category',
					boundaryGap: false,
					data: ['-7','-6','-5','-4','-3','-2','-1']
				},
				yAxis: {
					type: 'value'
				},
				series: [
					{
						name:'邮件营销',
						type:'line',
						stack: '总量',
						data:[12, 34, 22, 13, 90, 30, 20]
					},
					{
						name:'联盟广告',
						type:'line',
						stack: '总量',
						data:[33, 12, 63, 32, 23, 50, 55]
					},
					{
						name:'视频广告',
						type:'line',
						stack: '总量',
						data:[66, 34, 12, 76, 45, 37, 15]
					},
					{
						name:'直接访问',
						type:'line',
						stack: '总量',
						data:[54, 87, 34, 12, 76, 51, 30]
					},
					{
						name:'搜索引擎',
						type:'line',
						stack: '总量',
						data:[46, 15, 64, 56, 41, 13, 108]
					}
				]
			};

        myChart.setOption(option);
</script>


	

<div class= "modal" id ="addBrickModal" data-backdrop="static" >
     <div class="modal-dialog">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span ></button>
                    <h4 class= "modal-title">Add a new Brick</h4>
               </div>
               <div class= "modal-body">
                    <?php echo form_open('Cuser/addBrick','id="newBrickForm" name="newBrickForm"'); ?>
					<input type="text" name="brickStart" id="brickStart"/>
						<script>
						var today=new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());//为了从前7天的零点开始，只能 var 一个零点的 today
						$(function () {	$('#brickStart').datetimepicker({viewMode:'days', minDate:moment(today).subtract(7,'days').format('YYYY/MM/DD HH:mm'), defaultDate:new Date(), format:'YYYY/MM/DD HH:mm'});	});
						</script>
					<input type="text" name="brickDuration"/>
					<input type="text" name="brickContent"/>
					<input type="text" name="blockId" id="blockId"/>
					<input type="submit" value="lay a brick"/>
					</form>
               </div>
               <div class= "modal-footer">
                    
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
                 <table id="tableOfBricks" class="table table-striped table-bordered">
				 <!-- 将由JS填充此表格 -->
				 </table>
               </div>
               <div class= "modal-footer">
					<input type="text" id="blockIdUsedToShowMoreBricks">
                    <button onclick="window.open('<?php echo site_url('Cuser/showMoreBricks');?>'+'/'+$('#blockIdUsedToShowMoreBricks').val()+'/0')" class= "btn btn-default">More...</button>
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
function blockCheck(intBlockID){//显示这个block里的brick
	$('#blockIdUsedToShowMoreBricks').val(intBlockID);
	$.ajax({
		type:'post',
		url:'<?php echo site_url('CUser/checkBlock'); ?>',
		data:{BlockId:intBlockID},
		success:function(response,status,xhr){
			bricks = JSON.parse(response);
			$('#checkBlockModal .modal-body *').remove();
 			if(bricks.length){
				$('#checkBlockModal .modal-body').append("<table id='tableOfBricks' class='table table-striped table-bordered'><tr class='success'><th>#</th><th>start</th><th>duration, min.</th><th>content</th></tr></table>");
				for(i=0;i<(bricks.length);i++){
					$('#tableOfBricks').append("<tr><td>"+bricks[i].brickId+"</td><td>"+moment.unix(bricks[i].brickStart).format('YYYY/MM/DD HH:mm')+"</td><td>"+bricks[i].brickDuration+"</td><td>"+bricks[i].brickContent+"</td></tr>");
				}
				$('#checkBlockModal').modal('show');
			}else{
				$("#checkBlockModal .modal-body").append("<div class='alert alert-warning'><strong>Void</strong> - No brick found.</div>");
				$('#checkBlockModal').modal('show');
			}
		}
	})	
}

function blockUpdate(BlockID,BlockName,BlockDescription,BlockStatus){//更新block
	$('#updateBlockForm #blockId').val(BlockID);
	$('#updateBlockForm #blockName').val(BlockName);
	$('#updateBlockForm #blockDescription').val(BlockDescription);
	$('#updateBlockForm #blockStatus').val(BlockStatus);
	$('#updateBlockModal').modal('show');
}

function blockBuild(BlockID){//虽然名叫blockBuild，其实是addNewBrick
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
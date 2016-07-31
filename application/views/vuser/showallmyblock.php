<?php if(count($blocks) != 1) { ?>

<table id="tableOfBlocks" border="1" style="width:100%;">
<tr><th>blockId</th><th>name</th><th>description</th><th>foundation</th><th>status</th><th>onwerid</th><th>op1</th><th>op2</th><th>op3</th><th>op4</th></tr>
<?php foreach($blocks as $block){ 
	if($block['blockStatus']==3){continue;}//不显示status=3（隐藏）的block?>
	<tr><td><?php echo  $block['blockId']; ?></td>
		<td><?php echo  $block['blockName']; ?></td>
		<td><?php echo  $block['blockDescription']; ?></td>
		<td><?php echo  $block['blockFoundation']; ?></td>
		<td><?php echo  $block['blockStatus']; ?></td>
		<td><?php echo  $block['builderId']; ?></td>
		<td><button onclick="blockCheck(<?php echo $block['blockId']; ?>)">check</button></td>
		<td><button onclick="blockUpdate(<?php echo $block['blockId'].",'".$block['blockName']."','".$block['blockDescription']."',".$block['blockStatus']; ?>)">update</button></td>
		<td><button onclick="blockBuild(<?php echo $block['blockId']; ?>)">build</button></td>
		<td><button onclick="BlockDelete(<?php echo $block['blockId'].',\''.$block['blockName'].'\''; ?>)">delete</button></td>
	</tr><?php } ?>
</table>

<div id="lineTypeCharts" class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="height:300px;"></div>
<script>
		var xData=[];
		var yData=[];
		var chartsData = <?php echo $chartsDataForLineType;?>;
		//alert(chartsData.length);
		for(i=0;i<30;i++){
			xData.push(i-30);
			if(typeof(chartsData[i])=="undefined"){
				yData.push(0);
			}else{
				yData.push(chartsData[i].brickDuration);
			}			
		}
		yData.reverse();
		//alert(xData.length);
		//alert(yData.length);
		
       var myChart = echarts.init(document.getElementById('lineTypeCharts'));
       option = {
			title: {
				text: 'Base line, min.',
				x:'center',
				y:'bottom',
			},
			tooltip: {
				trigger: 'axis'
			},
			grid: {
				left: '3%',
				right: '4%',
				bottom: '13%',
				containLabel: true
			},
			xAxis: {
				type: 'category',
				boundaryGap: false,
				data: xData
			},
			yAxis: {
				type: 'value'
			},
			series: [
				{
					name:'Last 30 bricks',
					type:'line',
					itemStyle:{
						normal:{
							lineStyle:{
								color:'#ff4dff',
							}
						}
					},
					data:yData
				}
			]
		};
        myChart.setOption(option);
</script>
<div id="barTypeCharts" class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="height:300px;"></div>
<script>
		var chartsData = <?php echo $chartsData;?>;
		var chartsDataX=[];
		var chartsDataY=[];
		for(i=0;i<chartsData.length;i++){
			if(chartsData[i].BlockName=='void') continue;
			chartsDataX.push(chartsData[i].BlockName);
			chartsDataY.push((chartsData[i].TotalDuration/60).toFixed(2));
		}
		
        var myChart = echarts.init(document.getElementById('barTypeCharts'));
        var option = {
            title: {
                text: 'Total duration, hr.',
				top: 'bottom',
				left: 'center',
            },
            tooltip: {},
	    grid:{
		left:45,
		right:'auto',
	    },
            xAxis: {
                data: chartsDataX,
            },
            yAxis: {},
            series: [{
                name: 'total',
                type: 'bar',
                data: chartsDataY,
				itemStyle: {
					normal: {
						color: function(params) {
							// build a color map as needed.
							var colorList = ['#c23531','#2f4554','#61a0a8','#d48265','#91c7ae','#749f83','#ca8622','#bda29a','#6e7074','#546570','#c4ccd3'];
							return colorList[params.dataIndex]
						}
					}
                }
            }]
        };
        myChart.setOption(option);
</script>
<div id="pieTypeCharts" class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="height:300px;"></div>
<script>
		var chartsData = <?php echo $chartsData;?>;
		var chartsDataLengedData=[];
		var chartsDataSeriesData=[];
		for(i=0;i<chartsData.length;i++){
			if(chartsData[i].BlockName=='void') continue;
			chartsDataLengedData.push(chartsData[i].BlockName);
			var objNameValue={};
			objNameValue.name=chartsData[i].BlockName;
			objNameValue.value=chartsData[i].TotalDuration;
			chartsDataSeriesData.push(objNameValue);
		}
		
		var myChart = echarts.init(document.getElementById('pieTypeCharts'));
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
				x: 'right',
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
<div id="lineTypeCharts-2" class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="height:300px;"></div>
<script>
		var myChart = echarts.init(document.getElementById('lineTypeCharts-2'));
		var option ={
				title: {
					text: "Not decided yet...",
					top:'center',
					left:'center',
				},
			};

        myChart.setOption(option);
</script>
<div id="barTypeCharts-2" class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="height:300px;"></div>
<script>
		var chartsData = <?php echo $chartsData;?>;
		var chartsDataX=[];
		var chartsDataY=[];
		var countAll = 0;
		for(i=0;i<chartsData.length;i++){
			chartsDataX.push(chartsData[i].BlockName);
			chartsDataY.push(chartsData[i].TotalDuration);
			countAll = countAll + parseInt(chartsData[i].TotalDuration);
		}
		countAll = countAll - parseInt(chartsDataY[((chartsDataY.length)-1)]);
		chartsDataY[((chartsData.length)-1)] = parseInt(chartsDataY[((chartsData.length)-1)])- countAll;
		if(parseInt(chartsDataY[((chartsData.length)-1)])<0) chartsDataY[((chartsData.length)-1)] = 0;
		for(i=0;i<chartsDataY.length;i++)
			chartsDataY[i] = (chartsDataY[i]/60).toFixed(2);

        var myChart = echarts.init(document.getElementById('barTypeCharts-2'));
        var option = {
            title: {
                text: 'Against void',
				top: 'bottom',
				left: 'center',
            },
            tooltip: {},
	    grid:{
		left:45,
		right:'auto',
	    },
            xAxis: {
                data: chartsDataX,
            },
            yAxis: {},
            series: [{
                name: 'total',
                type: 'bar',
                data: chartsDataY,
				itemStyle: {
					normal: {
						color: function(params) {
							// build a color map as your need.
							var colorList = ['#c23531','#2f4554','#61a0a8','#d48265','#91c7ae','#749f83','#ca8622','#bda29a','#6e7074','#546570','#c4ccd3'];
							return colorList[params.dataIndex]
						}
					}
                }				
            }]
        };
        myChart.setOption(option);
</script>
<div id="pieTypeCharts-2" class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="height:300px;"></div>
<script>
		var chartsData = <?php echo $chartsData;?>;
		var chartsDataLengedData=[];
		var chartsDataSeriesData=[];
		var countAll = 0;
		for(i=0;i<chartsData.length;i++){
			chartsDataLengedData.push(chartsData[i].BlockName);
			var objNameValue={};
			objNameValue.name=chartsData[i].BlockName;
			objNameValue.value=chartsData[i].TotalDuration;
			countAll = countAll + parseInt(chartsData[i].TotalDuration);
			chartsDataSeriesData.push(objNameValue);
		}
		countAll = countAll - parseInt(chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value);
		chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value = parseInt(chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value)- countAll;
		if(parseInt(chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value)<0) chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value = 0;		
		
		var myChart = echarts.init(document.getElementById('pieTypeCharts-2'));
		var option = {
			title: {
                text: 'Struggling',
				top: 'bottom',
				left: 'center',
            },
			tooltip: {
				trigger: 'item',
				formatter: "{a} <br/>{b}: {c} ({d}%)"
			},
			legend: {
				orient: 'vertical',
				x: 'right',
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
<div style="clear:both;"></div><br>
<span style="float:right">Note: Void-block represents the QUANTITY of unrecorded time period since you signed up.</span>

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
		url:'checkBlock',
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

<?php }else{ ?>
	please <a href='<?php echo site_url('Cuser/addBlock');?>'>add a block</a> first.
<?php } ?>

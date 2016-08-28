<?php if(count($blocks) != 1) { ?>
<div class="container">
  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
    <div class="panel panel-info">
      <div class="panel-heading">Overlooking all the Blocks</div>
      <table id="tableOfBlocks" class="table table-striped" >
      <thead><tr><th>Name</th><th>Description</th><th style="width:140px;">Foundation</th><th style="width:65px;">Status</th><th style="width:220px;">Ops</th></tr></thead>
      <tbody>
      <?php $countActive=0; ?>
      <?php  foreach($blocks as $block){ 
	      if($block['blockStatus']==3){continue;}//不显示status=3（隐藏）的block?>
	      <tr>	<td><?php echo  $block['blockName']; ?></td>
		      <td><?php echo  $block['blockDescription']; ?></td>
		      <td><?php echo date('Y/m/d H:i',$block['blockFoundation']); ?></td>
		      <td><?php if($block['blockStatus']==1){ echo 'Sleep';}else{echo 'Active';$countActive++;} ?></td>		
		      <td><button class="btn btn-warning btn-xs" onclick="blockCheck(<?php echo $block['blockId']; ?>)">check</button>
		          <button class="btn btn-success btn-xs" onclick="blockUpdate(<?php echo $block['blockId'].",'".$block['blockName']."','".$block['blockDescription']."',".$block['blockStatus']; ?>)">update</button>
		          <button class="btn btn-info btn-xs" onclick="blockBuild(<?php echo $block['blockId']; ?>)">build</button>
		          <button class="btn btn-danger btn-xs" onclick="BlockDelete(<?php echo $block['blockId'].',\''.$block['blockName'].'\''; ?>)">delete</button></td>
	      </tr><?php } ?>
      </tbody>
      </table>
    </div><!--div class="panel"-->
  </div>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">Profile</div>
      <div class="panel-body"><!-- below <span>s filled when these table or charts are generating-->
      <?php if(count($blocks) <= 2){ ?>
        No need of counting right now.<hr>
        <strong>Note</strong> that some of the charts below may need a few more data to display properly.
      <?php }else{ ?>
        <p><strong># Blocks: </strong><span id="Profile_numberOfBlocks"><?php echo (count($blocks)-1); ?></span> (<span id="Profile_numberOfActiveBlocks"><?php echo $countActive; ?></span> Active).</p>
        <p><strong>Top Block: </strong><span id="Profile_nameOfTopBlock"><!--chart#05--></span>, <span id="Profile_totalDurationOfTopBlock"><!--chart#05--></span> hr.</p>
        <p><strong>Recorded: </strong><span id="Profile_allRecordedTime"><!--chart#06--></span> hr, (<span id="Profile_allRecordedTimeRatio"><!--chart#06--></span>%).</p>
        <p><strong>Bricked_at: </strong><span id="Profile_lastUpdated"><!--chart#01--></span>.</p>
      <?php } ?>
      </div>
    </div>
  </div>
</div><!--div class="container"-->
<div class="container">
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
		
		//fill in <span id="Profile_lastUpdated"><!--chart#01--></span>
		if(yData[29]!=0){
		  $('#Profile_lastUpdated').html(moment.unix(chartsData[0].brickStart).format('YY/MM/DD'));
		}else{
		  $('#Profile_lastUpdated').html('No record');
		}
		
       var myChart = echarts.init(document.getElementById('lineTypeCharts'));
       option = {
      animation: false,
			title: {
				text: '#01 Base line, min.',
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
			if(chartsData[i].BlockStatus==1) continue;
			chartsDataX.push(chartsData[i].BlockName);
			chartsDataY.push((chartsData[i].TotalDuration/60).toFixed(2));
		}
		
        var myChart = echarts.init(document.getElementById('barTypeCharts'));
        var option = {
          animation: false,
            title: {
                text: '#02 Total duration, hr.',
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
			if(chartsData[i].BlockStatus==1) continue;
			chartsDataLengedData.push(chartsData[i].BlockName);
			var objNameValue={};
			objNameValue.name=chartsData[i].BlockName;
			objNameValue.value=chartsData[i].TotalDuration;
			chartsDataSeriesData.push(objNameValue);
		}
		
		var myChart = echarts.init(document.getElementById('pieTypeCharts'));
		var option = {
    		animation: false,
			title: {
                text: '#03 Block ratio',
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
					text: "#04 Not decided",
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
		for(i=0;i<chartsDataY.length;i++){
			chartsDataY[i] = (chartsDataY[i]/60).toFixed(2);
    }
    
    //fill in <span id="Profile_nameOfTopBlock"></span> and <span id="Profile_totalDurationOfTopBlock"></span>
    var indexOfMax=0;
    for(i=1;(i<(chartsDataY.length-1));i++){
      if(chartsDataY[i] >= chartsDataY[indexOfMax]){
        indexOfMax = i;
      }
    }
    $('#Profile_totalDurationOfTopBlock').html(chartsDataY[indexOfMax]);
    $('#Profile_nameOfTopBlock').html(chartsDataX[indexOfMax]);
    
    var myChart = echarts.init(document.getElementById('barTypeCharts-2'));
    var option = {
                    animation: false,
                    title: {
                      text: '#05 Against void',
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
		var sinceRegistration = parseInt(chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value);
		countAll = countAll - parseInt(chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value);
		chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value = parseInt(chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value)- countAll;
		if(parseInt(chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value)<0) chartsDataSeriesData[((chartsDataSeriesData.length)-1)].value = 0;		
		
		//fill in <span id="Profile_allRecordedTime"><!--chart#06--> and <span id="Profile_allRecordedTimeRatio"><!--chart#06-->
		//alert('all reco'+(countAll/60).toFixed(2));
		//alert('since reg'+(sinceRegistration/60).toFixed(2));
		$('#Profile_allRecordedTime').html((countAll/60).toFixed(2));
		$('#Profile_allRecordedTimeRatio').html((countAll/sinceRegistration*100).toFixed(2));		
		
		var myChart = echarts.init(document.getElementById('pieTypeCharts-2'));
		var option = {
   		animation: false,
			title: {
                text: '#06 Struggling',
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
</div><!--div class="container"-->
<div style="clear:both;"></div><br>
<!--<span style="float:right">Note: Void-block represents the QUANTITY of unrecorded time period since you signed up.</span>-->

<div class= "modal" id ="addBrickModal" data-backdrop="static" >
     <div class="modal-dialog modal-sm">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span ></button>
                    <h4 class= "modal-title">Add a new Brick</h4>
               </div>
               <div class= "modal-body">
                    <?php echo form_open('Cuser/addBrick','id="newBrickForm" name="newBrickForm"'); ?>
					          <div class="form-group"><label for="brickStart">Start</label><input type="text" name="brickStart" id="brickStart" class="form-control"/></div>
						          <script>
						          var today=new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());//为了从前7天的零点开始，只能 var 一个零点的 today
						          $(function () {	$('#brickStart').datetimepicker({viewMode:'days', minDate:moment(today).subtract(7,'days').format('YYYY/MM/DD HH:mm'), defaultDate:new Date(), format:'YYYY/MM/DD HH:mm'});	});
						          </script>
					          <div class="form-group"><label for="brickDuration">Duration, min</label><input type="text" name="brickDuration" id="brickDuration" class="form-control"/></div>
					          <div class="form-group"><label for="brickContent">Content</label><input type="text" name="brickContent" id="brickContent" class="form-control"/></div>
					          <input type="hidden" name="blockId" id="blockId"/>
					          <div class="alert alert-danger" id="formInfoAddBrick" style="display:none;"></div>
               </div>
               <div class= "modal-footer">
                    <a class="btn btn-default" data-dismiss="modal"/>Close</a>
					          <a class="btn btn-primary" onclick="validateAddBrick();">lay a brick</a>
					          </form>                    
               </div>
           </div>
     </div >
</div >

<div class= "modal" id ="checkBlockModal" data-backdrop="static" >
     <div class="modal-dialog">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span ></button>
                    <h4 class= "modal-title">Check recent bricks in this block</h4>
               </div>
               <div class= "modal-body">
                 <table id="tableOfBricks" class="table table-striped table-bordered">
				 <!-- 将由JS填充此表格 -->
				 </table>
		</div>
		 <div class="modal-footer">
		    <input type="hidden" id="blockIdUsedToShowMoreBricks">
                    <button onclick="location.href='<?php echo site_url('Cuser/showMoreBricks');?>'+'/'+$('#blockIdUsedToShowMoreBricks').val()+'/0'" class= "btn btn-default" style="width:100%">More...</button>
               </div>
           </div>
     </div >
</div >

<div class= "modal" id ="updateBlockModal" data-backdrop="static" >
     <div class="modal-dialog modal-sm">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span ></button>
                    <h4 class= "modal-title">Update this block</h4>
               </div>
               <div class= "modal-body">
                    <?php echo form_open('Cuser/updateBlock','id="updateBlockForm" name="updateBlockForm"'); ?>
                    <div class="form-group"><label for="blockName">Name</label><input type="text" name="blockName" id="blockName" class="form-control"/></div>
                    <div class="form-group"><label for="blockDescription">Description</label><input type="text" name="blockDescription" id="blockDescription" class="form-control"/></div>
                    <!--<div class="form-group"><label for="blockStatus">Status</label><input type="text" name="blockStatus" id="blockStatus" class="form-control"/></div>-->
                    <div class="form-group">
                        <strong>Status:</strong>&nbsp;&nbsp;
                      <div class="radio-inline">
                        <label style="font-weight:normal"><input type="radio" name="blockStatus" id="activeRadio" value="0"/>Active</label>
                      </div>
                      <div class="radio-inline">
                        <label style="font-weight:normal"><input type="radio" name="blockStatus" id="sleepRadio" value="1"/>Sleep</label>
                      </div>
                    </div>
					            <input type="hidden" name="blockId" id="blockId"/>
					            <div class="alert alert-danger" id="formInfoUpdateBlock" style="display:none;"></div>
			         </div>
               <div class= "modal-footer">
                    <button class="btn btn-default" data-dismiss="modal"/>Close</button>
			              <a class="btn btn-primary" onclick="validateUpdateBlock();"/>Save changes</a>
					          </form>
               </div>
           </div>
     </div >
</div >

<div class= "modal" id ="confirmBlockDeleteModal" data-backdrop="static" >
     <div class="modal-dialog">
           <div class= "modal-content">
               <div class= "modal-header">
                    <button class= "close" data-dismiss="modal" ><span> &times;</span></button>
                    <h4 class= "modal-title">Confirm delete this block</h4>
               </div>
               <div class= "modal-body">
                   <div class="form-group">This action <span class="h4">CANNOT</span> be undone.</div>
               		 <div class="form-group">Please type in the block name <span id="nameOfTheBlockToBeDeleted" class="h4"></span> to confirm.</div>
                   <div class="form-group"><input type="text" id="blockName" class="form-control"/></div>
					<input type="hidden" name="blockId" id="blockId"/>
					</form>
               </div>
               <div class= "modal-footer">
                    <button id="btnDeleteBlock" class= "btn btn-danger" disabled="disabled" onclick="ajaxBlockDelete($('#confirmBlockDeleteModal #blockId').val());">yes, I do want to destroy it</button>
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
				//$('#checkBlockModal .modal-body').append("<table id='tableOfBricks' class='table table-striped table-bordered'><tr class='success'><th>#</th><th>start</th><th>duration, min.</th><th>content</th></tr></table>");
				$('#checkBlockModal .modal-body').append("<table id='tableOfBricks' class='table table-striped table-bordered'><tr class='success'><th style='width:28%'>start</th><th style='width:23%'>duration, min.</th><th>content</th></tr></table>");
				for(i=0;i<(bricks.length);i++){
					//$('#tableOfBricks').append("<tr><td>"+bricks[i].brickId+"</td><td>"+moment.unix(bricks[i].brickStart).format('YYYY/MM/DD HH:mm')+"</td><td>"+bricks[i].brickDuration+"</td><td>"+bricks[i].brickContent+"</td></tr>");
					$('#tableOfBricks').append("<tr><td>"+moment.unix(bricks[i].brickStart).format('YYYY/MM/DD HH:mm')+"</td><td>"+bricks[i].brickDuration+"</td><td>"+bricks[i].brickContent+"</td></tr>");
				}
				$('#checkBlockModal').modal('show');
			}else{
				$("#checkBlockModal .modal-body").append("<div class='alert alert-warning'><strong>No brick found.</strong></div>");
				$('#checkBlockModal').modal('show');
			}
		}
	})	
}

function validateAddBrick(){
  $('.alert').hide();
  var brickDuration = $('#brickDuration').val();
  var brickContent = $('#brickContent').val() || '';
  if(brickDuration.length==0 || brickContent.length==0){
    $('#formInfoAddBrick').html('Both fields are required.').show();
  }else if(!/^\+?[1-9][0-9]*$/.test(brickDuration)){
    $('#formInfoAddBrick').html('The Duration field needs a positive integer').show();
  }else{
    $('#newBrickForm').submit();
  }
}

function validateUpdateBlock(){
  $('.alert').hide();
  var blockName = $('#updateBlockForm #blockName').val().trim() || '';
  var blockDescription = $('#updateBlockForm #blockDescription').val().trim() || '';
  if(blockName.length == 0 || blockDescription.length == 0){
    $('#formInfoUpdateBlock').html('Name and description are required.').show();
		return;
  }else{
    $('#updateBlockForm').submit();
  }
}

function blockUpdate(BlockID,BlockName,BlockDescription,BlockStatus){//更新block
  $('.alert').hide();
	$('#updateBlockForm #blockId').val(BlockID);
	$('#updateBlockForm #blockName').val(BlockName);
	$('#updateBlockForm #blockDescription').val(BlockDescription);
	//$('#updateBlockForm #blockStatus').val(BlockStatus);
	if(BlockStatus===1){
    $('#sleepRadio').prop("checked",true);
	}
	if(BlockStatus===0){
    $('#activeRadio').prop("checked",true);	  
	}
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
  <script>window.location.href="<?php echo site_url('Cuser/addBlock'); ?>"</script>
<?php } ?>

<?php
	if(!$bricks){
		echo "No bricks here, redirecting to <a href='".site_url('Cuser/index')."'>home</a> in 1 Sec...";
		echo "<script>setTimeout('window.location.href=\"".site_url('Cuser/index')."\"',1000)</script>";
	}else{
?>
  <div class="container">

 		<div class="row">
      <div class="col-sm-5"><span class="h3"><?php echo $tips; ?></span></div>
      <div class="col-sm-3">
		  <form method="post" class="form-inline" action="<?php echo site_url('Cuser/showMoreBricks').'/'.$blockIdInFilter.'/0'; ?>">
		  <div class="form-group"><input type="text" name="filterDate" id="filterDate" class="form-control" style="border-radius:3px;"></div>
		  <script> $(function () {	$('#filterDate').datetimepicker({viewMode:'days', maxDate:moment().format('YYYY/MM/DD'), format:'YYYY/MM/DD'});	});	</script>
		  <button type="submit" class="btn btn-default">Filter</button><span class="h6"> (Leave it blank and press Filter to view all)</span></form>
      </div>
		</div><!--row-->
	
	  <div class="row">
	    <div class="col-xs-12 col-sm-8">
		    <table class="table table-striped table-bordered">
		    <tr class='success'><th style="width:7%">#</th><th style="width:25%">start</th><th style="width:20%">duration, min.</th><th style="width:40%">content</th><th>Ops</th></tr>
			    <?php $cnt=0; foreach($bricks as $brick){ ?>
				    <tr><td><?php /*echo $brick['brickId'];*/ echo ++$cnt;  ?></td>
					    <td><?php echo date('Y/m/d H:i',$brick['brickStart']); ?></td>
					    <td><?php echo $brick['brickDuration']; ?></td>
					    <td><?php echo $brick['brickContent']; ?></td>
					    <td><button class="btn btn-default btn-xs" onclick="if(confirm('Are you sure?')){deleteThisBrick(<?php echo $brick['brickId']; ?>)}">Del</button></td></tr>
			    <?php } ?>
		    </table>
	    </div>
	    <div class="col-xs-12 col-sm-4">
	      <div class="panel panel-default">
	        <div class="panel-heading">Duration-Trends of Bricks</div>
          <div id="barTypeCharts" style="height:300px;"></div>
            <script>
		            var chartsData = <?php echo json_encode($bricks);?>;
		            var chartsDataX=[];
		            var chartsDataY=[];
		            for(i=0;i<chartsData.length;i++){
			            chartsDataX.push(0-(i+1));
			            chartsDataY.push(((chartsData[i].brickDuration)/60).toFixed(2));
		            }
		            chartsDataX.reverse();
		            chartsDataY.reverse();
		            
                var myChart = echarts.init(document.getElementById('barTypeCharts'));
                var option = {
                                title: {
                                  text: 'Brick durations, hr.',
                                  top: 'bottom',
                                  left: 'center',
                                },
                                tooltip:{trigger:'item'},
                                grid:{
                                  left:'10%',
                                  right:'3%',
                                  top:'10%',
                                  bottom: '18%',
                                  //containLabel: true
                                },
                                xAxis: {
                                  data: chartsDataX,
                                },
                                yAxis: {},
                                series: [{
                                  name: 'Duration',
                                  type: 'bar',
                                  data: chartsDataY,
                                  itemStyle: {
                                    normal: {
                                    color: function(params) {
                                      // build a color map as needed.
                                      var colorList = ['#99ff99','#00cc00','#006600','#ff9980','#ff3300','#801a00','#99e6ff','#1ac6ff','#0086b3','#ffb3ff','#ff33ff','#990099'];
                                      return colorList[params.dataIndex]
                                      }
                                    }
                                  }
                                },
                                {
                                  name: 'Duration.',
                                  type: 'line',
                                  itemStyle:{
						                        normal:{
							                        lineStyle:{
								                        color:'#ff0000',
							                        }
						                        }
					                        },
                                  data: chartsDataY,                                
                                }]
                              };
                myChart.setOption(option);
            </script>
          </div><!--panel-->  
	    </div><!--col-sm-4-->
	  </div><!--row-->
	
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

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <?php echo $pagination; ?>
      </div>
    </div>

  </div><!--container-->

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">New Block</h3>
  </div>
  <div class="panel-body">
    <div class="well well-sm">Create a new Block to continue, or take a look at the <a href="<?php echo site_url('Cuser/manual');?>">Manual</a> first?</div>
    <?php echo form_open('Cuser/addBlockGo','id="newBlockForm" name="newBlockForm" class="form-horizontal"'); ?>    
    <div class="form-group"><label for="blockName" class="col-sm-2 control-label">Block Name </label><div class="col-sm-6"><input type="text" name="blockName" id="blockName" class="form-control"/></div></div>
    <div class="form-group"><label for="blockDescription" class="col-sm-2 control-label">Description </label><div class="col-sm-6"><input type="text" name="blockDescription" id="blockDescription" class="form-control"/></div></div>
    <div class="form-group"><div class="col-sm-offset-2 col-sm-2"><a class="btn btn-primary form-control" onclick="validateNewBlock();"/>Create</a></div></div>
    <div class="form-group"><div class="alert alert-danger col-sm-offset-2 col-sm-4" id="formInfoNewBlock" style="display:none;"></div></div>
    </form>
  </div>
</div>
<script>
function validateNewBlock(){
  $('.alert').hide();
  var blockName = $('#newBlockForm #blockName').val().trim() || '';
  var blockDescription = $('#newBlockForm #blockDescription').val().trim() || '';
  if(blockName.length == 0 || blockDescription.length == 0){
    $('#formInfoNewBlock').html('Both name and description are required.').show();
		return;
  }else{
    $('#newBlockForm').submit();
  }
}
</script>

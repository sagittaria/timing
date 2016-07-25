<?php
class Mbrick extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
	
    public function MFaddBrickGo(){
    	$data = array(
				
    			'brickStart' 	=> strtotime($this->input->post('brickStart')),
    			'brickDuration' => $this->input->post('brickDuration'),
    			'brickContent' 	=> $this->input->post('brickContent'),
    			'blockId' 		=> $this->input->post('blockId')
    	);
    	
    	return $this->db->insert('brick', $data);
    }
    
	public function MFcheckBlockGo(){
		$BlockId = $this->input->post('BlockId');
		$query = $this->db->select('brickId,brickStart,brickDuration,brickContent')
		->order_by('brickStart desc')
		->where('blockId',$BlockId)
		->get('brick',6);
		return $query->result_array();
	}
	
	public function MFshowMoreBricks($blockId,$per_page,$num){
		//1.检查是不是本人的block
		$query = $this->db->select('builderId')
		->where('blockId',$blockId)
		->get('block',1);
		$check = $query->result_array();
		if($_SESSION['id']!=$check[0]['builderId'])
			return;
		
		//2.处理正事
		$info=array();
		#2.1如果"是过滤"，先看总条数
		if($filterDate=$this->input->post('filterDate')){
			$timeStampUsedToFilter=strtotime($filterDate)+24*60*60;
			$info['total_rows'] = $this->db->where(array('blockId' => $blockId,'brickStart <=' => $timeStampUsedToFilter))->from('brick')->count_all_results();
			if($info['total_rows']>0){#2.1.1判断总条数大于零，才查下去
				$query = $this->db->order_by("brickStart desc")->having('brickStart <=',$timeStampUsedToFilter)->get_where('brick',array('blockId'=>$blockId),$per_page,$num);
				$info['bricks']=$query->result_array(); #2.1.2查per_page条记录
				$info['tips']=' Tips: bricks added before '.$filterDate.'.'; //显示该日及之前添加的brick
				return $info;
			}else{
				$info['tips']=' Tips: no bricks added before '.$filterDate.' , displaying all.'; //过滤结果为空，于是显示全部
			}
		}
		//2.2另两种情况：如果"不是过滤"，或者过滤下来总条数为零
		if(!isset($info['tips'])){$info['tips']='';}
		$query = $this->db->order_by("brickStart desc")->get_where('brick',array('blockId'=>$blockId),$per_page,$num);
		$info['bricks']=$query->result_array();#2.2.1查per_page条记录
		$info['total_rows'] = $this->db->where('blockId',$blockId)->from('brick')->count_all_results();#2.2.2 更新总条数
		return $info;
	}
}

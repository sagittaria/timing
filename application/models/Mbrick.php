<?php
class Mbrick extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
	
    public function MFaddBrickGo(){
    	$data = array(
				
    			'brickStart' 	=> $this->input->post('brickStart'),
    			'brickDuration' => $this->input->post('brickDuration'),
    			'brickContent' 	=> $this->input->post('brickContent'),
    			'blockId' 		=> $this->input->post('blockId')
    	);
    	
    	return $this->db->insert('brick', $data);
    }
    
	public function MFcheckBlockGo(){
		$BlockId = $this->input->post('BlockId');
		$query = $this->db->select('brickId,brickStart,brickDuration,brickContent')
		->order_by('brickId desc')
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
		#2.1查per_page条记录
		$query = $this->db->order_by("brickId desc")->get_where('brick',array('blockId'=>$blockId),$per_page,$num);
		$info['bricks']=$query->result_array();
		#2.2总条数
		$info['total_rows'] = $this->db->where('blockId',$blockId)->from('brick')->count_all_results();
		return $info;
	}
}

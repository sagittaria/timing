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
		->order_by('brickId asc')
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
		$info['bricks']=$query->result_array();
		$info['total_rows']=183;
		return $info;
	}
}

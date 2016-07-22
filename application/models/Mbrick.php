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
		->limit(10)
		->get('brick');
		return $query->result_array();
	}
	
	public function MFshowMoreBricks(){
		return "testString";
	}
}

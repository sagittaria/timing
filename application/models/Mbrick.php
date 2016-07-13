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
    
}

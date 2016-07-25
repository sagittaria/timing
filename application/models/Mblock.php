<?php
class Mblock extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
	
    public function MFaddBlockGo(){
    	$data = array(
    			'blockName' => str_replace('\'','*',$this->input->post('blockName')),
    			'blockDescription' => str_replace('\'','*',$this->input->post('blockDescription')),
    			'blockFoundation' => time(),
    			'blockStatus' => 0,
    			'builderId' => $_SESSION['id']
    	);
    	
    	return $this->db->insert('block', $data);
    }
    
    public function MFdeleteBlockGo(){
    	$blockId = $this->input->post('blockId');
    	return $this->db->delete('block', array('blockId'=>$blockId));
    }
    
    public function MFgetAllMyBlocks(){#读出本用户目前所有block
    	$query = $this->db->select("blockId, blockName, blockDescription, blockFoundation, blockStatus, builderId")
    	->where('builderId', $_SESSION['id'])
    	->get('block');
    	$flag=$query->num_rows();

    	if($flag){#有，返回全部
    		return $query->result_array();
    	}else{#没有，新建个，并返回之
    		$data = array(
    				'blockName' => 'void',
    				'blockDescription' => 'Nothingness',
    				'blockFoundation' => time(),
    				'blockStatus' => 3,
    				'builderId' => $_SESSION['id']
    		);
    		 
    		$this->db->insert('block', $data);
    		return $this->MFgetAllMyBlocks();
    	}
    }
    
    public function MFupdateBlockGo(){#更新Block信息
    	$data = array(
    			'blockName' => str_replace('\'','*',$this->input->post('blockName')),
    			'blockDescription' => str_replace('\'','*',$this->input->post('blockDescription')),
    			'blockStatus' => $this->input->post('blockStatus')
    	);
    	$blockId = $this->input->post('blockId');
    	$this->db->where('blockId',$blockId);
    	return ($this->db->update('block',$data));
    }
}

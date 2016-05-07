<?php
class Mbuilder extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
	
	public function MFregister(){
		$data = array(
               'builderUsername' => $this->input->post('builderUsername'),
               'builderPassword' => md5($this->input->post('builderPassword')),
               'builderEmail' => $this->input->post('builderEmail')
        );
		return $this->db->insert('builder', $data);
	}
	
	public function MFvalidUsername($un){
		$query = $this->db->select('builderUsername')
						  ->where('builderUsername', $un)
						  ->limit(1)
						  ->get('builder');
		$flag=$query->num_rows();
		//如果没有查到，返回FALSE，让控制器里返回TURE
		if(!$flag){
			return FALSE; 
		}else{
			return TRUE;
		}
	}
	
	public function MFvalidEmail($em){
		$query = $this->db->select('builderEmail')
						  ->where('builderEmail', $em)
						  ->limit(1)
						  ->get('builder');
		$flag=$query->num_rows();
		//如果没有查到，返回FALSE，让控制器里返回TURE
		if(!$flag){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function MFverify(){
		#这是登陆时验证用户名密码的方法
		$un = $this->input->post('builderUsername');
		$pw = md5($this->input->post('builderPassword'));
		if($un==''||$pw==''){return FALSE;}		
		$query = $this->db->select("builderUsername,builderEmail")
					->where('builderUsername', $un)
					->where('builderPassword', $pw)
					->limit(1)
					->get('builder');
		$flag=$query->num_rows();
		
		if($flag){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
}

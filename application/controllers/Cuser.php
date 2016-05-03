<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuser extends CI_Controller {

	#需要个初始化方法 init(){}
	
	public function index(){
		#用户首页，显示各 block 的状态和累积时长
		$this->load->view('vuser/showblocks');
	}
	
	public function addBlock(){
		#增加block的界面
		$this->load->view('vuser/addblock');
	}
	
}

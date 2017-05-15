<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hoardings extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	$this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		$data['hoardings']['new'] = $this->get_data_model->get_hoardings_details(0,0);
		$data['hoardings']['active'] = $this->get_data_model->get_hoardings_details(0,1);
		$data['hoardings']['blocked'] = $this->get_data_model->get_hoardings_details(0,2);
		
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/hoardings/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}

	function add() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/hoardings/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}

	function edit() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/hoardings/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}
}
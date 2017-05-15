<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Radio extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		$data['radios']['new'] = $this->get_data_model->get_radio_details(0,0);
		$data['radios']['active'] = $this->get_data_model->get_radio_details(0,1);
		$data['radios']['blocked'] = $this->get_data_model->get_radio_details(	0,2);
		
		if ($this->form_validation->run() == FALSE) {		
			$this->layouts->view('owner/radios/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}

	function add() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$this->_add_set_rules();
		$data = array();
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/radios/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
			$data = $this->input->post();
			$inputs_array = array('radio_station_name' => $data['radio_name'], 
								  'radio_station_desc' => $data['radio_desc'],
								  'radio_station_city' => $data['city_name'], //Fix 
								  'created_by' => 1, //Fix 
								  'owner_id' => 1//Fix 
								  );
			$inserted_id = $this->save_update_model->save_radio($inputs_array);
			if($inserted_id) {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'owner/malls/add','refresh');
			}
			else {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'owner/malls/add','refresh');
			}
		}
	}

	function edit() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/radios/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}
	function _add_set_rules() {
		$this->form_validation->set_rules('radio_name', 'Radio Channel Name', 'trim|min_length[3]|xss_clean|required');
		/*
		$this->form_validation->set_rules('layout_img', 'radio Image', 'required|trim|min_length[3]|xss_clean|_verify_uploading_file_and_upload');*/

		/*if (!empty($_FILES['layout_img']['name'])) {
		    $this->form_validation->set_rules('userfile', 'radio Image', 'required|_verify_uploading_file_and_upload');
		}*/
	}
}
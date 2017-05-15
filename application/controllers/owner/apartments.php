<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apartments extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		$data = array();
		
		$data['apartments']['new'] = $this->get_data_model->get_apartment_details(0,0);
		$data['apartments']['active'] = $this->get_data_model->get_apartment_details(0,1);
		$data['apartments']['blocked'] = $this->get_data_model->get_apartment_details(0,2);

		if($this->form_validation->run() == FALSE) {
			$this->layouts->view('owner/apartments/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
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
			$this->layouts->view('owner/apartments/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}
		else {
			//Save and redirect..
			$data = $this->input->post();
			$inputs_array = array('a_name' => $data['apartment_name'], 
									  'a_desc' => $data['apartment_desc'],
									  'a_location' => $data['map_lat'].", ".$data['map_lang'],
									  'a_image' => $this->filedata['file_name'],
									  'a_cityname' => $data['apartment_loc'], //Fix 
									  'created_by' => 1, //Fix 
									  'owner_id' => 1//Fix 
									  );
			$inserted_apartment_id = $this->save_update_model->save_apartment($inputs_array);
			if($inserted_apartment_id) {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'owner/apartments/add','refresh');			
			}
			else {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'owner/apartments/add','refresh');
			}
			
		}
	}

	function edit($apartment_id = 0) {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($apartment_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}
		else {
			$this->_edit_set_rules();
			$data['apartment_id'] = $apartment_id;
			$data['posted_data'] = $this->input->post();
			$data['apartment_details'] = $this->get_data_model->get_apartment_details($apartment_id,0);

			if ($this->form_validation->run() == FALSE) {
				$this->layouts->view('owner/apartments/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
				//Save and redirect..
				$inputs_array = array('a_name' => $data['posted_data']['apartment_name'], 
									  'a_desc' => $data['posted_data']['apartment_desc'],
									  'a_location' => $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
									  'a_image' => $data['posted_data']['apartment_img'],
									  'a_cityname' => $data['posted_data']['apartment_loc'], //Fix 
									  'created_by' => 1, //Fix 
									  'owner_id' => 1,
									  'a_id' => $apartment_id //Fix 
									  );
				$is_update_successful = $this->save_update_model->update_apartment($inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', "Apartment Details updated successfully");
					$full_url = redirect_dashboard_url('owner');
					redirect($full_url,'refresh');
				}
				else {
					echo "False";
				}
			}
		}
	}

	function _add_set_rules() {
		$this->form_validation->set_rules('apartment_name', 'Apartment Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('userfile', 'Apartment Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
/*
		if (!empty($_FILES['apartment_img']['name'])) {
		    $this->form_validation->set_rules('apartment_img', 'Apartment Image', 'required|callback__verify_uploading_file_and_upload');
		}*/
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('apartment_name', 'Apartment Name', 'trim|required|min_length[3]|xss_clean');
	}

	function _verify_uploading_file_and_upload() {		
		$config['upload_path'] =  '/home/sjkurani/Public/digi/mbasketCI/assets/uploads/apartments';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '10240';
		$config['max_height']  = '7680';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->form_validation->set_message('_verify_uploading_file_and_upload', $err);
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->filedata = $data['upload_data'];
			return true;
		}
	}
}
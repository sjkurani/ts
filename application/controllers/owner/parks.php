<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Parks extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		$data['parks']['new'] = $this->get_data_model->get_park_details(0,0);
		$data['parks']['active'] = $this->get_data_model->get_park_details(0,1);
		$data['parks']['blocked'] = $this->get_data_model->get_park_details(0,2);
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/parks/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
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
			$this->layouts->view('owner/parks/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
			$data = $this->input->post();
			$inputs_array = array('park_name' => $data['park_name'], 
									  'park_desc' => $data['park_desc'],
									  'park_location' => $data['map_lat'].", ".$data['map_lang'],
									  'park_image' => $data['park_img'],
									  'park_cityname' => $data['park_loc'], //Fix 
									  'created_by' => 1, //Fix 
									  'owner_id' => 1//Fix 
									  );
			$inserted_id = $this->save_update_model->save_park($inputs_array);
			if($inserted_id) {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'owner/parks/add','refresh');			
			}
			else {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'owner/parks/add','refresh');
			}			
		}
	}

	function edit($park_id = 0) {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($park_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}
		else {
			$this->_edit_set_rules();
			$data['park_id'] = $park_id;
			$data['posted_data'] = $this->input->post();
			$data['park_details'] = $this->get_data_model->get_park_details($park_id,0);
			if ($this->form_validation->run() == FALSE) {
				$this->layouts->view('owner/parks/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
				//Save and redirect..
				$inputs_array = array('park_name' => $data['posted_data']['park_name'], 
									  'park_desc' => $data['posted_data']['park_desc'],
									  'park_location' => $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
									  'park_image' => $data['posted_data']['park_name'],
									  'park_cityname' => $data['posted_data']['park_loc'], //Fix 
									  'created_by' => 1, //Fix 
									  'owner_id' => 1,
									  'park_id' => $park_id //Fix 
									  );
				$is_update_successful = $this->save_update_model->update_parks($inputs_array);
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
		$this->form_validation->set_rules('park_name', 'Business Park Name', 'trim|min_length[3]|xss_clean|required');
		/*
		$this->form_validation->set_rules('layout_img', 'Apartment Image', 'required|trim|min_length[3]|xss_clean|_verify_uploading_file_and_upload');*/

		/*if (!empty($_FILES['layout_img']['name'])) {
		    $this->form_validation->set_rules('userfile', 'Apartment Image', 'required|_verify_uploading_file_and_upload');
		}*/
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('park_name', 'Park Name', 'trim|required|min_length[3]|xss_clean');
	}
}
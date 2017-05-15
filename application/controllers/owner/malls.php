<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Malls extends CI_Controller {
	
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
		$data['malls']['new'] = $this->get_data_model->get_mall_details(0,0);
		$data['malls']['active'] = $this->get_data_model->get_mall_details(0,1);
		$data['malls']['blocked'] = $this->get_data_model->get_mall_details(	0,2);
		
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/malls/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {

		}
	}

	function add() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$this->_add_set_rules();
		$data = array();
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/malls/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
			$data = $this->input->post();
			$inputs_array = array('mall_name' => $data['mall_name'], 
								  'mall_desc' => $data['mall_desc'],
								  'mall_location' => $data['map_lat'].", ".$data['map_lang'],
								  'img_name' => $data['mall_name'],
								  'city_name' => $data['mall_loc'], //Fix 
								  'created_by' => 1, //Fix 
								  'owner_id' => 1//Fix 
								  );
			$inserted_id = $this->save_update_model->save_malls($inputs_array);
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

	function edit($mall_id = 0) {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($mall_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}
		else {
			$this->_edit_set_rules();
			$data['mall_id'] = $mall_id;
			$data['posted_data'] = $this->input->post();
			$data['mall_details'] = $this->get_data_model->get_mall_details($mall_id,0);

			if ($this->form_validation->run() == FALSE) {
				$this->layouts->view('owner/malls/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
				//Save and redirect..
				$inputs_array = array('mall_name' => $data['posted_data']['mall_name'], 
									  'mall_desc' => $data['posted_data']['mall_desc'],
									  'mall_location' => $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
									  'img_name' => $data['posted_data']['mall_name'],
									  'city_name' => $data['posted_data']['mall_loc'], //Fix 
									  'created_by' => 1, //Fix 
									  'owner_id' => 1,//Fix 
									  'mall_id' => $mall_id 
									  );
				$is_update_successful = $this->save_update_model->update_mall($inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', "mall Details updated successfully");
					$full_url = redirect_dashboard_url('owner/dashboard');
					redirect($full_url,'refresh');
				}
				else {
					echo "False";
				}
			}
		}
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('mall_name', 'mall Name', 'trim|required|min_length[3]|xss_clean');
	}

	function _add_set_rules() {
		$this->form_validation->set_rules('mall_name', 'Mall Name', 'trim|min_length[3]|xss_clean|required');
		/*
		$this->form_validation->set_rules('layout_img', 'mall Image', 'required|trim|min_length[3]|xss_clean|_verify_uploading_file_and_upload');*/

		/*if (!empty($_FILES['layout_img']['name'])) {
		    $this->form_validation->set_rules('userfile', 'mall Image', 'required|_verify_uploading_file_and_upload');
		}*/
	}
}
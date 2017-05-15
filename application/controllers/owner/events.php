<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		$data['events']['new'] = $this->get_data_model->get_event_details(0,0);
		$data['events']['active'] = $this->get_data_model->get_event_details(0,1);
		$data['events']['blocked'] = $this->get_data_model->get_event_details(	0,2);
		
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/events/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
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
			$this->layouts->view('owner/events/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
			$data = $this->input->post();
			$event_start_date_time = explode("-",$this->input->post('start_date'));
			$event_end_date_time = explode("-",$this->input->post('end_date'));

			$start_time = date("H:i:s", strtotime($event_start_date_time[1]));
			$end_time = date("H:i:s", strtotime($event_end_date_time[1]));

			$start_date = date("Y-m-d", strtotime($event_start_date_time[0]));
			$end_date = date("Y-m-d", strtotime($event_end_date_time[0]));

			$full_start = $start_date." ".$start_time;
			$full_end = $end_date." ".$end_time;

			$inputs_array = array('event_name' => $data['eve_title'], 
								  'event_desc' => $data['eve_desc'],
								  'event_location' => $data['map_lat'].", ".$data['map_lang'],
								  //'park_image' => $data['park_img'],
								  'start_date' => $full_start,
								  'end_date' => $full_end,
								  'terms_condn' => $data['term_condn'],
								  'event_type' => $data['eve_type'], //Fix 
								  'created_by' => 1, //Fix 
								  'owner_id' => 1//Fix 
								  );
			$inserted_id = $this->save_update_model->save_event($inputs_array);
			if($inserted_id) {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'owner/events/add','refresh');			
			}
			else {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'owner/events/add','refresh');
			}
		}
	}


	function edit($event_id = 0) {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($event_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}
		else {
			$this->_edit_set_rules();
			$data['event_id'] = $event_id;
			$data['posted_data'] = $this->input->post();
			$data['event_details'] = $this->get_data_model->get_event_details($event_id,0);

			if ($this->form_validation->run() == FALSE) {
				$this->layouts->view('owner/events/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
					//Save and redirect..

					$event_start_date_time = explode("-",$data['posted_data']['start_date']);
					$event_end_date_time = explode("-",$data['posted_data']['end_date']);

					$start_time = date("H:i:s", strtotime($event_start_date_time[1]));
					$end_time = date("H:i:s", strtotime($event_end_date_time[1]));

					$start_date = date("Y-m-d", strtotime($event_start_date_time[0]));
					$end_date = date("Y-m-d", strtotime($event_end_date_time[0]));

					$full_start = $start_date." ".$start_time;
					$full_end = $end_date." ".$end_time;

					$inputs_array = array('event_name' => $data['posted_data']['eve_title'], 
								  'event_desc' => $data['posted_data']['eve_desc'],
								  'event_location' => $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
								  //'park_image' => $data['park_img'],
								  'start_date' => $full_start,
								  'end_date' => $full_end,
								  'terms_condn' => $data['posted_data']['term_condn'],
								  'event_type' => $data['posted_data']['eve_type'], //Fix 
								  'created_by' => 1, //Fix 
								  'owner_id' => 1,//Fix 
								  'event_id' => $event_id
								  );
				$is_update_successful = $this->save_update_model->update_events($inputs_array);
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
		$this->form_validation->set_rules('eve_title', 'Event Title', 'trim|min_length[3]|xss_clean|required');
		/*
		$this->form_validation->set_rules('layout_img', 'Apartment Image', 'required|trim|min_length[3]|xss_clean|_verify_uploading_file_and_upload');*/

		/*if (!empty($_FILES['layout_img']['name'])) {
		    $this->form_validation->set_rules('userfile', 'Apartment Image', 'required|_verify_uploading_file_and_upload');
		}*/
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('eve_title', 'Event Title', 'trim|required|min_length[3]|xss_clean');
	}
}
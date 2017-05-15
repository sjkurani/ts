<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ads_categories extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		//List of existing categories with media types.
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		if ($this->form_validation->run() == FALSE) {
			$this->layouts->view('admin/ads_categories/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}
	function add() {
		//add new ad category.
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');

		$this->_add_set_rules();
		$data = array();
		if ($this->form_validation->run() == FALSE) {
			$this->layouts->view('admin/ads_categories/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {			
			//Save and redirect..
			$inputs_array = array('ads_category_name' => $this->input->post('ad_cat_title'),
								'ads_media_type' => $this->input->post('ad_cat_media_type'));
			$inserted_id = $this->save_update_model->save_ads_category_details($inputs_array);
			if($inserted_id) {
				$this->session->set_flashdata('msg', "New Ads category created successfully.");
				redirect(base_url().'admin/','refresh');			
			}
			else {
				$this->session->set_flashdata('errormsg', "Something went wrong please contact administator.");
				redirect(base_url().'admin/','refresh');
			}
		}
	}
	function edit() {
		//edit existing ad category.
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		if ($this->form_validation->run() == FALSE) {
			$this->layouts->view('admin/ads_categories/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}

	function _add_set_rules() {
		$this->form_validation->set_rules('ad_cat_title', 'Ad category Title', 'trim|min_length[3]|xss_clean|required');
/*
		if (!empty($_FILES['apartment_img']['name'])) {
		    $this->form_validation->set_rules('apartment_img', 'Apartment Image', 'required|callback__verify_uploading_file_and_upload');
		}*/
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('apartment_name', 'Apartment Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('userfile', 'Apartment Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
/*
		if (!empty($_FILES['apartment_img']['name'])) {
		    $this->form_validation->set_rules('apartment_img', 'Apartment Image', 'required|callback__verify_uploading_file_and_upload');
		}*/
	}
}
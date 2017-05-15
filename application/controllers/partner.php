<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Partner extends CI_Controller {
	
	public function __construct()
	{
    parent::__construct();
    $this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
	}

	function index() {

	}
	function attach(){
		$data = array();
		$data['vehicle_names'] = $this->get_data_model->get_vehicle_models_names();
		$this->layouts->view('partner/attach_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
	}
} 
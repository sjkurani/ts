<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Book4us');
		$this->layouts->set_description('Book4us');
		$data = array();
		if ($this->form_validation->run() == FALSE) {

			$this->layouts->view('home/home_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);			
		}
		else {
			$this->layouts->view('search/search_local_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}
	}
	function search($form_name = 0) {
		$this->layouts->set_title('Book4us');
		$this->layouts->set_description('Book4us');
		$data = array();
		$data['posted_data'] = $this->input->post();
			$data['posted_data']['local_full_pickup_loc'] = "";
			$data['lat'] = 12.91;
			$data['lng'] = 77.60;

			$this->layouts->view('search/search_local_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}

	function malls($mall_id) {
		if($mall_id == 1) {
			$data['data']['mall_name'] = 'Orion mall';
			$data['data']['mall_id'] = 1;
			$data['data']['desc'] = "This is mall description about orion mall";

		}
		else if ($mall_id == 2) {
			$data['data']['mall_name'] = 'Mantri squre';
			$data['data']['mall_id'] = 2;
			$data['data']['desc'] = "This is mall description about Mantri squre mall";


		}
		else if ($mall_id == 3) {
			$data['data']['mall_name'] = 'Forum mall';
			$data['data']['mall_id'] = 3;
			$data['data']['desc'] = "This is mall description about Forum mall";


		}
		else if ($mall_id == 4) {
			$data['data']['mall_name'] = 'Central mall';
			$data['data']['mall_id'] = 4;
			$data['data']['desc'] = "This is mall description about Central mall";


		}
		$this->layouts->view('malls/malls_details_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}
} 
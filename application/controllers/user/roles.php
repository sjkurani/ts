<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Roles extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('get_data_model');
	    $this->load->model('save_update_model');
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		redirect('user/account/signin','refresh');
	}
	function owner() {
		echo "string";
	}
	function owner() {
		echo "string";
	}
	function owner() {
		echo "string";
	}
}


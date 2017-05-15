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
	function user() {
		$data = array();
		$this->layouts->view('roles/user_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
	}
	function buyer() {
		$data = array();
		$this->layouts->view('roles/buyer_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
	}
	function owner() {
		$data = array();
		$this->layouts->view('roles/owner_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
	}
	function admin() {
		$data = array();
		$this->layouts->view('roles/admin_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
	}
}


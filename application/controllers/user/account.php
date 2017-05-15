<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends CI_Controller {
	
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

	/*
	*register new account, encrypt password, send activation link to the provided email.
	*//*
	function signup() {
		$this->layouts->set_title('Orgbitor Account');
		$this->layouts->set_description('Signup to stay updated of exhibitions,exhibition organizers, exhibitors of exhibitions near by you and your city');
		$data =array();
		$is_logged_in = $this->session->userdata('logged_in');
		if($is_logged_in == 1) {
			redirect("trip/mytrips/".$this->session->userdata('user_id'),'refresh');
		}
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__custom_email_unique|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]');
		if ($this->form_validation->run() == FALSE) {
			$this->layouts->view('account/signup_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
		}
		else {
    		$user_array = array();
			$user_array['fullname'] = $this->input->post('fullname');
			$user_email_array = explode('@', $this->input->post('email'));
			$user_array['username'] = $user_email_array[0];
			$user_array['email'] = $this->input->post('email');
			$user_array['mobile'] = $this->input->post('mobile');
			$user_array['nickname'] = $this->encrypt->encode($this->input->post('password'));
			$returned_val = $this->save_update_model->save_signup_details($user_array);
			if($returned_val) {
				$user_array_log = json_encode(array($user_array));
        		log_message('error',  "INFO: Signed Up New User".$user_array_log);
				$rand_number = mt_rand(100000,999999);
				$log_array = array('user_id' => $returned_val, 'user_email' => $user_array['email'],'token_value' => $rand_number);
				$send_activation_link = $this->save_update_model->save_activation_log($log_array);
				$href = base_url().'account/token?email='.$this->input->post('email').'&token_id='.$rand_number;

				$sub = 'Registration verification for Orgbitor';
				$href = base_url().'user/account/token?email='.$this->input->post('email').'&token_id='.$rand_number;

				$text = get_mail_content($href,"registration");
				$result = send_grid_mails($user_array,$sub,$text);
				$json_response = json_decode($result);
				if($json_response->message != 'success') {
					$data['err_msg'] = "Sending Email Failed please contact us to signup on info@book4us.in";
				}
				else {
					$data['msg'] = "We have sent activation link to provided email id please activate account and login";					
				}
				$this->layouts->view('account/signin_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
			}
			else {
				$data['err_msg'] = "Something Went Wrong Please try again";
				$this->layouts->view('account/signup_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
			}
		}
	}*/
	
	function signup() {
		$data = array();

		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->layouts->view('account/signup_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);

		}
		else {
			//save and redirect..
			$data = $this->input->post();
			if($data['submit'] == 'user') {
				$user_array = array('username' => $data['username'],
									'email' => $data['user_email'],
									'mobile' => 0,
									'flag' => 1,
									'user_type' => 'user',
									'nickname' => $this->encrypt->encode($data['user_pass']));

				$id = $this->save_update_model->save_user_details($user_array);
				$this->session->set_flashdata('msg', 'User registered successfully please login with the credentials.');
				redirect('user/account/signin','refresh');			
			}
			else if($data['submit'] == 'buyer') {
				$user_array = array('username' => $data['buy_name'],
									'email' => $data['buy_email'],
									'mobile' => $data['buy_phone'],
									'flag' => 1,
									'user_type' => 'buyer',
									'nickname' => $this->encrypt->encode($data['user_pass']));
				$id = $this->save_update_model->save_user_details($user_array);
				$this->session->set_flashdata('msg', 'Buyer registered successfully please login with the credentials.');
				redirect('user/account/signin','refresh');			
			}
			else if($data['submit'] == 'owner') {
				$user_array = array('username' => $data['own_name'],
									'email' => $data['own_email'],
									'mobile' => $data['own_phone'],
									'flag' => 1,
									'service_type' => $data['service'],
									'user_type' => 'owner',
									'nickname' => $this->encrypt->encode($data['own_pass']));
				$id = $this->save_update_model->save_user_details($user_array);
				$this->session->set_flashdata('msg', 'Owner registered successfully please login with the credentials.');
				redirect('user/account/signin','refresh');			
			}
		}
	}
	/*
	 * if account activated and password matches then set session variables.
	 */
	function signin() {
		$this->layouts->set_title('Orgbitor Account');
		$this->layouts->set_description('Signin to stay updated of exhibitions,exhibition organizers, exhibitors of exhibitions near by you and your city.');
		$data = array();
		$is_logged_in = $this->session->userdata('logged_in');
		if($is_logged_in == 1) {
			redirect(base_url().'owner/'.$this->session->userdata('user_id'));			
		}
		else {
			$this->form_validation->set_rules('email_mobile', ' Email / Mobile', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('verify_both', 'Verify Login', 'callback__verify_login');
			if ($this->form_validation->run() == FALSE)
			{
				$this->layouts->view('account/signin_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
			}
			else
			{
				$signin_username = $this->input->post('email_mobile');
				$signin_password = $this->input->post('password');
				$valid_fields = $this->get_data_model->get_valid_user($signin_username);
					$sessiondata = array(
						'user_id' => (int)$valid_fields['user_id'],
						'user_email' =>  $valid_fields['email'],
						'user_mobile' =>  $valid_fields['mobile'],
						'user_name' =>  $valid_fields['username'],
						'user_type' => $valid_fields['user_type'],
						'logged_in' => TRUE
					);
				$this->session->set_userdata($sessiondata);
				print_r($this->session->all_userdata());
				$this->session->set_flashdata('msg', 'Login successful. You logged in as '.$valid_fields['user_type']);
				redirect(base_url().'roles/'.$valid_fields['user_type']);
			}
		}
	}
	/*
	* User General settings,additional email,change password,notifications settings.
	*/
	function settings() {
		$this->layouts->set_title('Orgbitor Settings');
		$this->layouts->set_description('Personalize your exhibitions');
		$data = array();
		$is_logged_in = $this->session->userdata('logged_in');
		if($is_logged_in){
			$data['sess_user_id'] = $this->session->userdata('user_id');

			$this->form_validation->set_rules('old_pass', 'Old password', 'trim|required|xss_clean|callback__verify_old_pass');
			$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('cnfrm_pass', 'Confirm password', 'trim|required|matches[new_pass]|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->layouts->view('account_settings_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
			}
			else
			{
				//Update password
				$updatable_array = array();
				$updatable_array['user_id'] = $data['sess_user_id'];
				$updatable_array['nickname'] = $this->encrypt->encode($this->input->post('new_pass'));

				$returned_val = $this->save_update_model->update_password($updatable_array);
				if($returned_val) {
	       		log_message('error',  "INFO: Password updated".$updatable_array['user_id']);
					$data['msg'] = "Successfully Updated the password";
					$this->layouts->view('account_settings_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
				}
				else {
					$data['err_msg'] = "Something Went Wrong Please try again";
					$this->layouts->view('account_settings_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);

				}
			}
		}
		else {
			$this->session->set_flashdata('errormsg', 'You need to login.');
			$this->session->set_flashdata('redirectToCurrent', current_url());
			redirect('user/account/signin','refresh');			
		}
	}


	/*
	*
	* Send password to registered email and allow user to login with that password.
	*
	*/
	function forgot() {
		$this->layouts->set_title('Orgbitor Account');
		$this->layouts->set_description('Reset Password');
		$data =array();
		$this->form_validation->set_rules('forgot_email', 'Signin Email / Mobile', 'trim|required|xss_clean|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->layouts->view('account/forgot_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
		}
		else
		{

			$signin_username = $this->input->post('forgot_email');
			$valid_fields = $this->get_data_model->get_valid_user($signin_username);
			if(!empty($valid_fields) && is_array($valid_fields)) {

			$reset_array = array();
			$reset_array['user_email'] = $this->input->post('forgot_email');
			$reset_array['token_value'] = mt_rand(100000,999999);
			$reset_array['flag'] = 0;
			$return_val = $this->save_update_model->save_password_reset_details($reset_array);
				$href = base_url().'account/reset?email_id='.$return_val['user_email'].'&token_id='.$return_val['token_value'];
				$sub = 'Forgot password for orgbitor';
				$text = "Hi,
								Create your new password 
								<a target='_blank' href=".$href.">Click here</a>

								<br>
								Thanks & Regards, 
								Orgbitor Team";



				
				$result = $this->curl->simple_post('https://api.sendgrid.com/api/mail.send.json', array('api_user'=>'sjkurani', 'api_key'=>'unix1234','to'=>$return_val['user_email'],'fromname'=>'Developer Ogbitor','subject'=> $sub, 'html'=> $text, 'from'=>'developer@orgbitor.com','cc'=>'sjkurani@gmail.com'));

				$this->session->set_flashdata('msg', 'We have sent reset password link to provided email id, reset  password and login');
				redirect(base_url().'user/account/signin','refresh');
			
			}
			else {
				$data['err_msg'] = "Email id not registered with us";
				$this->layouts->view('account/forgot_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
			}
		}
	}

	/*
	* Logout and redirect to home.
	*/
  	function logout() {  		
		$sessiondata = array(
					    'user_id' => '',
					    'user_email' => '',
					    'user_mobile' =>  '',
					    'user_full_name' =>  '',
					    'visitor_profile_id' =>  '',
					    'exhibitor_short_name' =>  '',
					    'exhibitor_profile_id' =>  '',
					    'organizer_short_name' =>  '',
					    'organizer_profile_id' =>  '',
					    'visitor_profile_id' =>  '',
						'logged_in' => ''
				           );
		
	    $this->session->unset_userdata($sessiondata);
	  	redirect('/', 'refresh');	  	
	}

	function _verify_old_pass() {
		$entered_old_pass = $this->input->post('old_pass');
		$user_email = $this->session->userdata('user_email');
		$valid_fields = $this->get_data_model->get_valid_user($user_email);
		if(is_array($valid_fields)) {
			if(isset($valid_fields['nickname'])) {
				$password = $this->encrypt->decode($valid_fields['nickname']);
				if ($password == $entered_old_pass) {
					return true;
				}
				else {
				$this->form_validation->set_message('_verify_old_pass', "Entered Old password is wrong");
				return false;
				}
			}
		}
		else {
			$this->form_validation->set_message('_verify_old_pass', "Entered Old password is wrong");
			return false;		
		}
	}
	function token($token_id = 0) {
		if (isset($_GET['email']) && isset($_GET['token_id']) && isset($_GET['type']) == 'subscribe') {
			$subscribe_token_array = $this->get_data_model->get_subscribe_token_values($_GET['email'], $_GET['token_id']);
			if(!empty($subscribe_token_array) && is_array($subscribe_token_array) && ($subscribe_token_array['flag'] != 1)) {
				$is_flag_updated = $this->save_update_model->update_flag('subscriptions', 1);
				if($is_flag_updated) {
					$this->session->set_flashdata('msg', 'Thanks for confirming your subscription!. To get more notification or alerts you can signup below');
					redirect(base_url().'user/account/signup','refresh');					
				}
			}
			else {
				$this->session->set_flashdata('errormsg', 'Could not able to subscribe. already you may subscribed or token got expired. To get notification or alerts you can signup below.');
				redirect(base_url().'user/account/signup','refresh');
			}
		}
		elseif(isset($_GET['email']) && isset($_GET['token_id'])) { //active link after signup
			$token_user_array = $this->get_data_model->get_token_values($_GET['email'], $_GET['token_id']);
			if(is_array($token_user_array)) {
				if($token_user_array['flag'] == 1) {
					$this->session->set_flashdata('msg', 'Your account already activated. you can login with the credentials');
					redirect(base_url().'user/account/signin','refresh');
				}
				else {
					//update the flag and 
					$token_array = array('email' => $_GET['email'], 'token' => $_GET['token_id']);
					$is_flag_updated = $this->save_update_model->update_activation_log($token_array);
					if($is_flag_updated) {
						$user_array_log = json_encode(array($_GET['email'], $_GET['token_id']));
		        		log_message('error',  "INFO: Account activated".$user_array_log);
						$this->session->set_flashdata('msg', 'Your account activated. you can login with the credentials');
						//fix me auto fill email.
						redirect(base_url().'user/account/signin','refresh');
					}
					else {						
						$this->session->set_flashdata('errormsg', 'Couldnot able to activate your account please try again');
						redirect(base_url().'user/account/signin','refresh');
					}
				}
			}
			else {
				$this->session->set_flashdata('errormsg', 'Email and token values are not matching');
				redirect(base_url().'user/account/signin','refresh');
			}
		}
		else 
		{
			$this->session->set_flashdata('errormsg', 'The url is broken');
			redirect(base_url(),'refresh');
		}
	}
    function _verify_login() {
		$signin_username = $this->input->post('email_mobile');
		$signin_password = $this->input->post('password');
		$valid_fields = $this->get_data_model->get_valid_user($signin_username);
		if(is_array($valid_fields) && !empty($valid_fields)) {
			if(empty($valid_fields['activation_flag']) && empty($valid_fields['nickname'])) {
				$this->form_validation->set_message('_verify_login', "you have signedup using social paltforms, you may signin using social platform or reset password by clicking forgot password for your existing account.");
				return false;
			}
			else if($valid_fields['flag'] == 1) {
				$password = $this->encrypt->decode($valid_fields['nickname']);
				if($password == $signin_password) {
					return true;
				}
				else {
					$this->form_validation->set_message('_verify_login', "The entered email and password doesnot match");
					return false;
				}
			}
			else {
				$this->form_validation->set_message('_verify_login', "We have sent activation link to provided mail id please activate and login");
				return false;
			}
		}
		else {	
			$this->form_validation->set_message('_verify_login', "The enter email / mobile not registed with us. please signup if you are new customer.");
			return false;
		}
	}

	function reset($token_id = 0)  {
		$data = array();
		if(isset($_GET['email_id']) && isset($_GET['token_id'])) {

			$token_user_array = $this->get_data_model->get_reset_token_values($_GET['email_id'], $_GET['token_id']);
			/*print_r($token_user_array);
			exit();*/
			if(is_array($token_user_array) && !empty($token_user_array)) {

				$data['email_id'] = (isset($_GET['email_id']) && !empty($_GET['email_id'])) ? $_GET['email_id'] : '' ;
				$data['token_id'] = (isset($_GET['token_id']) && !empty($_GET['token_id'])) ? $_GET['token_id'] : '';

				$this->form_validation->set_rules('reset_new_pwd', 'New Password', 'trim|required|min_length[6]|xss_clean');
				$this->form_validation->set_rules('match_reset_new_pwd', 'Confirm password', 'trim|required|matches[reset_new_pwd]|xss_clean');

				if ($this->form_validation->run() == FALSE)
				{
					$this->layouts->view('account/password_reset_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
				}
				else
				{
					$password = $this->encrypt->encode($this->input->post('reset_new_pwd'));
					$reset_array  = array('email' => $token_user_array['user_email'],'nickname' => $password);
					$is_updated = $this->save_update_model->update_password($reset_array);
					if ($is_updated) {
						$reset_array_log = json_encode(array($_GET['email_id'], $_GET['token_id']));
        				log_message('error',  "INFO: Password reset done".$reset_array_log);
						$this->session->set_flashdata('msg', 'Password reset done successfully. login with the proper credentials');
						redirect('user/account/signin','refresh');
					}
					else {
						$this->session->set_flashdata('errormsg', 'Something went wrong Couldnot able to reset password');
						redirect(base_url().'user/account/signin','refresh');
					}
				}
			}
			else {
				$this->session->set_flashdata('errormsg', 'Not valid token please try again');
				redirect(base_url().'account/forgot','refresh');
			}
		}
		else 
		{
			redirect(base_url(),'refresh');

		}		
	}

	function _custom_email_unique() {
		//checking whether mobile number and only exist in this users mobile field.
		$entered_email = $this->input->post('email');
		$is_email_id_exist_but_not_active = $this->get_data_model->check_is_email_unique($entered_email);

		if($is_email_id_exist_but_not_active) {
			$this->form_validation->set_message('_custom_email_unique', "User already exist Please try different email.");
			return false;
		}
		else {
			//$this->form_validation->set_message('_custom_email_unique', $this->input->post('email'));
			return true;
		}
	}
}
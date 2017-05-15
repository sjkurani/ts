<?php
/*
	List of global functions.
*/
function LoadCssAndJs($layoutsObj) {
	$layoutsObj->add_includes('assets/js/jquery-1.12.0.min.js')
			  ->add_includes('assets/js/jquery-ui-1.11.4/jquery-ui.min.css')
			  ->add_includes('assets/js/jquery-ui-1.11.4/jquery-ui.min.js')
			  ->add_includes('assets/datepicker/js/bootstrap-datetimepicker.min.js')
			  ->add_includes('assets/css/style.css')
			  ->add_includes('assets/bootstrap-3.3.6-dist/css/bootstrap.min.css')
			  ->add_includes('assets/datepicker/css/bootstrap-datetimepicker.min.css')
			  ->add_includes('assets/font-awesome-4.5.0/css/font-awesome.min.css')
			  ->add_includes('assets/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css')
			  ->add_includes('assets/js/my.js')
			  ->add_includes('assets/bootstrap-3.3.6-dist/js/bootstrap.min.js');
}

function asset_url(){
   return base_url().'assets/';
}

function redirect_dashboard_url($uri) {
	if(!empty($uri)) {
		$full_url = base_url().$uri;
		return $full_url;
	}
	else {
		return base_url();
	}
}

function check_user_authenticity($user_id) {
	$CI = & get_instance();  //get instance, access the CI superobject
	return (($CI->session->userdata('logged_in') == 1) && ($CI->session->userdata('user_id') == $user_id));
}
function send_grid_mails($user_array,$sub,$text) {
	$CI = & get_instance();  //get instance, access the CI superobject
	//return $CI->curl->simple_post('https://api.sendgrid.com/api/mail.send.json', array('api_user'=>'sjkurani', 'api_key'=>'unix1234','to'=>$user_array['email'],'fromname'=>'Developer Ogbitor','subject'=> $sub, 'html'=> $text, 'from'=>'developer@orgbitor.com','cc'=>'sjkurani@gmail.com'));
}
function get_mail_content($href,$type) {
	if($type == 'registration') {

		$img_name = asset_url()."local_image/logos/logo-blue.png";
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>Book4Us</h1>
		        <h3>We make your trip awesome</h3>
		    </div>
		    Hi,
		        Welcome to Orgbitor. Your account has been created successfully.
		        We are working towards creating platform for exhibition industry thanks for your interest.

		        <a target="_blank" href='.$href.'>Activate your Account</a>

		        <br>
		        Thanks & Regards, 
		        Orgbitor Team 

		    <div id="footeqr">
		    <legend>Follow us:</legend>
		    <ul style="display: flex;width:100%;list-style: none;">
		        <li style="width:25%;"><a href="#">Facebook</a></li>
		        <li style="width:25%;"><a href="#">Google Plus</a></li>
		        <li style="width:25%;"><a href="#">Twitter</a></li>
		        <li style="width:25%;"><a href="#">Instagram</a></li>
		    </ul>
		    </div>
		</div>';
		return $mail_string;
	}
}

?>
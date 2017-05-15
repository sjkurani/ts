<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('user/account/signin','id=account_sigin_frm');

if($this->session->flashdata('msg')){ 
        echo ' <div class="alert alert-success row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $this->session->flashdata('msg');
    echo '</b></div>';
}
if($this->session->flashdata('errormsg')){ 
        echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $this->session->flashdata('errormsg'); 
    echo '</b></div>';

}

if(isset($err_msg)){ 
        echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $err_msg; 
    echo '</b></div>';

}
if (isset($msg)) {
        echo ' <div class="alert alert-success row"><b>
        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $msg;
    echo '</b></div>';
}

 if (validation_errors()){
    echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo validation_errors();
    echo '</b></div>';                                 
}
?>

<div class="page-canvas">

  <div class="signin-wrapper" data-login-message="false">
    

<fieldset>

<div class="row">
<h3 class="text-center">Sign in to Media Basket</h3><h4 class="text-center"><span>Using</span></h4>
  <div class="col-md-6">    
    <a class="submit btn btn-facebook pull-left" href="<?php echo base_url().'social/session/facebook';?>"><b>Facebook</b></a>
  </div>
  <div class="col-md-6">    
    <a class="submit btn btn-google pull-right" href="<?php echo base_url().'social/session/google';?>"><b>Google +</b></a>
  </div>
</div>
<div>
<h4 class="text-center"><span>OR</span></h4>
        <label>Email / Mobile</label><i class="redstar">*</i>
        <input class="form-control" type="text" name="email_mobile" value="<?php echo set_value('email_mobile'); ?>" >
    </div>
    <div>
        <label>Password</label><i class="redstar">*</i>
        <input class="form-control" type="password" name="password" value="" >
    </div>
        <input type="hidden" class="verify" name="verify_both"/>

</fieldset>
<div class="clearfix">
 <?php
 if($this->session->userdata('visitor_flag') == 0)
  $redirect_url = 'myprofile/edit';
if(empty($redirect_url))
  $redirect_url = 'exhibitions';
?>
  <input type="hidden" name="redirect_after_login" value="<?php echo $redirect_url;?>">
  <button type="submit" class="submit btn btn-success pull-right">Sign in</button>
  
      <a class="btn btn-info pull-left" href="<?php echo base_url().'user/account/forgot'; ?>">Reset password?</a><br>
      
<div class='pull-right'>
<label class="text-center">Don't have a account yet?
        <a class="forgot pull-center" id="login-signup-link" href="<?php echo base_url().'user/account/signup'; ?>">Sign up now »</a>
</label>
</div>

</div>
</div>
</div>
</form>
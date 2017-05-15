<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('admin/account/signin','id=account_sigin_frm');

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
  <div class="row">
    <h3 class="text-center">Sign in as admin</h3>
    <div>
      <label>Username / Email</label><i class="redstar">*</i>
      <input class="form-control" type="text" name="email_mobile" value="<?php echo set_value('email_mobile'); ?>" >
    </div>

    <div>
        <label>Password</label><i class="redstar">*</i>
        <input class="form-control" type="password" name="password" value="" >
    </div>
        <input type="hidden" class="verify" name="verify_both"/>

<br><button type="submit" class="submit pull-right hoverable_btn">Sign in</button>
  </div>
      
</div>
</div>
</form>
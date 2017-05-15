<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('user/account/signup','id=account_signup_frm');

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
<div class="container">
<div class="row">
<br>
    <legend class="text-center"><label>Admin Dashboard</label> </legend>
    <section class="col-md-4" style="padding: 1%;">
        <a href="#"><label class="jumbotron">Manage Users</label></a>
    </section>
    <section class="col-md-4" style="padding: 1%;">
        <a href="#"><label class="jumbotron">Manage Content</label></a>
    </section>
    <section class="col-md-4" style="padding: 1%;">
        <a href="#"><label class="jumbotron">Manage Malls</label></a>
    </section>
    <section class="col-md-4" style="padding: 1%;">
        <a href="#"><label class="jumbotron">Manage Ads</label></a>
    </section>
    <section class="col-md-4" style="padding: 1%;">
        <a href="#"><label class="jumbotron">Manage Events</label></a>
    </section>
    <section class="col-md-4" style="padding: 1%;">
        <a href="#"><label class="jumbotron">Settings</label></a>
    </section>
</div>

</div>
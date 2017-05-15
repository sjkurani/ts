<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'owner/dashboard';
    echo form_open($full_url);

echo form_open(base_url().'owner/events/add');

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
    <legend>Admin Dashboard</legend>
        <div class="col-md-3">
        <a href="<?php echo base_url().'admin/ads_categories'; ?>">Ads Categories</a>
        </div>
        <div class="col-md-3">
        <a href="<?php echo base_url().'admin/ads'; ?>">Manage Ads</a>
        </div>
        <div class="col-md-3">
        <a href="<?php echo base_url().'admin/reports'; ?>">Manage Users</a>
        </div>
        <div class="col-md-3">
        <a href="<?php echo base_url().'admin/reports'; ?>">Manage Enquiries </a>
        </div>
        <div class="col-md-3">
        <a href="<?php echo base_url().'admin/reports'; ?>">Reports</a>
        </div>
    </div>
</div>
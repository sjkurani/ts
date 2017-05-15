<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('admin/vehicle_models/add','class=frm');

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

<div class="password-reset">
<legend><h3>Add New Vehicle model</h3></legend>
<div>
    <label>Vehicle Brand Name</label><i class="redstar">*</i>
    <input class="form-control" type="text" name="vehicle_brand" value="<?php echo set_value('vehicle_brand'); ?>" >
</div>

<div>
    <label>Vehicle Model Name</label><i class="redstar">*</i>
    <input class="form-control" type="text" name="vehicle_model" value="<?php echo set_value('vehicle_model'); ?>" >
</div>

<div>
    <label>Sitting Capacity</label><i class="redstar">*</i>
    <input class="form-control" type="text" name="vehicle_sitting_capacity" value="<?php echo set_value('vehicle_sitting_capacity'); ?>" >
</div>
<div>
    <div class="event_layout_div">
          <label>Upload Compressed car image<i class="redstar">*</i></label>
          <input type="file" class="form-control" name="vehicle_image">
        </div>
</div>
<div>
    <label>Remarks</label>
    <input class="form-control" type="text" name="vehicle_remarks" value="<?php echo set_value('vehicle_remarks'); ?>" >
    
</div>
<div class="text-right">
    <input type="submit" class="btn btn-info " />
    <a href="./" class="btn btn-warning">Cancel</a>
</div>
</div>
</div>
</form>
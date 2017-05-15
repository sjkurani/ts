<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('partner/attach','class=frm');

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

<div class="password-reset signup-wrapper">
<legend><h3>Attaching YOur Car with Book4us</h3></legend>
<div>

<label>Vehicle Modal</label><i class="redstar">*</i>
    <select class="form-control">
        <?php
        foreach ($vehicle_names as $key => $value) {
            echo "<option>".$value->vm_brand_name." ".$value->vm_model_name."</option>";
        }
        ?>
    </select>
</div>

<div>
    <label>Owner Number</label><i class="redstar">*</i>
    <input class="form-control" type="text" name="vehicle_sitting_capacity" value="<?php echo set_value('vehicle_sitting_capacity'); ?>" >
</div>
<div>
    <label>Owner Name</label>
    <input class="form-control" type="text" name="vehicle_remarks" value="<?php echo set_value('vehicle_remarks'); ?>" >
    
</div>
<div class="text-right">
    <input type="submit" class="btn btn-info " />
    <a href="./" class="btn btn-warning">Cancel</a>
</div>
</div>
</div>
</form>
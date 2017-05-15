<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('categories','class=all_categories');

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

        if(empty($vehicle_models_list)) {
        echo '<div class="container container-table nothing_found">
        <div class="row vertical-center-row">
            <div class="text-center col-md-4 col-md-offset-4" style="margin:10% 30%;">
            <h3>No Vehicle  models Found.</h3>
            </div>
            </div>
         </div>';
        }
        else {
        ?>
     
        <!-- <a href="#" class="tooltips">
        <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
        <span>
        <img class="callout" src="assets/local_image/back_imgs/callout.gif" />
        <strong>Most Light-weight Tooltip</strong><br/>
        This is the easy-to-use Tooltip driven purely by CSS.
        </span>
        </a> -->

        <?php
            echo "<legend><h3>Existing Vehice Models<a href='./vehicle_models/add' class='pull-right btn hoverable_btn'>Add New Vehicle Model</a></h3></legend>";
            echo "<div class='row'>";
            foreach ($vehicle_models_list as $key => $value) {
            ?>
            <div class="col-md-4 col-sm-4">
                <div class="thumbnail">
                <div>
                    <legend class="text-center"><label><? echo strtoupper($value->vm_brand_name." ".$value->vm_model_name); ?></label></legend>
                </div>
                <?php
                    if(!empty($value->vm_image_name)) {
                        $full_img_url = asset_url().'uploads/vehicle_models/'.$value->vm_image_name;
                    }
                    else {
                        $full_img_url = base_url().'assets/local_image/back_imgs/default_category.jpg';
                    }
                   // echo $full_img_url;
                ?>
                <div class="cat_img_div text-center"> <img width="200" src="<?php echo $full_img_url;?>"> </div>
                <legend></legend>
                <div class="text-right">
                    <a class="btn btn-info" href="<? echo base_url().'admin/vehicle_models/edit/'.$value->vm_id;?>">Edit</a>
                    <a class="btn btn-danger" href="<? echo base_url().'admin/vehicle_models/delete/'.$value->vm_id;?>">Delete</a>
                </div>
                </div>
            </div>
            <?php    
            }
        }
?>
</div>
</form>
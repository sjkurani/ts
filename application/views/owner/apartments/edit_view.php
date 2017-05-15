<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'owner/apartments/edit/'.$apartment_id;
    echo form_open($full_url);

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

if(empty($posted_data) && !empty($apartment_details)) {
    //Default set values from db.
    $ap_name = $apartment_details->a_name;
    $ap_desc = $apartment_details->a_desc;
    $ap_loc = explode(",", $apartment_details->a_location);
    $ap_lat = $ap_loc[0];
    $ap_lng = $ap_loc[1];
    $ap_city_name = $apartment_details->a_cityname;
}
else if ($posted_data) {
    //set input values from post request.
    $ap_name = $posted_data['apartment_name'];
    $ap_desc = $posted_data['apartment_desc'];
    $ap_lat = $posted_data['map_lat'];
    $ap_lng = $posted_data['map_lang'];
    $ap_city_name = $posted_data['apartment_loc'];

}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div>
                <label>Apartment Name</label>
                <input name="apartment_name" class="form-control" type="text" value="<?php echo set_value('apartment_name',$ap_name); ?>">
            </div>
            <div>
                <label>Apartment Image</label>
                <input type="file" class="form-control" name="apartment_img" value="<?php echo set_value('apartment_img',$ap_name); ?>">
            </div>
            <div>
                <label>Apartment Description</label>
                <textarea name="apartment_desc" class="form-control" rows="4" cols="50"><?php echo $ap_desc;?></textarea>
            </div>
            <div>
                <label>Apartment Location</label>
                <input name="apartment_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('apartment_loc',$ap_city_name); ?>">
            </div>
            <div id="map"></div>
            <div>
                <input id="map_lat" name="map_lat" class="form-control" type="hidden1" value="<?php echo set_value('map_lat',$ap_lat); ?>">
                <input id="map_lang" name="map_lang" class="form-control" type="hidden1" value="<?php echo set_value('map_lang',$ap_lng); ?>">
            </div>
            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>
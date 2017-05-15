<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'admin/ads_categories/add');

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
            <div class="col-md-3">
                <div>
                    <label>Ad Category Title</label>
                    <input name="ad_cat_title" class="form-control" type="text">
                </div>
                <div>
                    <label>Media Type</label>
                    <select name="ad_cat_media_type" class="form-control">
                        <option>Select Media Type</option>
                        <option value="malls">Malls</option>
                        <option value="events">Events</option>
                        <option value="hoardings">Hoardings</option>
                        <option value="radio">Radio</option>
                        <option value="parks">Business park</option>
                        <option value="apartments">Apartments</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row1">
            <div class="col-md-3">
                <input type="submit" name="form_name" class="btn btn-success">
            </div>
        </div>
    </div>

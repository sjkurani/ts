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
                    <label>Media Type</label>
                    <select name="ad_cat_media_type" class="form-control">
                        <option>Select Media Type</option>
                        <option>Malls</option>
                        <option>Events</option>
                        <option>Hoardings</option>
                        <option>Radio</option>
                        <option>Business park</option>
                        <option>Apartments</option>
                    </select>
                </div>
                <div>
                    <label>Advertisment Category</label> (Dynamic fetch)
                    <select name="ad_cat_media_type" class="form-control">
                        <option>Select Media Type</option>
                        <option>Title sponsor</option>
                    </select>                    
                </div>

                <div>
                    <label>Media listings</label> (if mall then need to show orion , mantri if event upcoming events)
                    <select name="ad_cat_media_type" class="form-control">
                        <option>Select Media Type</option>
                        <option>Title sponsor</option>
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

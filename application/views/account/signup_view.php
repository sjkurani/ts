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
<div class="signup-wrapper">
            <div class="jumbotron main-content">
                <h1 class="text-center">Register </h1>
                
                <div class="nav nav-tabs nav-justified">
                    <ul class="nav nav-tabs nav-justified main-navs" id="navID">
                        <!-- <li class="active" id="media">
                            <a href="#user" data-toggle="tab" aria-expanded="true">
                              User
                            </a>
                        </li> --><li class="" >
                            <a href="#buyer" data-toggle="tab" aria-expanded="true">
                              Buyer
                            </a>
                        </li>
                        <li class="" id="events"><a href="#eventsContent" data-toggle="tab" aria-expanded="false">Owner</a></li>
                        
                    </ul>
                  
                        <div class="panel-body threepanel">
                            <div class="tab-content">

                                <section class="tab-pane fade in active" id="user">
                                    <form id="contact" action="<?php echo base_url().'user/account/signup'; ?>" method="post">

                                        <div class="row">
                                            <!--<form action="search" method="post">-->

                                            <div class="col-md-12">
                                                <br />
                                                <fieldset>
                                                    <label for="type" style="color:black">Name</label>
                                                    <input name="username" placeholder="Your name"  class="form-control" type="text" tabindex="1"   autofocus>
                                                </fieldset>
                                                <fieldset>
                                                    <label for="type" style="color:black">Email / Phone Number</label>
                                                    <input name="user_email" placeholder="Your Email Address"  class="form-control" type="text" tabindex="2"  >
                                                </fieldset>

                                                <fieldset>

                                                    <label for="password" style="color:black">Password</label>
                                                    <br />
                                                    <input name="user_pass" placeholder="Your password..."   class="form-control" type="password" tabindex="4"  >
                                                </fieldset>


                                                <fieldset>
                                            <br><center>
                                                <button class="btn hoverable_btn" name="submit" type="submit" id="contact-submit" color="teal" data-submit="...Sending" value="user">Submit</button>
                                                </center>
                                                </fieldset>



                                            </div>



                                        </div>
                                    </form>
                                </section>

                                <section class="tab-pane fade in" id="buyer">
                                    <form id="contact" action="<?php echo base_url().'user/account/signup'; ?>" method="post">

                                        <div class="row">
                                            <!--<form action="search" method="post">-->

                                            <div class="col-md-12">
                                                <br />
                                                <fieldset>
                                                    <label for="type" style="color:black">Name</label>
                                                    <input name="buy_name" placeholder="Your name"  class="form-control" type="text" tabindex="1"   autofocus>
                                                </fieldset>
                                                <fieldset>
                                                    <label for="type" style="color:black">Email</label>
                                                    <input name="buy_email" placeholder="Your Email Address"  class="form-control" type="text" tabindex="2"  >
                                                </fieldset>
                                                <fieldset>
                                                    <label for="type" style="color:black">Phone Number</label>
                                                    <input name="buy_phone" placeholder="Your Phone Number"  class="form-control" type="tel" tabindex="3"  >
                                                </fieldset>

                                                <fieldset>

                                                    <label for="password" style="color:black">Password</label>
                                                    <br />
                                                    <input name="buy_pass" placeholder="Your password..."   class="form-control" type="password" tabindex="4"  >
                                                </fieldset>


                                                <fieldset>
                                            <br><center>
                                                <button class="btn hoverable_btn" name="submit" type="submit" id="contact-submit" color="teal" data-submit="...Sending" value="buyer">Submit</button>
                                                </center>
                                                </fieldset>



                                            </div>



                                        </div>
                                    </form>
                                </section>
                   

                            <section class="tab-pane fade in" id="eventsContent">
                                <form id="contact" action="<?php echo base_url().'user/account/signup'; ?>" method="post">
                                    <div class="row">
                                       
                                        <div class="col-md-12">

                                            <fieldset>
                                                <label  for="Name" style="color:black" onclick="color:blue">Name</label>
                                                <input name="own_name" placeholder="Your name"  class="form-control" type="text" tabindex="5"   autofocus>
                                            </fieldset>
                                            <fieldset>
                                                <label for="Email" style="color:black">Email</label>
                                                <input name="own_email" placeholder="Your Email Address"  class="form-control" type="text" tabindex="6"  >
                                            </fieldset>
                                                <fieldset>
                                                    <label for="type" style="color:black">Phone Number</label>
                                                    <input name="own_phone" placeholder="Your Phone Number"  class="form-control" type="tel" tabindex="3"  >
                                                </fieldset>

                                            <fieldset>
                                                <label for="password" style="color:black">Password</label><br />
                                                <input name="own_pass" placeholder="Your password"  class="form-control" type="password" tabindex="7"  >
                                            </fieldset>
                                            <!--<fieldset>
                                                <label for="pwd" style="color:black">Password</label>
                                                <input placeholder="Your password" type="password"&nbsp; tabindex="7"  >
                                            </fieldset>-->

                                            <fieldset>
                                                <label for="service" style="color:black">Service Type</label>
                                                <br />
                                                <select id="service" class="form-control"  name="service" tabindex="8"  >
                                                    <option value="business">Business Park</option>
                                                    <option value="radio">Radio</option>

                                                </select>
                                                <br />

                                            </fieldset>
                                            <br />
                                            <fieldset>
                                            <br><center>
                                                <button class="btn hoverable_btn" name="submit" type="submit" value="owner" id="contact-submit" color="teal" data-submit="...Sending">Submit</button>
                                                </center>
                                            </fieldset>




                                        </div>


                                    </div>
                                </form>
                            </section>
                           
                        </div>
                    </div>
                </div>
            </div>
            </div>
</form>
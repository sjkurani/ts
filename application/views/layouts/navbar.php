
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>">
      <label><span class="defaultcolor">Media</span><span>Basket</span></label>
      <!-- <img src="./assets/imgs/googlelogo.png"> --></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="#whatsmediabasket">What is Mediabasket <span class="sr-only">(current)</span></a></li>
        <li><a href="#whymediabasket">Why Mediabasket?</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="tel:1234123412"><i class="fa fa-phone-square fa-2"></i> +91-1234123412</a></li>
        <?php
        if($this->session->userdata('logged_in')) {
          echo '<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.strtoupper($this->session->userdata('user_name')).' <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href='.base_url().'owner/dashboard/>Dashboard</a></li>
            <li><a href='.base_url().'user/account/logout>Logout</a></li>
          </ul>
        </li>';
        }
        else {
          echo '<li><a href='. base_url().'user/account/signin>LOGIN</a></li>';
          echo '<li><a href='. base_url().'user/account/signup>SIGNUP</a></li>';

        }
        ?>
        
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li> -->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
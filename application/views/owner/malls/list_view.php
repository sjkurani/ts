<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
?>
<div class="body container">
<br>
<legend class="text-right"><label><a href="<?php echo base_url().'owner/malls/add'; ?>" class='btn btn-success'>Add New Mall</a></label></legend>
	<div class="nav nav-tabs nav-justified">
	    <ul class="nav nav-tabs  main-navs" id="navID">
	            <li class="active" id="new"><a href="#newPanel" data-toggle="tab" aria-expanded="true">
	            New</a></li>
	            <li class="" id="active"><a href="#actviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
	            <li class=""  id="blocked"><a href="#blockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>
	    </ul>
	    <div class="panel-body threepanel">
	        <div class="tab-content">
	            <section  class="tab-pane fade in active" id="newPanel">
	            	<?php
	            	if(!empty($malls['new'])) {
	            		print_r($malls['new']);
	            	}
	            	else {
	            		echo "No New malls found here.";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($malls['active'])) {
	            		print_r($malls['active']);
	            	}
	            	else {
	            		echo "No Active malls found here.";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="blockedPanel">
	            	<?php
	            	if(!empty($malls['blocked'])) {
	            		print_r($malls['blocked']);
	            	}
	            	else {
	            		echo "No Blocked malls found here.";
	            	}
	            	?>
	            </section>
	        </div>
	    </div>
	</div>
</div>
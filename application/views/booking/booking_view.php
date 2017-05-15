<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$trip_type = explode("@",$posted_data['trip_type']);
?>
<div class="body container">
	<form action="<? echo base_url();?>trip" method="post">
		<div class="row">
				<div class="col-md-3 vehicleDetail well">
					<div class="hidden">
						<input type="text" name="vehicle_model_id"  value="<? echo $posted_data['vehicle_model_id']; ?>" >
						<input type="text" name="trip_source" value="<? echo $booking_data['source'];?>">
						<input type="text" name="trip_destination" value="<? echo $booking_data['destination'];?>">
						<input type="text" name="trip_date_start" value="<? echo $booking_data['trip_date_start'];?>">
						<input type="text" name="trip_date_end" value="<? echo $booking_data['trip_date_end'];?>">
						<input type="text" name="trip_type" value="<? echo $booking_data['trip_type'];?>">
						<input type="text" name="lat" value="<? echo $booking_data['map_lat'];?>">
						<input type="text" name="lng" value="<? echo $booking_data['map_lng'];?>">
					</div>
					<legend class="white-back"><label class="default_font_color">Vehicle Details</label></legend>
					<label class="text-center col-md-12"><? echo strtoupper($vehicle_details->vm_brand_name.' - ' .$vehicle_details->vm_model_name);?></label><br>
					<img class="text-center col-md-12" width="200" src="<?php echo asset_url().'uploads/vehicle_models/'.$vehicle_details->vm_image_name;?>" />
					<legend></legend>
					<legend class="white-back"><label class="default_font_color">Fair Estimation</label></legend>
					<ul>
						<li><label>Base Price</label><span><? echo $booking_data['base_price']." Rs."; ?></span></li>
						<li><label>Service Tax</label><span><? echo $booking_data['service_tax']." Rs."; ?></span></li>
						<li><span>Exclusives: Driver Bata, Toll Fees and parking Fees</span></li>
					</ul>
					<legend class="white-back"><label class="default_font_color">Estimated Fare: <? echo $booking_data['base_price'] + $booking_data['service_tax']; ?>  </legend>
				</div>
				<div class="col-md-9 bookingDetails">
					<div class="col-md-12 well">
						<div class="col-md-6">
							<legend><label>Trip Details</label></legend>
							<ul>
								<li>From : <? echo $booking_data['source'];?></li>
								<?php if($booking_data['destination'] != '-') {
									echo "<li> To : ".$booking_data['destination']."</li>";
								}?>
								<li>Pickup Date And time:  <? echo $booking_data['trip_date_start'] ;?></li>
							</ul>
						</div>
						<div class="col-md-6">
							<legend><label>User Details</label></legend>
							<label class="col-md-12">Name</label>
							<input class="form-control" type="text" name="user_name" value="">
							<label class="col-md-12">Mobile Number</label>
							<input class="form-control" type="text" name="user_mobile" value="" >
							<!-- <input class="form-control" type="text" name="user_mobile" value="" required="" pattern="[789][0-9]{9}"> -->
						</div>
					</div>
					<div class="col-md-12 well">
						<legend>Payment Details</legend>
						<ul>
							<li>
								<label><input type="radio" value="full" checked="" name="payment_type">Pay complete amount and confirm<span></span></label>
							</li>
							<li>
								<label><input type="radio" value="partial" name="payment_type">Pay 10% of fair amount and confirm<span></span></label>
							</li>
							<li>
								<label><input type="radio" value="later" name="payment_type">I will pay later take my request<span></span></label>
							</li>
						</ul>
						<div class="col-md-12">
							<input type="submit" name="confirm_booking" class="btn hoverable_btn" value="Confirm Booking">
							<span>By clicking Confirm Booking you are agree to our <a href=''>terms and conditions.</a></span>
						</div>
					</div>
				</div>
			
		</div>
	</form>
</div>
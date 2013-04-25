<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
if (!empty($_POST["data2"])) {
	$patient = unserialize(base64_decode($_POST["data2"]));
} else {
	$patient = $user;
}
?>

<div class="frame-content" id="frame-16">
	<span class="make-appointment">Make an Appointment for <?php echo $patient->getFname() . " " . $patient->getLname(); ?></span>
	<span class="physician-name"></span>
	<span class="appointment-stage-2">Step 2: Choose a Date</span>
	<span class="appointment-available-date">Available Dates</span>
	<span class="appointment-stage-3">Step 3: Choose a Time</span>
	<span class="appointment-available-time">Available Time</span>
	<form method="post" action="javascript:void(0)" id="makeAppointment2">
		<input type="hidden" id="physician-appointment" name="physician_email" value="" />
		<input type="hidden" id="patient-appointment" name="patient_email" value="<?php echo $patient->getEmail(); ?>" />
		<select class="appointment-dropdown-large-month" name="date_month">
			<?php foreach (array("January", "February", "March", "April", "May", "June", 
				"July", "August", "September", "October", "November", "December") as $key => $month) { ?>
				<option value="<?php echo ($key + 1); ?>"><?php echo $month; ?></option>
			<?php } ?>
		</select>
		<select class="appointment-dropdown-large-day" name="date_day">
			<?php for ($day = 1; $day < 32; $day++) { ?>
				<option value="<?php echo $day; ?>"><?php echo $day; ?></option>
			<?php } ?>
		</select>
		<select class="appointment-dropdown-large-time" name="date_time">
			<option value="9:00 AM">9:00 AM</option>
			<option value="10:30 AM">10:30 AM</option>
			<option value="12:00 PM">12:00 PM</option>
			<option value="1:30 PM">1:30 PM</option>
			<option value="3:00 PM">3:00 PM</option>
		</select>
		<input type="submit" class="appointment-submit" name="appointment_submit" value="Submit" onclick="sendForm('makeAppointment2')" />
	</form>
</div>
<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
if (!empty($_POST["data2"])) {
	$patient = unserialize(base64_decode($_POST["data2"]));
} else {
	$patient = null;
}
?>

<div class="frame-content" id="frame-15">
<?php if ($user->getType() == "patient" || !is_null($patient)) { ?>
	<span class="make-appointment">Make an Appointment</span>
	<span class="appointment-stage">Step 1: Choose a Physician</span>
	<div id="choose-physician">
		<table id="choose-table" cellpadding="0" cellspacing="0">
			<tr class="choose-row-top">
				<td class="choose-detail">
					<span class="choose-detail">Physician</span>
				</td>
			</tr>
			<?php foreach ($_POST as $key => $data) {
				$index = 1;
				if (strpos($key, "data") !== false && get_class(unserialize(base64_decode($data))) == "Doctor") {
					$doctor = unserialize(base64_decode($data)); ?>
					<tr class="choose-row" id="choose-<?php echo $index; ?>" onclick="setPhysician('<?php echo $doctor->getFname() . " " . $doctor->getLname(); ?>', '<?php echo $doctor->getEmail(); ?>')">
						<td class="choose-detail">
							<span class="choose-detail"><?php echo $doctor->getFname() . " " . $doctor->getLname(); ?></span>
						</td>
					</tr>
				<?php }
				$index++;
			} ?>
		</table>
	</div>
<?php } else { ?>
	<span class="patient-not-set">Please select a patient first using the "Find Record" tab.</span>
<?php } ?>
</div>
<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
if (!empty($_POST["data2"])) {
	$patient = unserialize(base64_decode($_POST["data2"]));
} else {
	$patient = null;
}
?>

<div class="frame-content" id="frame-4">
<?php if (!is_null($patient)) { ?>
	<span class="patient-name"><?php echo $patient->getFname() . " " . $patient->getLname(); ?></span>
	<span class="patient-detail">Gender: <?php echo ucfirst($patient->getGender()); ?></span>
	<span class="patient-detail">DOB: <?php echo $patient->getDob(); ?></span>
	<span class="patient-detail">Phone Number: <?php echo $patient->getPhone(); ?></span>
	<span class="patient-detail">Address: <?php echo $patient->getAddress(); ?></span>
	<span class="patient-detail">Email: <?php echo $patient->getEmail(); ?></span>
	<span class="patient-detail">Insured: <?php echo $patient->getInsStatus(); ?></span>
	<span class="patient-detail">Insurance Company: <?php echo $patient->getInsComp(); ?></span>
	<span class="patient-detail">Insurance ID Number: <?php echo $patient->getInsId(); ?></span>
	<span class="patient-detail">Insurance Phone Number: <?php echo $patient->getInsPhone(); ?></span>
	<!-- onclick is placeholder to demonstrate frame -->
	<a class="edit-information" href="javascript:void(0)" onclick="loadPage('editPatientProfile')">Edit Information</a>
<?php } else { ?>
	<span class="patient-not-set">Please select a patient first using the "Find Record" tab.</span>
<?php } ?>
</div>
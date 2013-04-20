<?php
include_once("../model/User.php");
include_once("../model/Record.php");
$user = unserialize(base64_decode($_POST["data1"]));
$patient = unserialize(base64_decode($_POST["data2"]));
$record = unserialize(base64_decode($_POST["data3"]));
?>

<div class="frame-content" id="frame-11">
	<img class="left-arrow" src="images/left-arrow.gif" onclick="changeGraph(-1)">
	<img class="right-arrow" src="images/right-arrow.gif" onclick="changeGraph(1)">
	<div id="graph">
		<img id="graph-image" src="<?php echo "graphs/images/" . substr($patient->getFname(), 0, 1) . substr($patient->getLname(), 0, 1) . "-bloodPres-" . date("m-d-Y", strtotime($record->getDate())) . ".png"; ?>">
	</div>
	<span class="prescription">
		<?php if ($user->getType() == "doctor") { ?>
			Prescription
		<?php } else { ?>
			Physician's Notes
		<?php } ?>
	</span>
	<form method="post" action="javascript:void(0)" id="viewGraph">
		<?php if ($user->getType() == "doctor") { ?>
			<input type="hidden" name="recId" value="<?php echo $record->getRecId(); ?>" />
			<textarea id="prescription-box" name="prescription"><?php echo $record->getPrescription(); ?></textarea>
			<input type="submit" class="prescription-submit" name="prescription_submit" value="Submit" onclick="sendForm('viewGraph')" />
		<?php } else { ?>
			<textarea disabled="disabled" id="prescription-box" name="prescription"><?php echo $record->getPrescription(); ?></textarea>
			<input type="submit" disabled="disabled" class="prescription-submit" name="prescription_submit" value="Submit" />
		<?php } ?>
	</form>
	<?php if (isset($_POST["error"]) && $_POST["error"] == 1) { ?>
		<span class="prescription-error">An error occurred when entering the prescription</span>
	<?php } ?>
</div>
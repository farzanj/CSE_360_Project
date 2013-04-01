<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
if (!empty($_POST["data2"])) {
	$patient = unserialize(base64_decode($_POST["data2"]));
} else {
	$patient = null;
}
?>

<div class="frame-content" id="frame-3">
	<div id="enter-wrap">
		<form method="post" action="javascript:void(0)" id="enterData">
			<table id="enter-table" cellpadding="0" cellspacing="0">
				<?php if (!($user->getType() == "patient")) { ?>
				<tr class="enter-row-patient">
					<td class="enter-detail">
						<span class="enter-detail">Patient's Name</span>
					</td>
					<td class="enter-box">
						<input type="text" class="enterbox" name="patient_name" value="<?php if (!is_null($patient)) { echo $patient->getFname() . " " . $patient->getLname(); } ?>" />
					</td>
				</tr>
				<?php } ?>
				<tr class="enter-row">
					<td class="enter-detail">
						<span class="enter-detail">Blood Pressure</span>
					</td>
					<td class="enter-box">
						<input type="text" class="enterbox" name="blood_pressure" />
						<span class="units">mmHg</span>
					</td>
				</tr>
				<tr class="enter-row">
					<td class="enter-detail">
						<span class="enter-detail">Sugar Level</span>
					</td>
					<td class="enter-box">
						<input type="text" class="enterbox" name="sugar_level" />
						<span class="units">mmol/L</span>
					</td>
				</tr>
				<tr class="enter-row">
					<td class="enter-detail">
						<span class="enter-detail">Weight</span>
					</td>
					<td class="enter-box">
						<input type="text" class="enterbox" name="weight" />
						<span class="units">lbs</span>
					</td>
				</tr>
			</table>
			<?php if ($user->getType() != "patient") { ?>
				<span class="enter-notes">Physician's Notes</span>
			<?php } else { ?>
				<span class="enter-notes">Leave notes for your Physician</span>
			<?php } ?>
			<?php if ($user->getType() != "nurse") { ?>
				<textarea id="enter-notes" name="notes"></textarea>
			<?php } else { ?>
				<textarea disabled="disabled" id="enter-notes" name="notes"></textarea>
			<?php } ?>
			<input type="submit" class="enter-submit" name="enter_submit" value="Submit" onclick="sendForm('enterData')" />
		</form>
		<?php if (isset($_POST["error"]) && $_POST["error"] == 1) { ?>
			<span class="enter-error">An error occurred when entering the data</span>
		<?php } ?>
	</div>
</div>
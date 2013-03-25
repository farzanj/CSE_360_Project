<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
?>

<div class="frame-content" id="frame-3">
	<div id="enter-wrap">
		<form method="post" action="">
			<table id="enter-table" cellpadding="0" cellspacing="0">
				<?php if (!($user->getType() == "patient")) { ?>
				<tr class="enter-row-patient">
					<td class="enter-detail">
						<span class="enter-detail">Patient's Name</span>
					</td>
					<td class="enter-box">
						<input type="text" class="enterbox" name="patient_name" value="" />
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
			<span class="enter-notes">Physician's Notes</span>
			<textarea id="enter-notes"></textarea>
			<input type="submit" class="enter-submit" name="enter_submit" value="Submit" />
		</form>
	</div>
</div>
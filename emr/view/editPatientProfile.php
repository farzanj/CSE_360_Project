<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
$patient = unserialize(base64_decode($_POST["data2"]));
?>

<div class="frame-content" id="frame-12">
	<div id="edit-wrap">
		<form method="post" action="javascript:void(0)" id="editPatientProfile" >
			<table id="edit-table" cellpadding="0" cellspacing="0">
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">First Name</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="first_name" value="<?php echo $patient->getFname(); ?>" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Last Name</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="last_name" value="<?php echo $patient->getLname(); ?>" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Gender</span>
					</td>
					<td class="edit-box">
						<select class="edit-dropdown-small" name="gender">
							<?php if ($patient->getGender() == "male") { ?>
								<option selected="selected" value="male">Male</option>
								<option value="female">Female</option>
							<?php } else { ?>
								<option value="male">Male</option>
								<option selected="selected" value="female">Female</option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">DOB</span>
					</td>
					<td class="edit-box">
						<?php $dob = explode("-", $patient->getDob()); ?>
						<select class="edit-dropdown-medium" name="month">
							<?php foreach (array("January", "February", "March", "April", "May", "June", 
								"July", "August", "September", "October", "November", "December") as $key => $month) {
								if ($dob[0] == ($key + 1)) { 
									echo "<option selected=\"selected\" value=\"" . ($key + 1) . "\">";
								} else {
									echo "<option value=\"" . ($key + 1) . "\">";
								}
								echo $month;
								echo "</option>";
							} ?>
						</select>
						<select class="edit-dropdown-small" name="day">
							<?php for ($day = 1; $day < 32; $day++) {
								if ($dob[1] == $day) {
									echo "<option selected=\"selected\" value=\"" . $day . "\">";
								} else {
									echo "<option value=\"" . $day . "\">";
								}
								echo $day;
								echo "</option>";
							} ?>
						</select>
						<select class="edit-dropdown-small" name="year">
							<?php for ($year = date("Y", strtotime("now")); $year > 1900; $year--) {
								if ($dob[2] == $year) {
									echo "<option selected=\"selected\" value=\"" . $year . "\">";
								} else { 
									echo "<option value=\"" . $year . "\">";
								}
								echo $year;
								echo "</option>";
							} ?>
						</select>
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">E-mail Address</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="email" value="<?php echo $patient->getEmail(); ?>" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Phone Number</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="patient_phone" value="<?php echo $patient->getPhone(); ?>" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Address Line 1</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="address1" value="<?php echo $patient->getAddress(); ?>" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Address Line 2</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="address2" value="" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">City</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="city" value="<?php echo $patient->getCity(); ?>" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">State</span>
					</td>
					<td class="edit-box">
						<select class="edit-dropdown-large" name="state">
							<option value="Arizona">Arizona</option>
						</select>
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Zipcode</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox-small" name="zipcode" value="<?php echo $patient->getZipcode(); ?>" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Insured</span>
					</td>
					<td class="edit-box">
						<?php if ($patient->isInsured()) { ?>
							<input type="radio" checked="checked" name="insured" value="1">Yes
							<input type="radio" name="insured" value="0">No
						<?php } else { ?>
							<input type="radio" name="insured" value="1">Yes
							<input type="radio" checked="checked" name="insured" value="0">No
						<?php } ?>
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Insurance Company</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="insurance_company" value="<?php echo $patient->getInsComp(); ?>" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Insurance ID Number</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="insurance_id" value="<?php echo $patient->getInsId(); ?>" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Insurance Phone Number</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="insurance_phone" value="<?php echo $patient->getInsPhone(); ?>" />
					</td>
				</tr>
			</table>
			<input type="submit" class="edit-submit" name="edit_submit" value="Save" onclick="sendForm('editPatientProfile')" />
			<?php if (isset($_POST["error"]) && $_POST["error"] == 1) { ?>
				<span class="edit-error">An error occurred when updating the information</span>
			<?php } ?>
		</form>
	</div>
</div>
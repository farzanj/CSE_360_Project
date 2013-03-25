<div class="frame-content" id="frame-12">
	<div id="edit-wrap">
		<form method="post" action="">
			<table id="edit-table" cellpadding="0" cellspacing="0">
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">First Name</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="first_name" value="[First Name]" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Last Name</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="last_name" value="[Last Name]" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Gender</span>
					</td>
					<td class="edit-box">
						<select class="edit-dropdown-small" name="gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">DOB</span>
					</td>
					<td class="edit-box">
						<select class="edit-dropdown-medium" name="month">
							<?php foreach (array("January", "February", "March", "April", "May", "June", 
								"July", "August", "September", "October", "November", "December") as $month) {
								echo "<option value=\"" . $month . "\">";
								echo $month;
								echo "</option>";
							} ?>
						</select>
						<select class="edit-dropdown-small" name="day">
							<?php for ($day = 1; $day < 32; $day++) {
								echo "<option value=\"" . $day . "\">";
								echo $day;
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
						<input type="text" class="editbox" name="email" value="[Email Address]" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Phone Number</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="patient_phone" value="[Phone Number]" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Address Line 1</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="address1" value="[Address]" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Address Line 2</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="address2" value="[Address]" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">City</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="city" value="[City]" />
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
						<input type="text" class="editbox-small" name="zipcode" value="[Zipcode]" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Insured</span>
					</td>
					<td class="edit-box">
						<input type="radio" name="insured" value="1">Yes
						<input type="radio" name="insured" value="0">No
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Insurance Company</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="insurance_company" value="[Insurance Company]" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Insurance ID Number</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="insurance_id" value="[Insurance ID Number]" />
					</td>
				</tr>
				<tr class="edit-row">
					<td class="edit-detail">
						<span class="edit-detail">Insurance Phone Number</span>
					</td>
					<td class="edit-box">
						<input type="text" class="editbox" name="insurance_phone" value="[Insurance Phone Number]" />
					</td>
				</tr>
			</table>
			<input type="submit" class="edit-submit" name="edit_submit" value="Submit" />
		</form>
	</div>
</div>
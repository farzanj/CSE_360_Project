<?php
define("ABSPATH", dirname(__FILE__) . "/");

include(ABSPATH . "session.php");
include(ABSPATH . "includes.php");
?>

<title>Universal EMR</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php include(ABSPATH . "view/banner.php"); ?>

<!-- Menu -->
<div id="menu">
	<table id="navbar" cellpadding="0" cellspacing="0">
		<tr>
			<td class="navbutton-active" id="nav-1">
				<a class="nav" id="1" href="javascript:void(0)" onclick="switchFrame(this.id)">Home</a>
			</td>
			<td class="navbutton" id="nav-2">
				<a class="nav" id="2" href="javascript:void(0)" onclick="switchFrame(this.id)">Find Record</a>
			</td>
			<td class="navbutton" id="nav-3">
				<a class="nav" id="3" href="javascript:void(0)" onclick="switchFrame(this.id)">Enter Data</a>
			</td>
			<td class="navbutton" id="nav-4">
				<a class="nav" id="4" href="javascript:void(0)" onclick="switchFrame(this.id)">Patient Profile</a>
			</td>
			<td class="navbutton" id="nav-5">
				<a class="nav" id="5" href="javascript:void(0)" onclick="switchFrame(this.id)">My Profile</a>
			</td>
		</tr>
	</table>
</div>

<!-- Options (right side) -->
<div id="options">
	<span class="option">Need Assistance?</span>
	<a class="option" href="">Live Chat</a>
	<svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="livechat-indicator">
  		<circle cx="25" cy="25" r="8" stroke="black" stroke-width="1" fill="#FF6666" />
	</svg>
	<a class="option" href="register.php">Register Patient</a>
	<a class="option" href="javascript:void(0)" onclick="loadPage('makeAppointment')">Make Appointment</a>
	<a class="option" href="">Logout</a>
</div>

<div class="frame">
	<!-- Home Page -->
	<div class="frame-content" id="frame-1" style="display:block">
		<span class="greeting">Hello [First Name]</span>
		<span class="appointments">Today's Appointments</span>
		<div id="appointments">
			<table id="appointment-table">
				<tr class="appointment-row-top">
					<td class="appointment-detail">
						<span class="appointment-detail-top">Patient</span>
					</td>
					<td class="appointment-detail">
						<span class="appointment-detail-top">Time</span>
					</td>
				</tr>
				<tr class="appointment-row">
					<td class="appointment-detail">
						<span class="appointment-detail">[Name 1]</span>
					</td>
					<td class="appointment-detail">
						<span class="appointment-detail">[Time]</span>
					</td>
				</tr>
				<tr class="appointment-row">
					<td class="appointment-detail">
						<span class="appointment-detail">[Name 2]</span>
					</td>
					<td class="appointment-detail">
						<span class="appointment-detail">[Time]</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<!-- Find Record -->
	<div class="frame-content" id="frame-2">
		<!-- action is placeholder -->
		<form method="post" action="javascript:void(0)">
			<table id="find-table" cellpadding="0" cellspacing="0">
				<tr class="find-row">
					<td class="find-detail">
						<span class="find-detail">Record ID</span>
					</td>
					<td class="find-box">
						<input type="text" class="findbox" name="id" />
					</td>
				</tr>
				<tr class="find-row">
					<td class="find-detail">
						<span class="find-detail">Patient's Name</span>
					</td>
					<td class="find-box">
						<input type="text" class="findbox" name="id" />
					</td>
				</tr>
			</table>
			<!-- onclick is placeholder to demonstrate the frame -->
			<input type="submit" class="findsubmit" name="find_submit" value="Find" onclick="switchFrame(10)" />
		</form>
		<span class="recent-records">Recent Records</span>
		<div id="recent-records"></div>
	</div>
	<!-- Record Information -->
	<div class="frame-content" id="frame-10">
		<span class="record-information">Record Information</span>
		<a class="view-graph" href="javascript:void(0)" onclick="switchFrame(11)">View Graph</a>
		<span class="record-date">[Date]</span>
		<div id="record-table-wrap">
		<table id="record-table" cellpadding="0" cellspacing="0">
			<tr class="record-row">
				<td class="record-detail">
					Record ID
				</td>
				<td class="record-detail">
					[ID Number]
				</td>
			</tr>
			<tr class="record-row">
				<td class="record-detail">
					Blood Pressure
				</td>
				<td class="record-detail">
					[Blood Pressure] mmHg
				</td>
			</tr>
			<tr class="record-row">
				<td class="record-detail">
					Sugar Level
				</td>
				<td class="record-detail">
					[Sugar Level] mmol/L
				</td>
			</tr>
			<tr class="record-row">
				<td class="record-detail">
					Weight
				</td>
				<td class="record-detail">
					[Weight] lbs
				</td>
			</tr>
		</table>
		</div>
		<span class="notes">Prescription/Notes</span>
		<textarea id="notes-box"></textarea><!-- &#10; for line-break -->
	</div>
	<!-- View Graph -->
	<div class="frame-content" id="frame-11">
		<div id="graph">
		</div>
		<span class="prescription">Prescription</span>
		<form method="post" action="">
			<textarea id="prescription-box" name="prescription"></textarea>
			<input type="submit" class="prescription-submit" name="prescription_submit" value="Submit" />
		</form>
	</div>
	<!-- Enter Data -->
	<div class="frame-content" id="frame-3" style="display:none">
		<div id="enter-wrap">
			<form method="post" action="">
				<table id="enter-table" cellpadding="0" cellspacing="0">
					<tr class="enter-row-patient">
						<td class="enter-detail">
							<span class="enter-detail">Patient's Name</span>
						</td>
						<td class="enter-box">
							<input type="text" class="enterbox" name="patient_name" value="[Patient Name]" />
						</td>
					</tr>
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
	<!-- Patient Profile -->
	<div class="frame-content" id="frame-4" style="display:none">
		<span class="patient-name">[Full Name]</span>
		<span class="patient-detail">Gender: [Gender]</span>
		<span class="patient-detail">DOB: [Date of Birth]</span>
		<span class="patient-detail">Phone Number: [Phone Number]</span>
		<span class="patient-detail">Address: [Address]</span>
		<span class="patient-detail">E-mail: [Email]</span>
		<span class="patient-detail">Insured: [Yes/No]</span>
		<span class="patient-detail">Insurance Company: [Company]</span>
		<span class="patient-detail">Insurance ID Number: [ID Number]</span>
		<span class="patient-detail">Insurance Phone Number: [Phone Number]</span>
		<!-- onclick is placeholder to demonstrate frame -->
		<a class="edit-information" href="javascript:void(0)" onclick="switchFrame(12)">Edit Information</a>
	</div>
	<!-- Edit Patient Profile -->
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
	<!-- My Profile -->
	<div class="frame-content" id="frame-5">
		<span class="my-name">[Full Name]</span>
		<span class="my-detail">Phone Number: [Phone Number]</span>
		<span class="my-detail">Address: [Address]</span>
		<span class="my-detail">E-mail: [Email]</span>
		<!-- onclick is placeholder to demonstrate frame -->
		<a class="edit-my-information" href="javascript:void(0)" onclick="switchFrame(13)">Edit Information</a>
		<a class="change-password" href="javascript:void(0)" onclick="switchFrame(14)">Change Password</a>
	</div>
	<!-- Edit My Profile -->
	<div class="frame-content" id="frame-13">
		<span class="edit-my-name">[Full Name]</span>
		<span class="edit-my-detail-top">Email: [Email]</span>
		<div id="edit-my-wrap">
			<span class="edit-information-header">Edit Information</span>
			<form method="post" action="">
				<table id="edit-my-table" cellpadding="0" cellspacing="0">
					<tr class="edit-my-row">
						<td class="edit-my-detail">
							<span class="edit-my-detail">Phone Number</span>
						</td>
						<td class="edit-my-box">
							<input type="text" class="editbox" name="user_phone" value="[Phone Number]" />
						</td>
					</tr>
					<tr class="edit-my-row">
						<td class="edit-my-detail">
							<span class="edit-my-detail">Address Line 1</span>
						</td>
						<td class="edit-my-box">
							<input type="text" class="editbox" name="user_address1" value="[Address]" />
						</td>
					</tr>
					<tr class="edit-my-row">
						<td class="edit-my-detail">
							<span class="edit-my-detail">Address Line 2</span>
						</td>
						<td class="edit-my-box">
							<input type="text" class="editbox" name="user_address2" value="[Address]" />
						</td>
					</tr>
					<tr class="edit-my-row">
						<td class="edit-my-detail">
							<span class="edit-my-detail">City</span>
						</td>
						<td class="edit-my-box">
							<input type="text" class="editbox" name="user_city" value="[City]" />
						</td>
					</tr>
					<tr class="edit-my-row">
						<td class="edit-my-detail">
							<span class="edit-my-detail">State</span>
						</td>
						<td class="edit-my-box">
							<select class="edit-dropdown-large" name="user_state">
								<option value="Arizona">Arizona</option>
							</select>
						</td>
					</tr>
					<tr class="edit-my-row">
						<td class="edit-my-detail">
							<span class="edit-my-detail">Zipcode</span>
						</td>
						<td class="edit-my-box">
							<input type="text" class="editbox-small" name="user_zipcode" value="[Zipcode]" />
						</td>
					</tr>
				</table>
				<input type="submit" class="edit-my-submit" name="edit_user_submit" value="Save" />
			</form>
		</div>
	</div>
	<!-- Change Password -->
	<div class="frame-content" id="frame-14">
		<span class="edit-my-name">[Full Name]</span>
		<span class="edit-my-detail-top">Email: [Email]</span>
		<div id="edit-my-wrap">
			<span class="edit-information-header">Change Password</span>
			<!-- <span class="error-password">ERROR</span>
			<span class="error-invalid">Invalid input. Please try again.</span> -->
			<form method="post" action="">
				<table id="edit-my-table" cellpadding="0" cellspacing="0">
					<tr class="edit-my-row">
						<td class="edit-my-detail">
							<span class="edit-my-detail">Old Password</span>
						</td>
						<td class="edit-my-box">
							<input type="password" class="editbox" name="old_password" />
						</td>
					</tr>
					<tr class="edit-my-row">
						<td class="edit-my-detail">
							<span class="edit-my-detail">New Password</span>
						</td>
						<td class="edit-my-box">
							<input type="password" class="editbox" name="new_password" />
						</td>
					</tr>
					<tr class="edit-my-row">
						<td class="edit-my-detail">
							<span class="edit-my-detail">Re-enter Password</span>
						</td>
						<td class="edit-my-box">
							<input type="password" class="editbox" name="new_password2" />
						</td>
					</tr>
				</table>
				<input type="submit" class="edit-my-submit" name="password_change_submit" value="Submit" />
			</form>
		</div>
	</div>
	<!-- Make Appointment -->
	<div class="frame-content" id="frame-15">
		<span class="make-appointment">Make an Appointment</span>
		<span class="appointment-stage">Step 1: Choose a Physician</span>
		<div id="choose-physician">
			<table id="choose-table" cellpadding="0" cellspacing="0">
				<tr class="choose-row-top">
					<td class="choose-detail">
						<span class="choose-detail">Physician</span>
					</td>
				</tr>
				<tr class="choose-row" id="choose-1" onclick="setPhysician(this.id)">
					<td class="choose-detail">
						<span class="choose-detail">[Physician Name 1]</span>
					</td>
				</tr>
				<tr class="choose-row" id="choose-2" onclick="setPhysician(this.id)">
					<td class="choose-detail">
						<span class="choose-detail">[Physician Name 2]</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<!-- Make Appointment Stage 2 -->
	<div class="frame-content" id="frame-16">
		<span class="make-appointment">Make an Appointment for [Full Name]</span>
		<span class="physician-name"></span>
		<span class="appointment-stage-2">Step 2: Choose a Date</span>
		<span class="appointment-available-date">Available Dates</span>
		<span class="appointment-stage-3">Step 3: Choose a Time</span>
		<span class="appointment-available-time">Available Time</span>
		<form method="post" action="">
			<input type="hidden" id="physician-appointment" name="physician_name" value="" />
			<select class="appointment-dropdown-large-month" name="date_month">
				<option value="January">January</option>
			</select>
			<select class="appointment-dropdown-large-day" name="date_day">
				<option value="1">1</option>
			</select>
			<select class="appointment-dropdown-large-time" name="date_time">
				<option value="11:30-12:00">11:30 AM - 12:00 PM</option>
			</select>
			<input type="submit" class="appointment-submit" name="appointment_submit" value="Submit" />
		</form>
	</div>
	<!-- Appointment Confirmation -->
	<div class="frame-content" id="frame-17">
		<span class="make-appointment">Appointment Confirmation</span>
		<span class="appointment-confirmation-name">[Full Name]</span>
		<span class="appointment-confirmation">[Physician Name]</span>
		<span class="appointment-confirmation">[Chosen Date]</span>
		<span class="appointment-confirmation">[Chosen Time]</span>
		<span class="confirmation-message">Your appointment has been confirmed.</span>
	</div>
</div>

<?php include(ABSPATH . "view/footer.php"); ?>
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
				<a class="nav" id="1" href="javascript:void(0)" onclick="loadPage('home')">Home</a>
			</td>
			<td class="navbutton" id="nav-2">
				<a class="nav" id="2" href="javascript:void(0)" onclick="loadPage('findRecord')">Find Record</a>
			</td>
			<td class="navbutton" id="nav-3">
				<a class="nav" id="3" href="javascript:void(0)" onclick="loadPage('enterData')">Enter Data</a>
			</td>
			<?php if ($mainUI->getUser()->getType() != "patient") { ?>
				<td class="navbutton" id="nav-4">
					<a class="nav" id="4" href="javascript:void(0)" onclick="loadPage('patientProfile')">Patient Profile</a>
				</td>
			<?php } ?>
			<td class="navbutton" id="nav-5">
				<a class="nav" id="5" href="javascript:void(0)" onclick="loadPage('myProfile')">My Profile</a>
			</td>
		</tr>
	</table>
</div>

<!-- Options (right side) -->
<div id="options">
	<?php if ($mainUI->getUser()->getType() == "patient") { ?>
		<span class="option">Need Assistance?</span>
	<?php } ?>
	<a class="option" href="">Live Chat</a>
	<?php if ($mainUI->getUser()->getType() != "patient") { ?>
		<svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="livechat-indicator">
		  	<circle cx="25" cy="25" r="8" stroke="black" stroke-width="1" fill="#FF6666" />
		</svg>
	<?php } ?>
	<?php if ($mainUI->getUser()->getType() != "patient") { ?>
		<a class="option" href="register.php">Register Patient</a>
	<?php } ?>
	<?php if ($mainUI->getUser()->getType() != "doctor") { ?>
		<a class="option" href="javascript:void(0)" onclick="loadPage('makeAppointment')">Make Appointment</a>
	<?php } ?>
	<a class="option" href="logout.php">Logout</a>
</div>

<div class="frame">
	<!-- Home Page -->
	<!-- <div class="frame-content" id="frame-1">
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
	</div> -->
</div>

<?php include(ABSPATH . "view/footer.php"); ?>
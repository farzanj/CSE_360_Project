<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
?>

<div class="frame-content" id="frame-1">
	<span class="greeting">Hello <?php echo $user->getFname(); ?></span>
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
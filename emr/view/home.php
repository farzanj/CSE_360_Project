<?php
include_once("../model/User.php");
include_once("../model/Appointment.php");
$user = unserialize(base64_decode($_POST["data1"]));
?>

<div class="frame-content" id="frame-1">
	<span class="greeting">Hello <?php echo $user->getFname(); ?></span>
	<span class="appointments">Today's Appointments</span>
	<div id="appointments">
		<table id="appointment-table">
			<tr class="appointment-row-top">
				<td class="appointment-detail">
					<span class="appointment-detail-top">
						<?php if ($user->getType() == "doctor") {
							echo "Patient";
						} else {
							echo "Physician";
						} ?>
					</span>
				</td>
				<?php if ($user->getType() == "nurse") { ?>
					<td class="appointment-detail">
						<span class="appointment-detail-top">Patient</span>
					</td>
				<?php } ?>
				<td class="appointment-detail">
					<span class="appointment-detail-top">Time</span>
				</td>	
			</tr>
			<?php foreach ($_POST as $key => $data) {
				if (strpos($key, "data") !== false && get_class(unserialize(base64_decode($data))) == "Appointment") {
					$app = unserialize(base64_decode($data)); ?>
					<tr class="appointment-row">
						<td class="appointment-detail">
							<span class="appointment-detail">
								<?php if ($user->getType() == "doctor") {
									echo $app->getPatient()->getFname() . " " . $app->getPatient()->getLname();
								} else {
									echo $app->getDoctor()->getFname() . " " . $app->getDoctor()->getLname();
								} ?>
							</span>
						</td>
						<?php if ($user->getType() == "nurse") { ?>
							<td class="appointment-detail">
								<span class="appointment-detail"><?php echo $app->getPatient()->getFname() . " " . $app->getPatient()->getLname(); ?></span>
							</td>
						<?php } ?>
						<td class="appointment-detail">
							<span class="appointment-detail"><?php echo $app->getTime(); ?></span>
						</td>
					</tr>
				<?php }
			} ?>
		</table>
	</div>
</div>
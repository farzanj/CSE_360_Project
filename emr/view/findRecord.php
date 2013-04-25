<?php
include_once("../model/User.php");
include_once("../model/Record.php");
$user = unserialize(base64_decode($_POST["data1"]));
?>

<div class="frame-content" id="frame-2">
	<form method="post" action="javascript:void(0)" id="findRecord">
		<table id="find-table" cellpadding="0" cellspacing="0">
			<tr class="find-row">
				<td class="find-detail">
					<span class="find-detail">Record ID</span>
				</td>
				<td class="find-box">
					<input type="text" class="findbox" name="recId" />
				</td>
			</tr>
			<?php if ($user->getType() != "patient") { ?>
				<tr class="find-row">
					<td class="find-detail">
						<span class="find-detail">Patient's Name</span>
					</td>
					<td class="find-box">
						<input type="text" class="findbox" name="name" />
					</td>
				</tr>
			<?php } ?>
		</table>
		<input type="submit" class="findsubmit" name="find_submit" value="Find" onclick="sendForm('findRecord')" />
	</form>
	<?php if (isset($_POST["error"]) && $_POST["error"] == 1) { ?>
		<span class="record-not-found">Record not found</span>
	<?php } ?>
	<span class="recent-records">Recent Records</span>
	<div id="recent-records">
		<table id="recent-table" cellpadding="0" cellspacing="0">
			<tr class="recent-row-top">
				<td class="recent-detail">
					<span class="recent-detail-top">Record ID</span>
				</td>
				<td class="recent-detail">
					<span class="recent-detail-top">Date</span>
				</td>
				<td class="recent-detail">
					<span class="recent-detail-top">Last Name</span>
				</td>
				<td class="recent-detail">
					<span class="recent-detail-top">First Name</span>
				</td>
				<td class="recent-detail">
					<span class="recent-detail-top">Blood Pres.</span>
				</td>
				<td class="recent-detail">
					<span class="recent-detail-top">Sugar Level</span>
				</td>
				<td class="recent-detail">
					<span class="recent-detail-top">Weight</span>
				</td>
			</tr>
			<?php foreach ($_POST as $key => $data) {
				if (strpos($key, "data") !== false && get_class(unserialize(base64_decode($data))) == "Record") {
					$record = unserialize(base64_decode($data));
					if ($record->checkOwnership($user)) { ?>
						<tr class="recent-row" onclick="loadRecord('<?php echo $record->getRecId(); ?>')">
							<td class="recent-detail">
								<span class="recent-detail"><?php echo $record->getRecId(); ?></span>
							</td>
							<td class="recent-detail">
								<span class="recent-detail"><?php echo date("m.d.y", strtotime($record->getDate()));?></span>
							</td>
							<td class="recent-detail">
								<span class="recent-detail"><?php echo $record->getPatient()->getLname(); ?></span>
							</td>
							<td class="recent-detail">
								<span class="recent-detail"><?php echo $record->getPatient()->getFname(); ?></span>
							</td>
							<td class="recent-detail">
								<span class="recent-detail"><?php echo $record->getBloodPres(); ?></span>
							</td>
							<td class="recent-detail">
								<span class="recent-detail"><?php echo $record->getSugarLevel(); ?></span>
							</td>
							<td class="recent-detail">
								<span class="recent-detail"><?php echo $record->getWeight(); ?></span>
							</td>
						</tr>
					<?php } ?>
				<?php }
			} ?>
		</table>
	</div>
</div>
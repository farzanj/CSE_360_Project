<?php
include_once("../model/Record.php");
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
$record = unserialize(base64_decode($_POST["data2"]));
?>

<div class="frame-content" id="frame-10">
	<span class="record-information">Record Information</span>
	<!-- onclick is placeholder to demonstrate frame -->
	<a class="view-graph" href="javascript:void(0)" onclick="loadPage('viewGraph')">View Graph</a>
	<span class="record-date"><?php echo date("F j, Y", strtotime($record->getDate())); ?></span>
	<?php if ($user->getType() != "patient") { ?>
		<span class="record-name"><?php echo $record->getPatient()->getFname() . " " . $record->getPatient()->getLname(); ?></span>
	<?php } ?>
	<div id="record-table-wrap">
	<table id="record-table" cellpadding="0" cellspacing="0">
		<tr class="record-row">
			<td class="record-detail">
				Record ID
			</td>
			<td class="record-detail">
				<?php echo $record->getRecId(); ?>
			</td>
		</tr>
		<tr class="record-row">
			<td class="record-detail">
				Blood Pressure
			</td>
			<td class="record-detail">
				<?php echo $record->getBloodPres(); ?> mmHg
			</td>
		</tr>
		<tr class="record-row">
			<td class="record-detail">
				Sugar Level
			</td>
			<td class="record-detail">
				<?php echo $record->getSugarLevel(); ?> mmol/L
			</td>
		</tr>
		<tr class="record-row">
			<td class="record-detail">
				Weight
			</td>
			<td class="record-detail">
				<?php echo $record->getWeight(); ?> lbs
			</td>
		</tr>
	</table>
	</div>
	<span class="notes">Prescription/Notes</span>
	<textarea id="notes-box"><?php echo $record->getPrescription(); ?></textarea><!-- &#10; for line-break -->
</div>
<?php
include_once("../model/Record.php");
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
$record = unserialize(base64_decode($_POST["data2"]));
?>

<div class="frame-content" id="frame-10">
	<span class="record-information">Record Information</span>
	<!-- onclick is placeholder to demonstrate frame -->
	<a class="view-graph" href="javascript:void(0)" onclick="loadPage('viewGraph');showGraphLoader();">View Graph</a>
	<img class="graph-loader" src="images/loader.gif">
	<span class="record-date"><?php echo date("F j, Y", strtotime($record->getDate())); ?></span>
	<?php if ($user->getType() != "patient") { ?>
		<span class="record-name"><?php echo $record->getPatient()->getFname() . " " . $record->getPatient()->getLname(); ?></span>
	<?php } ?>
	<div id="record-table-wrap">
	<table id="record-table" cellpadding="0" cellspacing="0">
		<tr class="record-row">
			<td class="record-detail">
				<span class="record-detail">Record ID:</span>
			</td>
			<td class="record-detail">
				<span class="record-detail"><?php echo $record->getRecId(); ?></span>
			</td>
		</tr>
		<tr class="record-row">
			<td class="record-detail">
				<span class="record-detail">Blood Pressure:</span>
			</td>
			<td class="record-detail">
				<span class="record-detail"><?php echo $record->getBloodPres(); ?> mmHg</span>
			</td>
		</tr>
		<tr class="record-row">
			<td class="record-detail">
				<span class="record-detail">Sugar Level:</span>
			</td>
			<td class="record-detail">
				<span class="record-detail"><?php echo $record->getSugarLevel(); ?> mmol/L</span>
			</td>
		</tr>
		<tr class="record-row">
			<td class="record-detail">
				<span class="record-detail">Weight:</span>
			</td>
			<td class="record-detail">
				<span class="record-detail"><?php echo $record->getWeight(); ?> lbs</span>
			</td>
		</tr>
		<tr class="record-row">
			<td class="record-detail">
				<span class="record-detail">Attending Personnel:</span>
			</td>
			<td class="record-detail">
				<?php if ($record->hasPersonnel()) { ?>
					<span class="record-detail"><?php echo $record->getPersonnel()->getFname() . " " . $record->getPersonnel()->getLname(); ?></span>
				<?php } else { ?>
					<span class="record-detail">None</span>
				<?php } ?>
			</td>
		</tr>
	</table>
	</div>
	<span class="notes">Prescription/Notes</span>
	<textarea id="notes-box" readonly="true"><?php echo $record->getPrescription(); ?></textarea><!-- &#10; for line-break -->
</div>
<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
?>

<div class="frame-content" id="frame-13">
	<span class="edit-my-name"><?php echo $user->getFname() . " " . $user->getLname(); ?></span>
	<span class="edit-my-detail-top">Email: <?php echo $user->getEmail(); ?></span>
	<div id="edit-my-wrap">
		<span class="edit-information-header">Edit Information</span>
		<form method="post" action="javascript:void(0)" id="editMyProfile" >
			<table id="edit-my-table" cellpadding="0" cellspacing="0">
				<tr class="edit-my-row">
					<td class="edit-my-detail">
						<span class="edit-my-detail">Phone Number</span>
					</td>
					<td class="edit-my-box">
						<input type="text" class="editbox" name="user_phone" value="<?php echo $user->getPhone(); ?>" />
					</td>
				</tr>
				<tr class="edit-my-row">
					<td class="edit-my-detail">
						<span class="edit-my-detail">Address Line 1</span>
					</td>
					<td class="edit-my-box">
						<input type="text" class="editbox" name="user_address1" value="<?php echo $user->getAddress(); ?>" />
					</td>
				</tr>
				<tr class="edit-my-row">
					<td class="edit-my-detail">
						<span class="edit-my-detail">Address Line 2</span>
					</td>
					<td class="edit-my-box">
						<input type="text" class="editbox" name="user_address2" value="" />
					</td>
				</tr>
				<tr class="edit-my-row">
					<td class="edit-my-detail">
						<span class="edit-my-detail">City</span>
					</td>
					<td class="edit-my-box">
						<input type="text" class="editbox" name="user_city" value="<?php echo $user->getCity(); ?>" />
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
						<input type="text" class="editbox-small" name="user_zipcode" value="<?php echo $user->getZipcode(); ?>" />
					</td>
				</tr>
			</table>
			<input type="submit" class="edit-my-submit" name="edit_user_submit" value="Save" onclick="sendForm('editMyProfile')" />
			<?php if (isset($_POST["error"]) && $_POST["error"] == 1) { ?>
				<span class="edit-my-error">An error occurred when updating the information</span>
			<?php } ?>
		</form>
	</div>
</div>
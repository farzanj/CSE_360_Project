<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_POST["data1"]));
?>

<div class="frame-content" id="frame-14">
	<span class="edit-my-name"><?php echo $user->getFname() . " " . $user->getLname(); ?></span>
	<span class="edit-my-detail-top">Email: <?php echo $user->getEmail(); ?></span>
	<div id="edit-my-wrap">
		<span class="edit-information-header">Change Password</span>
		<?php if (isset($_POST["error"]) && $_POST["error"] == 1) { ?>
			<span class="error-password">ERROR</span>
			<span class="error-invalid">Invalid input. Please try again.</span>
		<?php } ?>
		<form method="post" action="javascript:void(0)" id="changePassword">
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
			<input type="submit" class="edit-my-submit" name="password_change_submit" value="Submit" onclick="sendForm('changePassword')" />
		</form>
	</div>
</div>
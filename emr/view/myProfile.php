<?php
include_once("../model/User.php");
$user = unserialize(base64_decode($_GET["data1"]));
?>

<div class="frame-content" id="frame-5">
	<span class="my-name"><?php echo $user->getFname() . " " . $user->getLname(); ?></span>
	<span class="my-detail">Phone Number: <?php echo $user->getPhone(); ?></span>
	<span class="my-detail">Address: <?php echo $user->getAddress(); ?></span>
	<span class="my-detail">E-mail: <?php echo $user->getEmail(); ?></span>
	<!-- onclick is placeholder to demonstrate frame -->
	<a class="edit-my-information" href="javascript:void(0)" onclick="loadPage('editMyProfile')">Edit Information</a>
	<a class="change-password" href="javascript:void(0)" onclick="loadPage('changePassword')">Change Password</a>
</div>
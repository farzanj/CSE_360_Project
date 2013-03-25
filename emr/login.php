<?php
define("ABSPATH", dirname(__FILE__) . "/");

include(ABSPATH . "includes.php");
?>

<title>Universal EMR</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php include(ABSPATH . "view/banner.php"); ?>

<div id="login">
	<span class="welcome">Welcome to Universal EMR</span>
	<form method="post" action="controller.php">
		<?php if (isset($_GET["error"]) && $_GET["error"] == 1) { ?>
			<span class="login-error">Your email or password was incorrect. Please try again.</span>
		<?php } ?>
		<table id="logintable" cellpadding="0" cellspacing="0">
			<tr class="login-row">
				<td class="login-detail">
					<span class="login-detail">E-mail</span>
				</td>
				<td class="login-box">
					<input type="text" class="loginbox" name="email" />
				</td>
			</tr>
			<tr class="login-row">
				<td class="login-detail">
					<span class="login-detail">Password</span>
				</td>
				<td class="login-box">
					<input type="password" class="loginbox" name="password" />
				</td>
			</tr>
		</table>
		<input type="submit" class="loginsubmit" name="login_submit" value="Login" />	
	</form>
	<a class="forgot-password" href="">Forgot password?</a>
</div>

<?php include(ABSPATH . "view/footer.php"); ?>
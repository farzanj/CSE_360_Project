<?php
define("ABSPATH", dirname(__FILE__) . "/");

include_once(ABSPATH . "dbconnect.php");
include_once(ABSPATH . "requestManager.php");

$con = new dbconnect();
$con->connect();

$request = new RequestManager();
$request->logout();

header("Location: /emr/");
exit();
?>
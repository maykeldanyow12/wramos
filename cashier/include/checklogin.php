<?php
function check_login()
{
	if (strlen($_SESSION['login']) == 0) {
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "./index.php";
		$_SESSION["login"] = "";
		header("Location: http://$host$uri/$extra");
	}
}
function formatdate($date, $format = "M d,Y h:i A")
{
	$date = strtotime($date);
	return date($format, $date);
}
function navigate($path)
{
	echo "<script>window.location.href='$path'</script>";
	exit();
}
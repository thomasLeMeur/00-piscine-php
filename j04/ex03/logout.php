<?PHP
session_start();
if ($_SESSION["loggued_on_user"] !== NULL)
	$_SESSION["loggued_on_user"] = "";
?>

<?PHP
if ($_SERVER["PHP_AUTH_USER"] === "zaz" && $_SERVER["PHP_AUTH_PW"] === "jaimelespetitsponeys")
{
	$s =base64_encode(file_get_contents("../img/42.png"));
	header("Content-Type: image/png");
	echo "<html><body>\n";
	echo "Bonjour Zaz<br />\n";
	echo "<img src='data:image/png;base64,$s'>\n";
	echo "</body></html>\n";
}
else
{
	header("HTTP/1.0 401 Unauthorized");
	header("WWW-Authenticate: Basic realm=''Espace membres''");
	echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>\n";
}
?>

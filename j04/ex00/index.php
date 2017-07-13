<?PHP

session_start();
if ($_GET["submit"] === "OK")
{
	if ($_GET["login"] !== NULL)
		$_SESSION["log"] = $_GET["login"];
	if ($_GET["passwd"] !== NULL)
		$_SESSION["pwd"] = $_GET["passwd"];
}
echo "<html><body>\n";
echo "<form action=\"index.php\" method=\"GET\">\n";
echo "   Identifiant: <input type=\"text\" name=\"login\" value=\"$_SESSION[log]\" />\n";
echo "   <br />\n";
echo "   Mot de passe: <input type=\"password\" name=\"passwd\" value=\"$_SESSION[pwd]\" />\n";
echo "  <input type=\"submit\" name=\"submit\" value=\"OK\" />\n";
echo "</form>\n";
echo "</body></html>\n";
?>

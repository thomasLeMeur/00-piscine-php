<html>
<head>
	<title>ft_minishop</title>
	<link rel="stylesheet" href="index.css">
</head>
<body class=logs>
	<div class="log">
		<div class="conect">
				<h1>Se connecter</h1>
				<form id="log_id" action="login.php" method="POST">
					Identifiant: <input class="text" type="text" name="login" value="" /><br />
					Mot de passe: <input type="password" name="passwd" value="" /><br />
					<input id=but_log class=button type="submit" name="submit" value="Connexion" />
					<input id=but_log class=button type="submit" name="submit" value="Administration" />
				</form>
		</div>
		<div class="regis">
			<hr />
				<h1>S'enregistrer</h1>
				<form id="log_id" action="create.php" method="POST">
					Identifiant: <input class="text" type="text" name="login" value="" /><br />
					Mot de passe: <input type="password" name="passwd" value="" /><br />
					<input id=but_log class=button type="submit" name="submit" value="Cr&eacute;er un compte" />
				</form>
		</div>
	</div>
				<form id="log_id" action="redirections.php" method="POST">
					<input id=ram class=button type=submit name=redir value="Retour au menu" />
				</form>
</body>
</html>

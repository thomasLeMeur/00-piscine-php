<?php
session_start();
if ($_SESSION["is_admin"] !== 1)
	header("Location: logs.php")
?>
<html>
<head>
	<title>ft_minishop</title>
	<link rel="stylesheet" href="index.css"></link>
</head>
<body>
	<div class="main">
		<div class="fields">
			<form action="change_admin.php" method="POST">
				<input class=button type="submit" name="submit" value="Articles">
				<input class=button type="submit" name="submit" value="Cat&eacute;gories">
				<input class=button type="submit" name="submit" value="Utilisateurs">
				<input class=button type="submit" name="submit" value="Commandes">
				<input class=button type="submit" name="submit" value="Retour au menu">
			</form>
		</div>
		<div class="titre">
			<?php
				if ($_SESSION["admin_content"] === "Articles")
					echo '<div class="title_fields"><h1>Articles</h1></div>';
				else if ($_SESSION["admin_content"] === "Catégories")
					echo '<div class="title_fields"><h1>Cat&eacute;gories</h1></div>';
				else if ($_SESSION["admin_content"] === "Utilisateurs")
					echo '<div class="title_fields"><h1>Utilisateurs</h1></div>';
				else if ($_SESSION["admin_content"] === "Commandes")
					echo '<div class="title_fields"><h1>Commandes</h1></div>';
			?>
		</div>
		<table class=table>
		<?php
			if ($_SESSION["admin_content"] === "Articles")
			{
				echo '<tr><td><p id="indice">Nom</p></td>';
				echo '<td><p id="indice">Prix</p></td>';
				echo '<td><p id="indice">Cat&eacute;gories</p></td>';
				echo '<td><p id="indice">R&eacute;f&eacute;rence</p></td>';
				echo '<td><p id="indice">Image</p></td>';
				echo '<td><p id="indice">Description</p></td></tr>';
				$datas = unserialize(file_get_contents("./datas/articles"));
				foreach($datas as $data)
				{
					echo '<tr><form action="adminart.php" method="POST">';
					echo '<td><input type="text" name="nom" value="'.$data["nom"].'"></p></td>';
					echo '<td><input type="text" name="prix" value="'.$data["prix"].'&euro;"></p></td>';
					echo '<td><input type="text" name="cats" value="'.implode(";", $data["cats"]).'"></p></td>';
					echo '<td><p id="ref_art">'.$data["ref"].'</p></td>';
					echo '<td><input type="text" name="img" value="'.$data["img"].'"></p></td>';
					echo '<td><input type="text" name="desc" value="'.$data["desc"].'"></p></td>';
					echo '<td><input class=button type="submit" name="'.$data["ref"].'" value="modifier"></p></td>';
					echo '<td><input class=button type="submit" name="'.$data["ref"].'" value="supprimer"></p></td>';
					echo '</form></tr>';
				}
				echo '<br/><tr><form action="adminart.php" method="POST">';
				echo '<td><input type="text" name="nom"></p></td>';
				echo '<td><input type="text" name="prix"></p></td>';
				echo '<td><input type="text" name="cats"></p></td>';
				echo '<td><input type="text" name="ref"></p></td>';
				echo '<td><input type="text" name="img"></p></td>';
				echo '<td><input type="text" name="desc"></p><td>';
				echo '<td><input class=button type="submit" name="submit" value="Ajouter"></p></td>';
				echo '</form></tr>';
			}
			else if ($_SESSION["admin_content"] === "Catégories")
			{
				echo '<tr><td><p id="indice">Nom</p><td><td colspan=2></td></tr>';
				$datas = unserialize(file_get_contents("./datas/categories"));
				foreach($datas as $data)
				{
					echo '<tr><td><p id="indice">'.$data.'</p></td>';
					echo '<td><form action="admincat.php" method="POST">';
					echo '<input class=button type="submit" name="'.$data.'" value="supprimer"></p>';
					echo '</form></td></tr>';
				}
				echo '<tr><td><form action="admincat.php" method="POST">';
				echo '<input type="text" name="nom"></p></td>';
				echo '<td><input class=button type="submit" name="submit" value="ajouter"></p></td>';
				echo '</form></tr>';
			}
			else if ($_SESSION["admin_content"] === "Utilisateurs")
			{
				echo '<tr><td><p id="indice">Pseudo</p></td><td colspan=2><td/></tr><br/>';
				$datas = unserialize(file_get_contents("./datas/passwd"));
				foreach($datas as $data)
				{
					echo '<tr><td><p id="indice">'.$data["login"].'</p></td>';
					echo '<td><form action="adminuser.php" method="POST">';
					echo '<input class=button type="submit" name="'.$data["login"].'" value="supprimer"></p>';
					echo '<input class=button type="submit" name="'.$data["login"].'" value="promouvoir"></p>';
					echo '</form></td></tr><tr></tr>';
				}
			}
			else if ($_SESSION["admin_content"] === "Commandes")
			{
				echo '<tr><td><p id="indice">Pseudo</p></td>';
				echo '<td><p id="indice">Date</p></td>';
				echo '<td><p id="indice">Prix</p></td>';
				echo '<td><p id="indice">Identifiant</p></td></tr>';
				$datas = unserialize(file_get_contents("./datas/commandes"));
				foreach($datas as $data)
				{
					echo '<tr><td><p id="indice">'.$data["user"].'</p></td>';
					echo '<td><p id="indice">'.$data["date"].'</p></td>';
					echo '<td><p id="indice">'.$data["prix"].'&euro;</p></td>';
					echo '<td><p id="indice">'.$data["id"].'</p></td>';
					echo '<td><form action="admincmd.php" method="POST">';
					echo '<input class=button type="submit" name="'.$data["id"].'" value="supprimer"></p>';
					echo '</form></td></tr>';
				}
			}
		?>
	</table>
</body>
</html>

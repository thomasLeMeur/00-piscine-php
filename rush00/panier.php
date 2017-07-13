<?php
include("cookie_infos.php");
?>
<html>
<head>
	<title>ft_minishop</title>
	<link rel="stylesheet" href="index.css">
</head>
<body class=logs>
	<div class="main">
		<h1 class=titre >Votre panier</h1>
		<table class=table>
		<?php>
			$total = 0;
			$var = get_cookie_infos();;
			echo '<tr><td><p id="indice">Nom</p></td>';
			echo '<td> <p id="indice">R&eacute;f&eacute;rence</p></td>';
			echo '<td><p id="indice">Unit&eacute;</p></td>';
			echo '<td><p id="indice">Quantit&eacute;</p></td>';
			echo '<td><p id="indice">Prix</p></td>';
			echo '</tr><tr></tr>';
			foreach ($var as $val)
			{
				echo '<tr><td><p>'.$val["nom"].'</p></td>';
				echo '<td><p>'.$val["ref"].'</p></td>';
				echo '<td><p>'.$val["prix"].'&euro;<p></td>';
				echo '<td><p>'.$val["nb"].'</p></td>';
				echo '<td><p>'.($val["nb"] * $val["prix"]).'&euro;</p></td>';
				$total += $val["nb"] * $val["prix"];
				echo '<td><form id="delete" action="delete.php" method="POST">';
				echo '<input class=button type="submit" name="'.$val["ref"].'" value="Supprimer">';
				echo '</form></td></tr><br/>';
			}
			echo '<tr><td colspan=3></td><td><p id="nom">Total:</p></td>';
			echo '<td><p id="Prix">'.$total.'&euro;</p></td>';
			?>
			<td><form id="valide_panier" action="validerpanier.php" method="POST">
				<input class=button type="submit" name="valider" value="Valider">
			</form></td>
		</table>
			<form  action="redirections.php" method="POST">
				<input id=ram class=button type="submit" name="redir" value="Retour au menu">
			</form>
</body>
</html>

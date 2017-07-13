<?php
session_start();
if ($_SESSION["set"] !== 1)
{
	header("Location: install.php");
	exit;
}
?>
<html>
<head>
	<title>ft_minishop</title>
	<link rel="stylesheet" href="index.css" />
</head>
<body>
	<div class="main">
		<div class="header">
			<div class="user">
				<div class="sign">
					<?php
						if ($_SESSION["loggued_on_user"] == "")
							echo '<a href="logs.php"><h3>Connexion<br />Inscription</h3></a>';
						else
							echo '<a href="logout.php"><h3>'.$_SESSION["loggued_on_user"].'/D&eacute;connexion</h3></a>';
					?>
				</div>
				<div class="sign">
					<a href="panier.php"><h3 class="sign">Panier</h3></a><img id="panier_img" src="https://pixabay.com/static/uploads/photo/2014/04/02/10/53/shopping-cart-304843_960_720.png" /></a>
				</div>
			</div>
		</div>
		<div class="shop">
			<div class="menu all">
				<div class="titre">
					<h2>Menu</h2>
				</div>
				<?php
					$cats = unserialize(file_get_contents("datas/categories"));
					if (count($cats) >= 0)
					{
						echo '<div class="categorie">';
						echo '<form action="filter.php" method="POST">';
						echo '<input class=button type="submit" name="submit" value="Charger"><br /><br />';
						foreach($cats as $cat)
						{
							if (array_search($cat, $_SESSION["cats"]) !== FALSE)
								$checked = "checked";
							else
								$checked = "";
							echo '<input class=police type="checkbox" name="cats[]" value="'.$cat.'" '.$checked.'>'.$cat.'<br>';
						}
						echo '</form>';
						echo '<hr color="black" id=hr_menu /></div>';
					}
				?>
			</div>
			<div class="produits all">
				<hr id=hr color="black" />
				<div class="titre">
					<h1>Produits</h1>
				</div>
					<?php
						$prods = unserialize(file_get_contents("datas/articles"));
						foreach($prods as $prod)
						{
							$wrong = 0;
							foreach($_SESSION["cats"] as $cat)
							{
								if (array_search($cat, $prod["cats"]) === FALSE)
								{
									$wrong = 1;
									break;
								}
							}
							if ($wrong === 0)
							{
								echo '<div class="article">';
								echo '<div class="left">';
								echo '<h3>'.$prod["nom"].'</h3>';
								echo '<img id="article_img" src="'.$prod["img"].'">';
								echo '<div class="acheter">';
								echo '<form class=price action="addpanier.php" method="POST">';
								echo $prod["prix"].'&euro;<input id=add type="submit" name="'.$prod["ref"].'" value="Ajouter au panier">';
								echo '</form>';
								echo '</div>';
								echo '</div>';
								echo '<div class="right">'.$prod["desc"].'</div>';
								echo '</div>';
							}
						}
					?>
			</div>
		</div>
	</div>
</body>
</html>

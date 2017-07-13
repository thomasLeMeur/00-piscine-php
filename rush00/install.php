<?php
include("functions.php");

session_start();
	mkdir("./datas", 0777);
	file_put_contents("./datas/passwd", serialize(array())."\n");
	file_put_contents("./datas/commandes", serialize(array())."\n");

	$admins = array();
	add_account("adm", hash("whirlpool", "adm"), $admins);
	file_put_contents("./datas/admins", serialize($admins)."\n");

	$categories[0] = "Animal";
	$categories[1] = "Alimentation";
	$categories[2] = "Loisir";
	$categories[3] = "Habitation";
	$categories[4] = "Divers";
	file_put_contents("./datas/categories", serialize($categories)."\n");

	$articles = array();
	add_article("Chat", 100, array("Animal", "Loisir", "Divers", "Alimentation"), "a0e0f12g",
		"http://www.louisetzeliemartin.org/medias/images/chat-1.jpg", "C'est un petit chat", $articles);
	add_article("Macdo", 7.20, array("Alimentation", "Loisir"), "we67328j",
		"http://www.lepoint.fr/images/2015/08/11/1951885lpw-1951898-article-food-jpg_3005122_660x281.jpg", "C'est un gros domac", $articles);
	add_article("Palace", 2000000, array("Habitation"), "kej768923j",
		"http://i.ndtvimg.com/i/2016-01/umaid-bhawan-palace-625-300_625x300_41453378193.jpg", "Tu n'y vivras jamais !", $articles);
	add_article("Fourchette", 0.63, array("Alimentation", "Divers"), "sa903",
		"https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Fourchette_a_gateau.JPG/220px-Fourchette_a_gateau.JPG" ,
		"Eh oui c'est une fourchette...", $articles);
	add_article("Sextoy bizarre", 42, array("Loisir", "Divers"), "we7823011",
		"http://www.pausecafein.fr/images/cafein/2015/02/11-sex-toys-effrayants/toy1.jpg", "Pour qui comprendra :')", $articles);
	add_article("Hollande", 0, array("Animal", "Divers"), "e728wed",
		"http://www.lepoint.fr/images/2013/06/17/francois-hollande-pluie-jpg-1600601-jpg_1483149.JPG", "...Humm...", $articles);
	add_article("Extra-terrestre", -0, array("Divers"), "?????",
		"http://www.paranormal-encyclopedie.com/wiki/uploads/Images/Extraterrestre_35.jpg", "Laissez-vous tenter", $articles);
	add_article("Ami", 5628, array("Animal", "Alimentation", "Loisir", "Habitation", "Divers"), "ew8239012se",
		"http://ttvpsy.psychologies.com/7/7/5/3577.jpg", "C'est chaud si t'es en manque de potes'", $articles);
	add_article("TIG", 0, array("Loisir", "Divers"), "we23892sdc",
		"http://2.bp.blogspot.com/-87Z42R0VQ8c/T1c-Yy1xV9I/AAAAAAAACLU/4oM2WJt7Wso/s1600/interet+general.jpg",
		"Allez viens, tu verras on est bien", $articles);
	add_article("Clash des gitans", 23789, array("Animal", "Loisir", "Divers"), "weiu263478",
		"http://www.yzgeneration.com/wp-content/uploads/2015/05/Clash-Gitans-Djo-David-Lopez-Bis-620x350.jpg", "J'en veeeeuuuuuxxxx !!!!'", $articles);
	file_put_contents("./datas/articles", serialize($articles)."\n");
$_SESSION["is_admin"] = 0;
$_SESSION["set"] = 1;
$_SESSION["cats"] = array();
$_SESSION["loggued_on_user"] = "";
$_SESSION["admin_content"] = "Articles";
header("Location: ./index.php");
?>


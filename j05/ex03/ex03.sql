INSERT INTO `db_tle-meur`.ft_table (login, groupe, date_de_creation) SELECT nom, 'other', date_naissance FROM fiche_personne WHERE fiche_personne.nom RLIKE BINARY 'a' AND LENGTH(nom) < 9 ORDER BY nom LIMIT 10;

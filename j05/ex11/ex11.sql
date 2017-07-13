SELECT UPPER(fiche_personne.nom) as 'NOM', prenom, prix FROM abonnement, membre, fiche_personne WHERE prix > 42 AND abonnement.id_abo = membre.id_abo AND id_fiche_perso = id_perso ORDER BY fiche_personne.nom, prenom;
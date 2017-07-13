SELECT titre, resum FROM film WHERE resum RLIKE '42' OR titre RLIKE '42' ORDER BY duree_min;

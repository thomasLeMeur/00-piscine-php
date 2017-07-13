SELECT COUNT(date) AS films FROM historique_membre WHERE (date >= '2006-10-30' AND date <= '2007-07-27') OR date RLIKE '-(12|00)-24';

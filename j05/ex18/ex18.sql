SELECT nom FROM distrib WHERE id_distrib RLIKE '(42|6([2-9])|71|88|89|90)' OR nom RLIKE '(y|Y).*(y|Y)' LIMIT 2, 5;

CREATE TABLE `db_tle-meur`.ft_table (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, login varchar(8) NOT NULL DEFAULT 'toto', groupe ENUM ('staff', 'student', 'other') NOT NULL, date_de_creation DATE NOT NULL);
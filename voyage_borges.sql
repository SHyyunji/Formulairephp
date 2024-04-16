CREATE DATABASE IF NOT EXISTS Voyage_Borges;
USE Voyage_Borges;




CREATE TABLE `Destination` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pays` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `Destination` (`id`,`pays`) VALUES
(1, 'Japon'),
(2, 'Taïlande'),
(3, 'Corée du sud'),
(4, 'Chine'),
(5, 'Laos'),
(6, 'Taïwan'),
(7, 'Singapour');


CREATE TABLE `Hotel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `id_destination` int NOT NULL,
  `etoile` varchar(255) NOT NULL,
  `id_reservation` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk2` (`id_destination`),
  KEY `fk3` (`id_reservation`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `Hotel` (`nom`,`id_destination`,`etoile`,`id_reservation`) VALUES
('the blossom kyoto', 1,'4 etoile',1),
('Settha palace hotel', 2, '5 etoile',2),
('LOTTE city hotel myongdong', 3,'4 etoile',3),
('central hotel shanghai', 4, '4 etoile',4),
('Riverside hotel', 5, '4 etoile',5),
('Caesar metro taipei', 6,'4 etoile',6),
('Raffles hotel singapor', 7, '5 etoile',7);

CREATE TABLE `Reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_arrive` varchar(255) NOT NULL,
  `date_depart` varchar(255) NOT NULL,
  `nbr_personne` int NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `Reservation` (`date_arrive` , `date_depart` , `nbr_personne`) VALUES
('19/03', '19/03', 2),
('19/03', '19/03', 2),
('19/03', '19/03', 3),
('19/03', '19/03', 4),
('19/03', '19/03', 1),
('19/03', '19/03', 2),
('19/03', '19/03', 1);
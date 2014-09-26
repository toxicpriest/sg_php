# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.27)
# Datenbank: sg2014
# Erstellungsdauer: 2014-09-23 13:50:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle drinks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `drinks`;

CREATE TABLE `drinks` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `gameid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alcohol` int(11) DEFAULT NULL,
  `size` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `drinks` WRITE;
/*!40000 ALTER TABLE `drinks` DISABLE KEYS */;

INSERT INTO `drinks` (`id`, `gameid`, `name`, `alcohol`, `size`)
VALUES
	('54201864d63fb','542018648628b','Drink 1',20,'Liter'),
	('54201864d6445','542018648628b','Drink 2',20,'Liter'),
	('54201864d6477','542018648628b','Drink 3',20,'Liter');

/*!40000 ALTER TABLE `drinks` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle game2status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `game2status`;

CREATE TABLE `game2status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Export von Tabelle games
# ------------------------------------------------------------

DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `game_state` varchar(255) DEFAULT NULL,
  `save_key` varchar(255) DEFAULT NULL,
  `maxamount` int(11) NOT NULL DEFAULT '1',
  `wonat` int(11) NOT NULL DEFAULT '15',
  `taskpercent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;

INSERT INTO `games` (`id`, `game_state`, `save_key`, `maxamount`, `wonat`, `taskpercent`)
VALUES
	('542018648628b','WAITING','0',4,20,30);

/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Export von Tabelle tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `text` varchar(255) NOT NULL DEFAULT '',
  `action` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `action_param` int(11) DEFAULT NULL,
  `points` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;

INSERT INTO `tasks` (`id`, `name`, `text`, `action`, `action_param`, `points`)
VALUES
	(1,'Kraftprobe','Mache {x} Liegestütze! Für jede so erbrachte Leistung bekommt du einen Finger Bier.','dice',NULL,'x'),
	(2,'Razzia','Renne {x} Runden ums Haus/Sofa/... in jeder Runde bekommst du 2 Finger Bier zugesteckt.','dice',NULL,'x'),
	(3,'Beichte','Rufe jemanden an und beichte ihm, dass du trinkst. Beende das Gespräch mit einem Killer.',NULL,NULL,'1'),
	(4,'Goldkelchen','Gurgel ein Lied mit 2 Finger Bier. Die anderen dürfen gerne mitmachen!',NULL,NULL,'1'),
	(5,'Giftmischer','Mische je eine Einheiten {x} Getränks und trinke das Gebräu','dice',NULL,'2'),
	(6,'Verhör','Beantworte den anderen eine persönliche Frage. Die Anderen bekommen für die verwerfliche Frage alle 2 Finger Bier.',NULL,NULL,'1'),
	(7,'Gib mir Tiernamen','Imitiere ein Tier, das die anderen bestimmen. Bewegung und Geräusche inklusive!',NULL,NULL,'1'),
	(8,'Untertauchen','Du heißt aber jetzt Frank! Alle anderen müssen dich so ansprechen, also auch keine Kosenamen.',NULL,NULL,'0'),
	(9,'Banküberfall','Schreit alle \"Hände hoch!\" und reißt die Hände hoch. Der letzte bekommt einen Killer und 1 Finger für jeden Ganoven im Raum.',NULL,NULL,NULL),
	(10,'Spitzel','Vorsicht! Ein Spitzel ist unter euch! Die nächsten 3 Minuten darf keiner etwas sagen.','timer',3,NULL),
	(11,'Russisch Roulette','Spiel Schnick-Schnack-Schnuck mit einem beliebigem Spieler. Der Verlierer wird mit einem Killer bestraft.',NULL,NULL,'1'),
	(12,'Last but not Least','Alle exen einen Killer! Der letzte bekommt noch einen!',NULL,NULL,NULL),
	(13,'Achtung, der Chef!','Es darf 5 Runden lang nicht gelacht werden!','round',5,NULL),
	(14,'Inventur','Legt all euer Geld, was ihr dabei habt, auf den Tisch. Wer am wenigsten hat, bekommt den Killer gratis.',NULL,NULL,NULL),
	(15,'Angeschossen','Und das an deiner Lieblingshand! Benutze für alles andere darfst du jetzt nur noch die schwache Hand benutzen. Hält 5 Runden.','round',5,'1'),
	(16,'Casino-Time','Würfel! Bei 1 - 5 Würfelaugen bekommst du entsprechend der Anzahl der Würfelaugen Finger Bier. Bei einer 6 gibt es FULLHOUSE: Alle anderen bekommen einen Killer.','dice',NULL,NULL),
	(17,'Desateure werden erschossen','Klogänge sind für alle die nächsten 10 Minuten untersagt.','timer',10,NULL),
	(18,'Amoklauf','Flaschendrehen! Derjenige, auf den die Flasche zeigt, wird erschossen und muss einen Killer trinken. Das wird solange wiederholt, bis die Flasche auf dich zeigt.',NULL,NULL,'1'),
	(19,'Eine Frage der Ehre','Trinke so viel, wie du möchtest. Die anderen müssen mit dir gleich ziehen.',NULL,NULL,NULL),
	(20,'Mobbing','Du bist der Buhmann für die nächsten 3 Runden. Du stehst und hälst die Fresse. Damit du das auch schaffst gibts nen Killer.','round',3,NULL),
	(21,'Molotov','Du brennst! Jeder, den du innerhalb der nächsten 5 Sekunden berührst brennt auch! Löscht euch mit einem Killer.',NULL,NULL,NULL),
	(22,'Chancengleichhheit','Der Spieler mit den am wenigsten getrunkenen Einheiten darf nun auch mal mit einem Killer seine Lippen benetzen.',NULL,NULL,NULL),
	(23,'Rotlichmilieu','Trinke für jede Frau am Tisch einen Killer.',NULL,NULL,'2'),
	(24,'Double Time','Jedes Getränk, was man vor sich stehen hat, wird verdoppelt!',NULL,NULL,NULL),
	(25,'Bling Bling','Derjenige mit dem wenigstens Schmuck am Körper ist out... und bekommt einen Killer. (Es zählen Ringe, Ohrringe, Ketten, Piercings, ...)',NULL,NULL,NULL),
	(26,'Bombe','5 Runden lang darf keiner trinken. Sind diese vorbei, müssen alle Getränke, die vor einem stehen, geext werden.','round',5,NULL),
	(27,'Lungen-Transplatation','Ihr müsst 15 Minuten ohne Rauchen auskommen.','timer',15,NULL),
	(28,'Nachschubprobleme','Du kannst für ein Getränk ein beliebiges anderes zur verfügung stehendes Getränk ersetzen.','round',3,NULL),
	(29,'Killing Spree','Jedes Mal, wenn ihr ein Bier trinken müsst, wird zusätzlich ein Killer getrunken.','round',3,NULL),
	(30,'Banküberfall','Schreit alle \"Hände hoch!\" und reißt die Hände hoch. Wers wirklich gemacht hat, bekommt einen Killer.','',NULL,NULL),
	(31,'Tief-Flieger',' Keiner darf den Boden berühren, also Füße hoch! Gilt solange, bis der erste wieder den Boden berührt und mit einem Killer bestraft wird.',NULL,NULL,NULL),
	(32,'Pakt mit dem Teufel','Wenn du willst, kannst du auf der Stelle einen Killer trinken, und musst dafür für die nächsten 3 Runden nichts trinken.','round',3,NULL),
	(33,'Verrückter Zapfhahn','Würfel, wie viele Killer der Zapfhahn ausschenkt. Verteile sie dann im Uhrzeigersinn an die Mitspieler, dein Linker Nachbar bekommt den ersten.','dice',NULL,NULL),
	(34,'Elitepartner.de','Halte mit deinem linken und rechten Nachbarn Händchen. Trennungsgrund ist wie immer ein Killer für jeden von euch beiden.',NULL,NULL,NULL),
	(35,'Stotteranfall','Die nächsten 3 Runden musst du alles, was du sagen willst doppelt sagen! (Bsp. ich trinke = ich ich trinke trinke)','round',3,NULL),
	(36,'Splash-Damage','Immer, wenn jemand in den nächsten 3 Runden was trinken muss, trinken der linke und rechte Nachbar jeweils die Hälfte mit!','round',3,NULL),
	(37,'Regel-Pflege','Denke dir eine Regel aus, diese gilt für 5 Runden.','round',5,NULL),
	(38,'Montags-Maler','Male ein Bild, welches dich an diesen Abend erinnert.',NULL,NULL,'2'),
	(39,'Pole','Klaue jemanden sein Getränk, was er vor sich stehen hat. Hat keiner ein Getränk vor sich stehen hat, bekommt stattdessen jeder einen Killer.',NULL,NULL,'1'),
	(40,'Platzhirsch','Tausche mit einem Spieler deiner Wahl die Plätze. Also auch die Getränke, die vor euch stehen.',NULL,NULL,NULL),
	(41,'Unbändiger Durst','Exe alle deine Getränke, die vor dir stehen.',NULL,NULL,'3'),
	(42,'Ex und hop','Jeder muss die Getränke, die er ab jezt bekommt DIREKT exen.','round',NULL,'3'),
	(43,'Medusa','Keiner darf dir direkt in die Augen sehen, ansonsten wird er versteinert und muss sich am Ende der Runde mit einem Killer erlösen.','round',NULL,'1'),
	(44,'Schau mir in die Augen, Kleines','Du schaust einem Mitspieler deiner Wahl tief in die Augen. Wer als erster zwinktert oder lacht, wird mit einem Killer bestraft.',NULL,NULL,'1'),
	(45,'Migräne','Eine Hand von dir muss 3 Runden lang deinen Kopf berühren.','round',3,'1'),
	(46,'Börsen-Crash','Jeder, der 2 oder mehr Getränke vor sich stehen hat, muss so lange Getränke exen, bis er nur noch eins vor sich stehen hat.',NULL,NULL,NULL),
	(47,'Granate','Du hast eine alte Granate gefunden. Blöd nur, dass sie in 3 Runden explodiert und dem Halter einen Killer spendiert. Die Granate kann einmal pro Runde für 2 Finger Bier an einen beliebigen Nachbarn weitergegeben werden.','round',3,'1'),
	(48,'Revolverheld','Deine 5 Kugeln in der Trommel haben bisher noch nie ein Ziel verfehlt. Du darfst 5 Finger Bier frei verteilen.',NULL,NULL,NULL),
	(49,'Schweine Hund','Wenn du willst, kansnt du einen Killer trinken. Hast du dies getan, kannst du würfeln. Jeder andere Spieler muss die Augenzahl an Fingern Bier trinken.','dice',NULL,NULL),
	(50,'Grobmotoriker','Spiele 3 Runden mit beiden Armen über Kreuz.','round',3,'1'),
	(51,'Super-GAU','ALLE Mitspieler exen ALLE Getränke, die sie vor sich stehen haben. Danach werden diese wieder aufgefüllt.',NULL,NULL,NULL),
	(52,'Taktlos','Beleidige einen Mitspieler. Versöhnt euch danach wieder mit je 2 Fingern Bier.',NULL,NULL,'1'),
	(53,'Rapper','Sag ein Wort. Dein linker Nachbar muss ein Wort sagen, was sich annähernd darauf reimt - danach sein linker Nachbar und so weiter. Wer als erstes kein Wort findet, muss einen Killer trinken.',NULL,NULL,'1'),
	(54,'Alter Falter','Teile dein Alter durch (3+{x}). Das Ergebnis trinkst du an Fingern Bier.','dice',NULL,'2'),
	(55,'Patent','Du darfst dir für die nächsten 3 Runden ein Wort patentieren lassen. Nur du darfst es benutzten. Jeder andere, der es ausspricht, trinkt einen Killer.','round',3,NULL),
	(56,'Patent-Gott','Du darfst dir für die nächsten 3 Runden einen Buchstaben patentieren lassen. Nur du darfst ihn benutzten. Jeder andere, der ihn ausspricht oder benutzt, trinkt einen Killer.','round',3,NULL);

/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `gameid` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `name`, `gameid`, `points`)
VALUES
	('54201864d64a6','Player 1','542018648628b',399),
	('54201864d64c5','Player 2','542018648628b',457),
	('54201864d64de','Player 3','542018648628b',460);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle user2status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user2status`;

CREATE TABLE `user2status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

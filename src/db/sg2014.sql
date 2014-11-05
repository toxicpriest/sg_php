# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.27)
# Datenbank: sg2014
# Erstellungsdauer: 2014-11-05 15:52:00 +0000
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
  `id` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `gameid` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `size` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Export von Tabelle dumb_saying
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dumb_saying`;

CREATE TABLE `dumb_saying` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `typ` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `dumb_saying` WRITE;
/*!40000 ALTER TABLE `dumb_saying` DISABLE KEYS */;

INSERT INTO `dumb_saying` (`id`, `text`, `typ`)
VALUES
	(1,'akutes Schamlippenflattern',NULL),
	(2,'durch DNA vererbte unheilbare Pussyhaftigkeit',NULL),
	(3,'Arsch-bluten (nicht das eigene Blut)',NULL),
	(4,'Spontane Über-Geilheit auf Channig Tatum ',NULL),
	(5,'Dusche *hust*',NULL),
	(6,'Absichtliches einstuhlen zur Kälteverdrängung',NULL),
	(7,'Das gelöschte Exemplar ist eine Bartlose Missgeburt der Sufe 3',NULL),
	(8,'Die hier gelöschte niedere Lebensform hat Existenz-Verbot',NULL),
	(9,'Termin der eigenen Abtreibung',NULL);

/*!40000 ALTER TABLE `dumb_saying` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle game2task
# ------------------------------------------------------------

DROP TABLE IF EXISTS `game2task`;

CREATE TABLE `game2task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gameid` varchar(255) NOT NULL DEFAULT '',
  `taskid` varchar(255) NOT NULL DEFAULT '',
  `taskparam` varchar(255) NOT NULL DEFAULT '0',
  `taskplayer` varchar(255) DEFAULT NULL,
  `taskplayername` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `itempercent` int(11) NOT NULL DEFAULT '0',
  `lasttask` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Export von Tabelle items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `action` varchar(55) DEFAULT NULL,
  `param` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;

INSERT INTO `items` (`id`, `name`, `desc`, `pic`, `action`, `param`)
VALUES
	(1,'Gefängnisfrei Karte','Du musst das nächste Getränk nicht Trinken ','src/img/prison.png',NULL,NULL),
	(2,'Verdopplungs Karte','Verdoppel ein Getränk eines beliebigen Spielers','src/img/double.png',NULL,NULL),
	(3,'Gold Karte','Schreibe dir 1 Punkt gut ','src/img/gold.png','points',1),
	(4,'Diamant Karte','Schreibe dir 3 Punkte gut','src/img/diamond.png','points',3),
	(5,'Killer!','Schicke jemanden einen Killer! vorbei.','src/img/killer.png',NULL,NULL),
	(6,'ComboBreaker','Du darfst gegen bestehende Regeln ohne Bestrafung verstoßen.(3 min)','src/img/fist.png',NULL,NULL),
	(7,'Glücksrad','Weise eine Aufgabe oder ein gerade erhaltenens Getränk einem zufälligen Spieler zu.','src/img/wheel.jpg','randomplayer',NULL),
	(8,'Dieb','Klaue dem Spieler mit den meisten Punkten 2 davon.','src/img/steal.png','randomsteal',2),
	(9,'Drain','Lasse alle anderen Spieler 1 Punkt verlieren ','src/img/drain.jpg','drain',1),
	(10,'Ex-ekutieren','Ein Spieler deiner Wahl muss eins seiner Getränke exen','src/img/execute.gif',NULL,NULL);

/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `text` varchar(255) NOT NULL DEFAULT '',
  `action` varchar(255) DEFAULT NULL,
  `action_param` int(11) DEFAULT NULL,
  `points` varchar(11) DEFAULT NULL,
  `isPlayerTask` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;

INSERT INTO `tasks` (`id`, `name`, `text`, `action`, `action_param`, `points`, `isPlayerTask`)
VALUES
	(1,'Kraftprobe','Mache X Liegestütze! Für jede so erbrachte Leistung bekommst du einen Finger Bier.','dice',NULL,'2',1),
	(2,'Razzia','Renne X Runden ums Haus/Sofa/... in jeder Runde bekommst du 1 Finger Bier zugesteckt.','dice',NULL,'2',1),
	(3,'Beichte','Beichte jemanden ernsthaft das du Alkoholiker bist. Spüle diese widerliche Lüge mit einem Killer runter.',NULL,NULL,'1',1),
	(4,'Goldkelchen','Gurgel ein Lied mit 2 Fingern Bier. Die anderen dürfen gerne mitmachen!',NULL,NULL,'1',1),
	(5,'Giftmischer','Mische je eine Einheit aller Getränke und trinke das Gebräu','',NULL,'2',1),
	(6,'Verhör','Beantworte den anderen eine persönliche Frage. Die Anderen bekommen für die verwerfliche Frage alle 2 Finger Bier.',NULL,NULL,'1',1),
	(7,'Gib mir Tiernamen','Imitiere ein Tier, das die anderen bestimmen. Bewegung und Geräusche inklusive!',NULL,NULL,'1',1),
	(8,'Untertauchen','Du heißt ab jetzt Frank! Alle anderen müssen dich so ansprechen, also auch keine Kosenamen.',NULL,NULL,'0',1),
	(9,'Banküberfall','Schreit alle Hände hoch! und reißt die Hände hoch. Der letzte bekommt einen Killer und 1 Finger für jeden Ganoven im Raum.',NULL,NULL,NULL,0),
	(10,'Spitzel','Vorsicht! Ein Spitzel ist unter euch! Die nächsten 3 Runden darf keiner etwas sagen.','round',3,NULL,0),
	(11,'Russisch Roulette','Spiel Schnick-Schnack-Schnuck mit einem beliebigem Spieler. Der Verlierer wird mit einem Killer bestraft.',NULL,NULL,'1',1),
	(12,'Last but not Least','Alle exen einen Killer! Der letzte bekommt noch einen!',NULL,NULL,NULL,0),
	(13,'Achtung, der Chef!','Es darf 5 Runden lang nicht gelacht werden!','round',5,NULL,0),
	(14,'Inventur','Legt all euer Kleingeld, was ihr dabei habt, auf den Tisch. Wer am wenigsten hat, bekommt den Killer gratis.',NULL,NULL,NULL,0),
	(15,'Angeschossen','Und das an deiner Lieblingshand! Benutze für alles jetzt nur noch deine schwache Hand. Hält 5 Runden.','round',5,'1',1),
	(16,'Casino-Time','Würfel! Bei 1 - 5 bekommst du entsprechend der Anzahl Finger Bier. Bei einer 6 gibt es FULLHOUSE: Alle anderen bekommen einen Killer.','dice',NULL,'2',1),
	(17,'Desateure werden erschossen','Klogänge sind für alle die nächsten 10 Runden untersagt.','round',10,NULL,0),
	(18,'Amoklauf','Flaschendrehen! Derjenige, auf den die Flasche zeigt, wird erschossen und muss einen Killer trinken. Das wird solange wiederholt, bis die Flasche auf dich zeigt.',NULL,NULL,'1',1),
	(19,'Eine Frage der Ehre','Trinke so viel, wie du möchtest. Die anderen müssen mit dir gleich ziehen.',NULL,NULL,NULL,1),
	(20,'Mobbing','Du bist der Buhmann für die nächsten 3 Runden. Du stehst und hälst die Fresse. Damit du das auch schaffst gibts nen Killer.','round',3,'3',1),
	(21,'Molotov','Du brennst! Jeder, den du innerhalb der nächsten 5 Sekunden berührst brennt auch! Löscht euch mit einem Killer.',NULL,NULL,'1',1),
	(22,'Chancengleichhheit','Der Spieler mit den am wenigsten getrunkenen Einheiten darf nun auch mal mit einem Killer seine Lippen benetzen.',NULL,NULL,NULL,0),
	(23,'Rotlichmilieu','Trinke für jede Frau am Tisch 2 Finger Bier.',NULL,NULL,'2',1),
	(24,'Double Time','Jedes Getränk, was man vor sich stehen hat, wird verdoppelt!',NULL,NULL,NULL,0),
	(25,'Bling Bling','Derjenige mit dem wenigstens Schmuck am Körper ist out... und bekommt einen Killer. (Es zählen Ringe, Ohrringe, Ketten, Piercings, ...)',NULL,NULL,NULL,0),
	(26,'Bombe','5 Runden lang darf keiner trinken. Sind diese vorbei, müssen alle Getränke, die vor einem stehen, geext werden.','round',5,NULL,0),
	(27,'Lungen-Transplatation','Ihr müsst 15 Runden ohne Rauchen auskommen.','round',15,NULL,0),
	(28,'Nachschubprobleme','Du kannst für 5 Runden ein Getränk durch ein beliebiges anderes zur verfügung stehendes Getränk ersetzen.','round',5,NULL,1),
	(29,'Killing Spree','Jedes Mal, wenn ihr ein Bier trinken müsst, wird bis zu einem Killer aufgefüllt. 3 Runden.','round',3,NULL,0),
	(30,'Banküberfall','Schreit alle Hände hoch! und reißt die Hände hoch. Wers wirklich gemacht hat, bekommt einen Killer.','',NULL,NULL,0),
	(31,'Tief-Flieger',' Keiner darf den Boden berühren, also Füße hoch! Gilt solange, bis der erste wieder den Boden berührt und mit einem Killer bestraft wird.',NULL,NULL,NULL,0),
	(32,'Pakt mit dem Teufel','Wenn du willst, kannst du auf der Stelle einen Killer trinken, und musst dafür für die nächsten 3 Runden nichts trinken.','round',3,NULL,1),
	(33,'Verrückter Zapfhahn','Würfel, wie viele Killer der Zapfhahn ausschenkt. Verteile sie dann im Uhrzeigersinn an die Mitspieler, dein Linker Nachbar bekommt den ersten.','dice',NULL,NULL,1),
	(34,'Elitepartner.de','Halte mit deinem linken oder rechten Nachbarn Händchen. Schafft ihr das 10 Runden lang ist es wahre Liebe und alle anderen bekommen einen Killer ansonsten bekommt Ihr einen.','round',10,'1',1),
	(35,'Stotteranfall','Die nächsten 3 Runden musst du alles, was du sagen willst doppelt sagen! (Bsp. ich trinke = ich ich trinke trinke)','round',3,'1',1),
	(36,'Splash-Damage','Immer, wenn jemand in den nächsten 3 Runden was trinken muss, trinken der linke und rechte Nachbar jeweils die Hälfte mit!','round',3,NULL,0),
	(37,'Regel-Pflege','Denke dir eine Regel aus, diese gilt für 5 Runden(Die Regel muss alle Spieler gleichermaßen betreffen).','round',5,NULL,1),
	(38,'Montags-Maler','Male ein Bild, welches dich an diesen Abend erinnert.',NULL,NULL,'2',1),
	(39,'Pole','Klaue jemanden sein Getränk, was er vor sich stehen hat. Hat keiner ein Getränk vor sich stehen hat, bekommt stattdessen jeder einen Killer.',NULL,NULL,'1',1),
	(40,'Platzhirsch','Tausche mit einem Spieler deiner Wahl die Plätze. Also auch die Getränke, die vor euch stehen.',NULL,NULL,NULL,1),
	(41,'Unbändiger Durst','Exe alle deine Getränke, die vor dir stehen.',NULL,NULL,'3',1),
	(42,'Ex und hop','Jeder muss die Getränke, die er ab jezt bekommt DIREKT exen. 3 Runden.','round',3,'',0),
	(43,'Medusa','Keiner darf dir direkt in die Augen sehen, ansonsten wird er versteinert und muss sich am Ende der Runde mit einem Killer erlösen.','round',1,'1',1),
	(44,'Schau mir in die Augen, Kleines','Du schaust einem Mitspieler deiner Wahl tief in die Augen. Wer als erster zwinktert oder lacht, wird mit einem Killer bestraft.',NULL,NULL,'1',1),
	(45,'Migräne','Eine Hand von dir muss 3 Runden lang deinen Kopf berühren.','round',3,'1',1),
	(46,'Börsen-Crash','Jeder, der 2 oder mehr Getränke vor sich stehen hat, muss so lange Getränke exen, bis er nur noch eins vor sich stehen hat.',NULL,NULL,NULL,0),
	(47,'Granate','Du hast eine alte Granate gefunden. Blöd nur, dass sie in 3 Runden explodiert und dem Halter einen Killer spendiert. Die Granate kann einmal pro Spieler in jeder Runde für 2 Finger Bier an einen beliebigen Nachbarn weitergegeben werden.','round',3,'1',1),
	(48,'Revolverheld','Deine 5 Kugeln in der Trommel haben bisher noch nie ein Ziel verfehlt. Du darfst 5 Finger Bier frei verteilen.',NULL,NULL,NULL,1),
	(49,'Schweine Hund','Wenn du willst, kansnt du einen Killer trinken. Hast du dies getan, kannst du würfeln. Jeder andere Spieler muss die Augenzahl an Fingern Bier trinken.','dice',NULL,NULL,1),
	(50,'Grobmotoriker','Spiele 3 Runden mit beiden Armen über Kreuz.','round',3,'1',1),
	(51,'Super-GAU','ALLE Mitspieler exen ALLE Getränke, die sie vor sich stehen haben. Danach werden diese wieder aufgefüllt.',NULL,NULL,NULL,0),
	(52,'Taktlos','Beleidige einen Mitspieler. Versöhnt euch danach wieder mit je 2 Fingern Bier.',NULL,NULL,'1',1),
	(53,'Rapper','Sag ein Wort. Dein linker Nachbar muss ein Wort sagen, was sich annähernd darauf reimt - danach sein linker Nachbar und so weiter. Wer als erstes kein Wort findet, muss einen Killer trinken.',NULL,NULL,'1',1),
	(54,'Alter Falter','Teile dein Alter durch (3+{x}). Das Ergebnis trinkst du an Fingern Bier.','dice',NULL,'2',1),
	(55,'Patent','Du darfst dir für die nächsten 3 Runden ein Wort patentieren lassen. Nur du darfst es benutzten. Jeder andere, der es ausspricht, trinkt einen Killer.','round',3,NULL,1),
	(56,'Patent-Gott','Du darfst dir für die nächsten 3 Runden einen Buchstaben patentieren lassen. Nur du darfst ihn benutzten. Jeder andere, der ihn ausspricht oder benutzt, trinkt einen Killer.','round',3,NULL,1),
	(57,'Untertauchen','Du heißt ab jetzt Paula! Alle anderen müssen dich so ansprechen, also auch keine Kosenamen.',NULL,NULL,'0',1),
	(58,'Unentschlossen','Ihr dürft die nächsten 5 Runden weder Ja oder Nein sagen.','round',5,'0',0),
	(59,'Akute Piraterietis','für die nächsten 5 Runden muss jeder Satz mit einem Aaaaargh beendet werden.','round',5,'0',0),
	(60,'Beton-Tod','die anderen suchen dir ein Getränk aus (Eines der Eingetragenen) und du trinkst die höchste Einheit dieses Getränks.',NULL,NULL,'3',1),
	(61,'Ab in die Matrix','Der letzte Spieler der den Bildschirm berührt bekommt einen Killer.','',NULL,'0',0),
	(62,'Stammesbesprechung','Der letzte Spieler der Im Schneidersitz auf dem Boden sitzt bekommt einen Killer.','',NULL,'0',0),
	(64,'Grabsch','','random',NULL,'0',0),
	(65,'Grabsch','','random',NULL,'0',0),
	(66,'Grabsch','','random',NULL,'0',0),
	(67,'Melonen Liebhaber','Der letzte Spieler der beide Hände auf seiner Brust hat bekommt einen Killer.','',NULL,'0',0),
	(69,'Auch ein blindes Huhn...','Du musst mit verbundenen Augen einen Gegenstand erraten(ertasten). Schaffst du es nicht beim erstenmal gibt es einen Killer. Schaffst du es allerdings bekommen alle anderen einen Killer.',NULL,NULL,'1',1),
	(70,'Zickenstreit','Wenn deine beiden Nachbarn vom gleichen Geschlecht sind trinken die beiden jeweils einen Killer ansonsten trinkst du einen.',NULL,NULL,'1',1),
	(71,'Platt-Fuss','Nenne reihum von jedem Mitspieler die Schuhgröße jedesmal wenn du falsch liegst gibt es einen Finger Bier.','',NULL,'2',1),
	(73,'Little Joe','Der größte Spieler trinkt 2 Finger Bier',NULL,NULL,'0',0),
	(74,'Wurf-Maschine','Der Spieler mit den meisten Geschwistern trinkt einen Killer.',NULL,NULL,'0',0),
	(75,'Alles auf Rot','Wähle einen Einsatz von 1-5 Fingern Bier. Wenn du eine 1-3 würfelst darfst den Einsatz frei verteilen. Bei 4-6 musst du ihn selbst trinken.','dice',NULL,'1',1),
	(76,'Verdammt hell hier','Trinke für jedes Fenster in dem Raum einen Finger Bier (keine Tür = gleiches Zimmer).',NULL,NULL,'2',1),
	(77,'Ultimativer Regulator','Bestimme eine Regel diese gilt für 15 Runden (Die Regel muss alle Spieler gleichermaßen betreffen).','round',15,'0',1),
	(78,'Notbremse','Derjenige mit den meisten Punkten trinkt einen Killer.','',NULL,'0',0),
	(79,'Zungen Amputation','Versuche So schnell wie möglich folgeden Satz fehlerfrei vorzutragen gelingt ist trinken alle anderen 1 Killer ansonsten trinkst du 2 Finger Bier. \"Der Whiskeymixer mixt frischen Whiskey\".',NULL,NULL,'2',1),
	(80,'Zigeuner Fluch','Eine alte Zigeuner Dame hat dich verflucht. Um das ganze rückgängig zu machen spreche deinen Namen 3 x rückwärts aus und trinke danach einen Shot.',NULL,NULL,'2',1);

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
  `timesplayed` int(11) DEFAULT '0',
  `timestasked` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Export von Tabelle user2item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user2item`;

CREATE TABLE `user2item` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `userid` varchar(255) NOT NULL DEFAULT '',
  `itemid` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

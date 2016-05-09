# mastery-data
LOL - Champion Mastery Data

This application is useful for consult your progress with your champions and share it with your friends on facebook. The tool displays a list of the champions you’ve used, from the highets to the lower level. For every champion It show the avatar, the spells with their descriptions and the ulty power, along the achivements obtained on curse. On the left side of the aplication is a twitter box to being in contact with social media with the trending topin #LeagueOfLeguens. This aplication helps keeping you aware of your achivements and compare your profile with other players. It’s a record of progress that can be consulted by any person around the world so take a moment to check the best players in the world, or anyone you find interesting.

HIGHLIGHTS

• Twitter implementation
• Responsive Design, you can use this tool with a desktop computer, tablet or with a mobile
• Friendly design
• Easy use
• Complete champion mastery data
• Total Score to compare with your friends
• Look if you have won a chest with the champion
• Share with your friends


INSTALLATION

Fork this app.

Create a database named "lolmaster"

Execute this script in the database:
NOTE: before running the script change the word YOURAPIKEY in the last insert line with your api key provided by League of Legends.

/* Script init*/
DROP TABLE IF EXISTS lolmaster.`cat_region`;

CREATE TABLE lolmaster.`cat_region` (
  `idcat_region` int(11) NOT NULL AUTO_INCREMENT,
  `reg_region` varchar(45) DEFAULT NULL,
  `reg_platform` varchar(45) DEFAULT NULL,
  `reg_host` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcat_region`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO lolmaster.`cat_region` VALUES (1,'BR','BR1','br.api.pvp.net'),(2,'EUNE','EUN1','eune.api.pvp.net'),(3,'EUW','EUW1','euw.api.pvp.net'),(4,'JP','JP1','jp.api.pvp.net'),(5,'KR','KR','kr.api.pvp.net'),(6,'LAN','LA1','lan.api.pvp.net'),(7,'LAS','LA2','las.api.pvp.net'),(8,'NA','NA1','na.api.pvp.net'),(9,'OCE','OC1','oce.api.pvp.net'),(10,'TR','TR1','tr.api.pvp.net'),(11,'RU','RU','ru.api.pvp.net');

DROP TABLE IF EXISTS lolmaster.`sys_data`;

CREATE TABLE lolmaster.`sys_data` (
  `idsys_data` int(11) NOT NULL AUTO_INCREMENT,
  `dat_key` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsys_data`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO lolmaster.`sys_data` VALUES (1,'YOURAPIKEY');
/* Script End*/


Go to application/config/config.php
And change $config['base_url'] = 'http://localhost/masterydata' 
to $config['base_url'] = 'http://YOURSERVER/FILENAME'

Go to application/config/constants.php
And change define('URL','http://localhost/masterydata');
to define('URL','http://YOURSERVER/FILENAME');

Go to application/config/database.php
And change 
'hostname' => 'localhost',
'username' => 'user',
'password' => 'pass',
'database' => 'database',
to 
'hostname' => 'YOURSERVER',
'username' => 'YOURUSERNAME',
'password' => 'YOURPASSWORD',
'database' => 'YOURDATABASE',

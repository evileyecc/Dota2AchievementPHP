--
-- MySQL 5.6.17
-- Mon, 29 Jun 2015 07:38:04 +0000
--

CREATE TABLE `achievement` (
   `id` mediumint(10) not null auto_increment,
   `name` varchar(255) not null,
   `description` varchar(255),
   `point` int(10) default '0',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;


CREATE TABLE `user` (
   `id` int(10) not null auto_increment,
   `SteamID` varchar(255) default '0',
   `achievement` varchar(255) default '',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
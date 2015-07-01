--
-- MySQL 5.6.17
-- Wed, 01 Jul 2015 07:46:31 +0000
--

CREATE TABLE `achievement` (
   `id` mediumint(10) not null auto_increment,
   `name` varchar(255) not null,
   `description` varchar(255),
   `point` int(10) default '0',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;


CREATE TABLE `admin` (
   `id` int(10) not null auto_increment,
   `username` varchar(255),
   `password` varchar(255),
   `salt` varchar(5),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `user` (
   `id` int(10) not null auto_increment,
   `SteamID` varchar(255) default '0',
   `achievement` varchar(255) default 'null',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
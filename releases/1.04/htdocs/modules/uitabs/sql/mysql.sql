
CREATE TABLE `uitabs_items` (
  `iid` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned DEFAULT '0',
  `title` varchar(128) DEFAULT NULL,
  `summary` varchar(1500),
  `description` mediumtext,
  `path` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `extension` varchar(4) DEFAULT NULL,
  `width` int(5) unsigned DEFAULT '0',
  `height` int(5) unsigned DEFAULT '0',
  `pid` int(30) unsigned DEFAULT '0',
  `fid` int(30) unsigned DEFAULT '0',
  `url` varchar(500) DEFAULT NULL,
  `uid` int(13) unsigned DEFAULT '0',
  `votes` int(10) unsigned DEFAULT '0',
  `rating` decimal(10,4) unsigned DEFAULT '0.0000',
  `clicks` int(30) unsigned DEFAULT '0',
  `rate` tinyint(2) unsigned DEFAULT '0',
  `created` int(13) unsigned DEFAULT '0',
  `updated` int(13) unsigned DEFAULT '0',
  `clicked` int(13) unsigned DEFAULT '0',
  `tags` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `uitabs_tabs` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `weight` int(5) unsigned DEFAULT '0',
  `uid` int(13) unsigned DEFAULT '0',
  `random` tinyint(2) unsigned DEFAULT '0',
  `recommend` tinyint(2) unsigned DEFAULT '0',
  `default` tinyint(2) unsigned DEFAULT '0',
  `created` int(13) unsigned DEFAULT '0',
  `updated` int(13) unsigned DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `uitabs_votes` (
  `vid` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(30) unsigned DEFAULT '0',
  `ip` varchar(64) DEFAULT NULL,
  `rating` decimal(10,4) unsigned DEFAULT '0.0000',
  `uid` int(13) unsigned DEFAULT '0',
  `created` int(13) unsigned DEFAULT '0',
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

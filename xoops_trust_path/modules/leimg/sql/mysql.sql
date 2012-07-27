CREATE TABLE `{prefix}_{dirname}_image` (
  `image_id` int(11) unsigned NOT NULL	auto_increment,
  `title` varchar(255) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `dirname` varchar(25) NOT NULL,
  `dataname` varchar(25) NOT NULL,
  `data_id` int(11) unsigned NOT NULL,
  `num` int(3) unsigned NOT NULL,
  `file_name` varchar(60) NOT NULL,
  `file_type` int(3) unsigned NOT NULL,
  `image_width` int(5) unsigned NOT NULL,
  `image_height` int(5) unsigned NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`image_id`),
  KEY `data` (`dirname`, `dataname`, `data_id`) ,
  KEY `uid` (`uid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_thumbnail` (
  `thumbnail_id` int(11) unsigned NOT NULL	auto_increment,
  `dirname` varchar(25) NOT NULL,
  `dataname` varchar(25) NOT NULL,
  `max_width` int(5) unsigned NOT NULL,
  `max_height` int(5) unsigned NOT NULL,
  `file_type` int(3) unsigned NOT NULL,
  `tsize` int(3) unsigned NOT NULL,
  PRIMARY KEY  (`thumbnail_id`),
  KEY `data` (`dirname`, `dataname`)
) ENGINE=MyISAM;

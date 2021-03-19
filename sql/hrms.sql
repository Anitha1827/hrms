CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL auto_increment,	
  `name` varchar(30) NOT NULL,
  `description` varchar(200)  NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

INSERT INTO `roles` (`id`,  `name`, `description`) VALUES
(1, 'admin', 'Overall access, Can see everything'),
(2, 'hr', 'Can manage who in a company hr activities'),
(3, 'employee', 'Can apply leave,view leave status and payroll.');

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL auto_increment,
`role_id` int(11) NOT NULL default '1',
`fname` varchar(50) NOT NULL,
`lname` varchar(50) DEFAULT NULL,
`password` varchar(200) NOT NULL,
`phone` varchar(14) DEFAULT NULL,
`mobile` varchar(14) DEFAULT NULL,
`email` varchar(100) NOT NULL,
`gender` enum('Male','Female','Transgender') NOT NULL,
`is_active` TINYINT(4) NOT NULL DEFAULT '1',  
`oldpass` varchar(34) default NULL,
`newpass_key` varchar(32) default NULL,
`newpass_time` datetime default NULL,  
`last_login` datetime NOT NULL default CURRENT_TIMESTAMP,
`created_by` int(11) DEFAULT NULL,
`created_on` datetime DEFAULT NULL,
`last_updated_by` int(11) DEFAULT NULL,
`last_updated_on` datetime DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `role_id`, `fname`, `lname`, `password`, `email`) VALUES
(1, 1, 'lakshmi', 'sajjan', '$2y$10$g9D6NSDxur/Ycib8nWIwbOsSBAPvwSuzOSYHknayZk6weRk.vcJDC', 'mahalakshmi@pointservices.se');


CREATE TABLE `settings` (
  `id` int(11) NOT NULL auto_increment,
  `sitelogo` varchar(128) DEFAULT NULL,
  `sitetitle` varchar(256) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `copyright` varchar(128) DEFAULT NULL,
  `contact` varchar(128) DEFAULT NULL,
  `currency` varchar(128) DEFAULT NULL,
  `symbol` varchar(64) DEFAULT NULL,
  `system_email` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `address2` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `holiday` (
	`id` int(11) NOT NULL auto_increment,
	`title` varchar(255) NOT NULL,
	`start_date` date NOT NULL,
	`end_date` date NOT NULL,
	`created_by` int(11) DEFAULT NULL,
	`created_on` datetime DEFAULT NULL,
	`last_updated_by` int(11) DEFAULT NULL,
	`last_updated_on` datetime DEFAULT NULL,
	`status` int(1) NOT NULL DEFAULT 1,
	 PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


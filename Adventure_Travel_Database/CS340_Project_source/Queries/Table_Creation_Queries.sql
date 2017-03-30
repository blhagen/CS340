/**************************************************************************************
Course:		CS 340		
Names: 		Ambrelle Palmer, Brook Hagen
Date:		11/2016
Content:	Table creation queries for CS340 final project, an outdoor adventure app 			
		database.
***************************************************************************************/


CREATE TABLE user(
	id int(10) NOT NULL AUTO_INCREMENT,
	f_name varchar(20) NOT NULL,
	l_name varchar(20) NOT NULL,
	dob date NOT NULL,
	zip_code int(5) NOT NULL,
	UNIQUE KEY (f_name, l_name),
	PRIMARY KEY (id)
	) ENGINE=InnoDB;


-- We needed an additional table to represent the 'tribe' attribute that could have 
-- 	multiple values.
-- This works, but is it the correct way to represent the multiple-value attribute 
--   'tribes' in the 'user' table? 
-- Each user's id will be associated with zero to many 'tribe-name's.
--   'tribe_name', or activity, eg, 'trail running', 'skiing', etc. in a separate row.
CREATE TABLE tribes(
	uid int(10) NOT NULL DEFAULT '0',
	tribe_name varchar(20) NOT NULL,
	PRIMARY KEY (uid, tribe_name),
	FOREIGN KEY	(uid) REFERENCES user(id)
	) ENGINE=InnoDB;


/* source for timestamp definition: 
	http://dev.mysql.com/doc/refman/5.7/en/timestamp-initialization.html */
CREATE TABLE photo(
	id int(10) NOT NULL AUTO_INCREMENT,
	uid int(10) DEFAULT NULL,
	date_created TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (uid) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE
	) ENGINE=InnoDB;


-- how to add the date as a timestamp that won’t update every time the list id modified
-- source: http://sql-info.de/mysql/examples/CREATE-TABLE-examples.html
CREATE TABLE list(
	id int(10) NOT NULL AUTO_INCREMENT,
	uid int(10) NOT NULL,
	aid int(10) DEFAULT NULL,
	name varchar(255) NOT NULL,
	date_created TIMESTAMP DEFAULT NOW(),
	PRIMARY KEY (id),
	FOREIGN KEY (uid) REFERENCES user (id),
	FOREIGN KEY (aid) REFERENCES adventures(id) ON DELETE CASCADE ON UPDATE CASCADE
	) ENGINE=InnoDB;


-- Create an item associated with a list
CREATE TABLE item(
	id int(10) NOT NULL AUTO_INCREMENT,
	lid int(10) NOT NULL,
	description varchar(100) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (lid) REFERENCES list (id)
	) ENGINE=InnoDB;


-- Table that will represent an adventure 
-- added 's' to 'adventure' bc I needed to create a new table
CREATE TABLE adventures(
	id int(10) NOT NULL AUTO_INCREMENT,
	description varchar(255) NOT NULL,
	uid int(10) NOT NULL,
	depart_date date DEFAULT NULL,
	return_date date DEFAULT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (uid) REFERENCES user(id)
	) ENGINE=InnoDB;


-- Table to represent the relationship between users and his/her adventures
CREATE TABLE user_adventure(
	uid int(10) NOT NULL,
	aid int(10) NOT NULL,
	PRIMARY KEY (uid, aid),
	FOREIGN KEY (uid) REFERENCES user(id),
	FOREIGN KEY (aid) REFERENCES adventures(id) ON DELETE CASCADE ON UPDATE CASCADE
	) ENGINE=InnoDB;



/***************************************************************************************
Course:		CS 340		
Names: 		Ambrelle Palmer, Brook Hagen
Date:		11/2016
Content:	General use queries for CS340 final project, an outdoor adventure app
 		database.
***************************************************************************************/

/*------------------------ INSERT INTO Queries ______________________________*/

-- Add a new User
INSERT INTO user (f_name, l_name, dob, zip_code) 
	VALUES ([f_name], [l_name], [dob], [zip_code]);


-- add a 'tribe'/activity to a user's user_tribe_id
INSERT INTO tribes (uid, tribe_name)
	VALUES ((SELECT id FROM user WHERE id = [uid]), [tribe_name]);


-- Add a new Photo
/* source for timestamp information: 
**	http://dev.mysql.com/doc/refman/5.7/en/timestamp-initialization.html */
INSERT INTO photo (uid, date_created)
	VALUES ((SELECT id FROM user WHERE id = [uid]), CURRENT TIMESTAMP));


-- Add a new List
-- update 11/27/16
INSERT INTO list (uid, aid, name, date_created)
	VALUES ((SELECT id FROM user WHERE id = [uid]), 
		(SELECT id FROM adventures WHERE id = [aid]), [name], CURRENT TIMESTAMP);


-- Add an Item to a List
INSERT INTO item (list_id, description)
	VALUES((SELECT id FROM list WHERE id = [lid]), [description]);


-- Add a new Adventure
INSERT INTO adventures (uid, description, depart_date, return_date)
	VALUES([description], (SELECT id FROM user WHERE id = [uid]), [depart_date], [return_date]);


-- add an additional user to an adventure
INSERT INTO user_adventure(uid, aid)
	VALUES((SELECT id FROM user WHERE id = [uid]), 
		(SELECT id FROM adventures WHERE id = [adventureID]));


/*-------------------------- SELECT (All) Queries ____________________________*/

-- Get all users 
SELECT *
	FROM user; 


-- Get all tribes
SELECT *
	FROM tribes;


-- Get all photos
SELECT * 
	FROM photo;


-- Get all lists
SELECT *
	FROM list;


-- Get all items on every list
SELECT *
	FROM item;


-- Get all adventures
SELECT *
	FROM adventures;


/*-------------------------- FILTER Queries ________________________________*/

-- Get all Users of a particular Tribe
SELECT f_name, l_name
	FROM user u
	INNER JOIN tribes t ON t.uid = u.id
	WHERE t.tribe_name = '[some_activity]';


-- Get a User’s Photos by user's id
SELECT id, date_created
	FROM photo p
	INNER JOIN user ON photo.uid = user.id
	WHERE user.id = '[userid]';


-- Get all items on a List by list name - OK
SELECT description
	FROM item i
	INNER JOIN list l ON i.lid = l.id
	WHERE l.name = '[listName]';


-- Get all Users on a particular Adventure - OK
SELECT user.f_name, user.l_name
	FROM user
	INNER JOIN user_adventure ON user.id = user_adventure.uid
	INNER JOIN adventures ON user_adventure.aid = adventures.id
	WHERE adventures.description =  '[description]';


/*-------------------------- UPDATE Queries ________________________________*/

-- update user's location by user id  
UPDATE user
	SET zip_code = [new_zip_code]
	WHERE id = [userID];


-- update user's last name by user id
UPDATE user
	SET l_name = [new_last_name]
	WHERE id = [userID];


/*-------------------------- DELETE Queries ________________________________*/

-- Delete tribe from user by tribe name and user id
DELETE FROM tribes 
	WHERE tribes.uid = [userID] 
	AND tribes.tribe_name = [tribe_name];


-- Delete item from list by list id and item description
DELETE FROM item 
	WHERE item.description = [itemDescription] AND item.lid = [list_ID];









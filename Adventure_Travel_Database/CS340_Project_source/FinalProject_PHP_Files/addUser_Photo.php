<!-- 
Course:		CS 340		
Names: 		Ambrelle Palmer, Brook Hagen
Date:		11/2016
Content:	addUser_Photo.php for CS340 final project, an outdoor adventure app database.
 -->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hagenb-db","TivBx2zPfTAN9Enf","hagenb-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
//the INSERT INTO names are the actual column names
//Don't know what the values are yet, so use ??	

//var $aid = ($aid != '') ? $aid : NULL;
if(!($stmt = $mysqli->prepare("INSERT INTO user_photos(uid, pid) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
//bind_param statment takes arguments: string of types and mixed list of variables. In 
// our case, we have two strings and two integers, ssii
//$_POST means that values will be stored in POST array on the server side
// POST array is an associative array (key:value) = input: 'Firstname' (from HTMLexample)
//  order matters - must be in same order as in the bind_param list.
if(!($stmt->bind_param("ii",$_POST['userID'], $_POST['photoID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
//check for errors
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
//should successfully add one row to bsg_people.
else {
	echo "Added " . $stmt->affected_rows . " user-photo relationship.";
}

$stmt->close();

?>
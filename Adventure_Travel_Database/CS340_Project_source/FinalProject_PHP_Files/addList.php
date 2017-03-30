<!-- 
Course:		CS 340		
Names: 		Ambrelle Palmer, Brook Hagen
Date:		11/2016
Content:	addList.php for CS340 final project, an outdoor adventure app database.
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

//var aid = NULL;
if(!($stmt = $mysqli->prepare("INSERT INTO list(uid, aid, name, date_created) VALUES (?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
//https://www.tutorialspoint.com/mysql/mysql-insert-query.htm
// if(aid == '') {
// 	$_POST['adventureID'] = NULL;
// }
// else {
// 	$_POST['adventureID'];
// }
//bind_param statment takes arguments: string of types and mixed list of variables. In 
// our case, we have two strings and two integers, ssii
//$_POST means that values will be stored in POST array on the server side
// POST array is an associative array (key:value) = input: 'Firstname' (from HTMLexample)
//  order matters - must be in same order as in the bind_param list.
if(!($stmt->bind_param("iiss",$_POST['userID'], $_POST['adventureID'], $_POST['listName'], $_POST['listDate']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
//check for errors
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
//should successfully add one row to bsg_people.
else {
	echo "Added " . $stmt->affected_rows . " list.";
}

$stmt->close();

?>
<!-- 
Course:		CS 340		
Names: 		Ambrelle Palmer, Brook Hagen
Date:		11/2016
Content:	updateLastName.php for CS340 final project, an outdoor adventure app database.
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
if(!($stmt = $mysqli->prepare("UPDATE user SET l_name='Hagen' WHERE f_name='Brook' AND l_name='Kohls'"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}


//check for errors
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
//should successfully add one row to bsg_people.
else {
	echo "Updated " . $stmt->affected_rows . " last name.";
}
$stmt->close();
?>
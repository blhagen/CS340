<!--
Course:		CS 340		
Names: 		Ambrelle Palmer, Brook Hagen
Date:		11/2016
Content:	filterPhotosByUser.php, for CS340 final project, an outdoor adventure app 				database.
Note: this query works fine in myPHPAdmin, but is not working on the site 04Dec16 12:48.
 -->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hagenb-db","TivBx2zPfTAN9Enf","hagenb-db");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<div>
	<table>
		<tr>
			<td>User's Photos</td>
		</tr>
		<tr>
			<td>Photo ID</td>
			<td>Date Taken</td>
		</tr>
<?php

if(!($stmt = $mysqli->prepare("SELECT photo.id, photo.date_created FROM photo WHERE photo.uid = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['userID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $date_created)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $date_created . "\n</td>\n</tr>";
}
$stmt->close();
?>

	</table>
</div>

</body>
</html>
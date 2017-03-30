

<!-- 
Course:		CS 340		
Names: 		Ambrelle Palmer, Brook Hagen
Date:		11/2016
Content:	filterByTribe.php for CS340 final project, an outdoor adventure app database.
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
			<td>Tribe People</td>
		</tr>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Tribe Name</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT user.f_name, user.l_name, tribes.tribe_name FROM user INNER JOIN tribes ON tribes.uid = user.id WHERE tribes.tribe_name = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s",$_POST['tribe_name']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($f_name, $l_name, $tribe_name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $f_name . "\n</td>\n<td>\n" . $l_name . "\n</td>\n<td>\n" . $tribe_name . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>
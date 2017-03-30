<!-- 
Course:		CS 340		
Names: 		Ambrelle Palmer, Brook Hagen
Date:		11/2016
Content:	adventureTable.php for CS340 final project, an outdoor adventure app database.
 -->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
//server address (hostname), db username, db password, 
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hagenb-db","TivBx2zPfTAN9Enf","hagenb-db");
/*check to see if there is a connection error - it will show up in this attribute of the mySql object.  'connect_errno' = error number, 'connect_error' = error description*/
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
<body>
	<div>
		<table>
			<tr>
				<td>Adventure</td>
			</tr>
			<tr>
				<td>ID</td>
				<td>Description</td>
				<td>Owner ID</td>
				<td>Departure Date</td>
				<td>Return Date</td>
			</tr>
<?php

//build the table
if (!($stmt = $mysqli->prepare("SELECT adventures.id, adventures.description, adventures.uid, adventures.depart_date, adventures.return_date FROM adventures"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()) {
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//bind results to variable names
if(!$stmt->bind_result($id, $description, $uid, $depart_date, $return_date)) {
	echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/*$stmt->fetch will get the next row of results, if row exists, & put it into variables */
while ($stmt->fetch()) {
	echo "<tr>\n<td>" . $id . "\n</td>\n<td>" . $description . "\n</td>\n<td>" . $uid . "</td>\n<td>" . $depart_date . "</td>\n<td>" . $return_date . "</td\n</tr>";
}
$stmt->close();
?>

		</table>
	</div>
	<div>
          <form method="post" action="addAdventure.php"> 
               <fieldset>
                    <legend>Adventure Information</legend>
                    <p>Description:<input type="text" name="description"/></p>
                    <p>Owner User ID:<input type="text" name="userID"/></p>
                    <p>Departure Date:<input type="date" name="departDate"/></p>
                    <p>Return Date: <input type="date" name="returnDate"/></p>
                    <p><input type="submit" value="Add Adventure" /></p>
               </fieldset>
          </form>
    </div>
 	<div>
		<table>
			<tr>
				<td><h3>Users on Adventures</h3></td>
			</tr>
			<tr>
				<td>User Id</td>
				<td>Adventure ID</td>
			</tr>
<?php

//build the table
if (!($stmt = $mysqli->prepare("SELECT user_adventure.uid, user_adventure.aid FROM user_adventure"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()) {
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//bind results to variable names
if(!$stmt->bind_result($uid, $aid)) {
	echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/*$stmt->fetch will get the next row of results, if row exists, & put it into variables */
while ($stmt->fetch()) {
	echo "<tr>\n<td>" . $uid . "\n</td>\n<td>" . $aid . "\n</td>\n<tr>";
}
$stmt->close();
?>

		</table>
	</div>
	<div>
          <form method="post" action="addUser_Adventure.php"> 
               <fieldset>
                    <legend>Add a User to an Adventure</legend>
                    <p>User ID:<input type="text" name="userID"/></p>
                    <p>Adventure ID:<input type="text" name="adventureID"/></p>
                    <p><input type="submit"/></p>
               </fieldset>
          </form>
    </div>

    <div>
          <form method="post" action="filterUsersByAdventureName.php">
               <fieldset>
                    <legend>List User Names By Adventure</legend>
                         <p>Adventure Name: <input type="text" name="description" /></p>
               </fieldset>
               <input type="submit" value="Run Filter" />
          </form>
     </div>


</body>
</html>


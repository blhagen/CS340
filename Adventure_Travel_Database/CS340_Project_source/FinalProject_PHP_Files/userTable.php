<!-- 
Course:		CS 340		
Names: 		Ambrelle Palmer, Brook Hagen
Date:		11/2016
Content:	userTable.php for CS340 final project, an outdoor adventure app database.
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
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<h2>Welcome to our outdoor adventure organization site</h2>
	<p>The aim of this site is to help you organize your outdoor camping, hiking, etc. trips by keeping all the relevant information in one place.</p>

<h3>This is the User Page</h3>
	<p>Below, you see all users already entered into the database. Continue exploring the site to add more users, photo information, adventures, gear lists and people to your next trip.</p>
	<div>
		<table>
			<tr>
				<td><h3>Users</h3></td>
			</tr>
			<tr> 
				<td>ID</td>
				<td>First Name</td>
				<td>Last Name</td>
				<td>Birth Date</td>
				<td>Zip Code</td>
			</tr>

<?php

//build the table
if (!($stmt = $mysqli->prepare("SELECT user.id, user.f_name, user.l_name, user.dob, user.zip_code FROM user"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()) {
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//bind results to variable names
if(!$stmt->bind_result($id, $f_name, $l_name, $dob, $zip_code)) {
	echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/*$stmt->fetch will get the next row of results, if row exists, & put it into variables */
while ($stmt->fetch()) {
	echo "<tr>\n<td>" . $id . "\n</td>\n<td>" . $f_name . "\n</td>\n<td>" . $l_name . "</td>\n<td>" . $dob . "</td>\n<td>" . $zip_code . "</td\n</tr>";
}
$stmt->close();
?>

</table>
</div>

	<div>
		<form method="post" action="addUser.php">
			<fieldset>
				<legend>Add A New User</legend>
				<h3>User Information</h3>
				<p>First Name: <input type="text" name="FirstName"/></p>
				<p>Last Name: <input type="text" name="LastName"/></p>
				<p>Birth Date: <input type="date" name="DOB"/></p>
				<p>Zip Code:<input type="text" name="ZipCode"/></p>
				<p><input type="submit" value="Add User"/></p>
			</fieldset>		
		</form>
	</div>
<!-- Update Last name and/or Zip code
	Need to do more research on how to do this, but the forms are set up
 -->	<div>
		<form method="post" action="updateLastName.php">
			<fieldset>
				<legend>Update Last Name</legend>
					<p>Input 'Brook' for first name and 'Hagen' for last name to update last name to 'Kohls':</p>
					<p>First Name: <input type="text" name="FirstName"/>  Last name: <input type="text" name="lastName"/></p>
<!-- 					<p>New Last Name: <input type="text" name="LastName"/></p>
 -->					<p><input type="submit" name="update" value="Update LastName"/></p>
			</fieldset>
		</form>
		</div>

		<div>
		<form method="post" action="updateZipCode.php">
			<fieldset>
				<legend>Update Zip Code</legend>
					<p>Input 'Chris' for first name and 'Hagen' for last name to update zip code to 80526:</p>
					<p>First Name: <input type="text" name="FirstName"/>  Last name: <input type="text" name="lastName"/></p>
<!-- 					<p>New Zip Code: <input type="text" name="LastName"/></p>
 -->					<p><input type="submit" name="update" value="Update ZipCode"/></p>
			</fieldset>
		</form>
		</div>
			

</body>
</html>

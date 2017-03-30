<!-- 
Course:        CS 340         
Names:         Ambrelle Palmer, Brook Hagen
Date:          11/2016
Content:       tribeTable.php for CS340 final project, an outdoor adventure app database.
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
     <div>
          <table>
               <tr>
                    <td>Tribes</td>
               </tr>
               <tr>
                    <td>User ID</td>
                    <td>Tribe Name</td>
               </tr>

<?php

//build the table
if (!($stmt = $mysqli->prepare("SELECT tribes.uid, tribes.tribe_name FROM tribes"))) {
     echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()) {
     echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//bind results to variable names
if(!$stmt->bind_result($uid, $tribe_name)) {
     echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/*$stmt->fetch will get the next row of results, if row exists, & put it into variables */
while ($stmt->fetch()) {
     echo "<tr>\n<td>" . $uid . "\n</td>\n<td>" . $tribe_name . "</td\n</tr>";
}
$stmt->close();
?>

          </table>
     </div>
     <div>
          <form method="post" action="addTribe.php"> 
               <fieldset>
                    <legend>Add Tribe/Activity to User</legend>
                    <p>User ID: <input type="text" name="uid"/></p>
                    <p>Activity/Tribe Name: <input type="text" name="tribe_name"/></p>
                    <p><input type="submit" value="Add Tribe to User"/></p>
               </fieldset>
          </form>
     </div>

     <div>
          <form method="post" action="filterByTribe.php">
               <fieldset>
                    <legend>List User Names By Tribe/Activity</legend>
                         <p>Tribe/Activity Name: <input type="text" name="tribe_name" /></p>
               </fieldset>
               <input type="submit" value="Run Filter" />
          </form>
     </div>

     <div>
          <form method="post" action="deleteTribeByUser.php">
               <fieldset>
                    <legend>Delete a Tribe/Activity From a User:</legend>
                         <p>Tribe/Activity Name: <input type="text" name="tribe_name" /></p>
                         <p>User ID: <input type="text" name="userID" /></p>
               </fieldset>
               <input type="submit" value="Delete" />
          </form>
     </div>

</body>
</html>

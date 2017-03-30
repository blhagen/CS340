<!-- 
Course:        CS 340         
Names:         Ambrelle Palmer, Brook Hagen
Date:          11/2016
Content:       photoTable.php for CS340 final project, an outdoor adventure app database.
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
                    <td>Photo</td>
               </tr>
               <tr>
                    <td>ID</td>
                    <td>Owner/User ID</td>
                    <td>Date</td>
               </tr>

<?php

//build the table
if (!($stmt = $mysqli->prepare("SELECT photo.id, photo.uid, photo.date_created FROM photo"))) {
     echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()) {
     echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//bind results to variable names
if(!$stmt->bind_result($id, $uid, $date_created)) {
     echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/*$stmt->fetch will get the next row of results, if row exists, & put it into variables */
while ($stmt->fetch()) {
     echo "<tr>\n<td>" . $id . "\n</td>\n<td>" . $uid . "\n</td>\n<td>" . $date_created . "</td\n</tr>";
}
$stmt->close();
?>

          </table>
     </div>
     <div>
          <form method="post" action="addPhoto.php"> 
               <fieldset>
                    <legend>Add a Photo (user ID optional):</legend>
                    <p>User ID: <input type="text" name="userID"/></p>
                    <p>Date: <input type="date" name="photoDate"/></p>
                    <p><input type="submit" value="Add Photo"/></p>
               </fieldset>
          </form>
     </div>
     
     <div>
          <table>
               <tr>
                    <td>List of Possible Users:</td>
               </tr>
               <tr>
                    <td>ID</td>
                    <td>First Name</td>
                    <td>Last Name</td>
               </tr>

<?php

//build the table
if (!($stmt = $mysqli->prepare("SELECT user.id, user.f_name, user.l_name FROM user"))) {
     echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()) {
     echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//bind results to variable names
if(!$stmt->bind_result($id, $f_name, $l_name)) {
     echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/*$stmt->fetch will get the next row of results, if row exists, & put it into variables */
while ($stmt->fetch()) {
     echo "<tr>\n<td>" . $id . "\n</td>\n<td>" . $f_name . "\n</td>\n<td>" . $l_name . "</td\n</tr>";
}
$stmt->close();
?>
          </table>
     </div>



     <div>
          <form method="post" action="filterPhotosByUser.php">
               <fieldset>
                    <legend>List Photos by User's ID: </legend>
                         <p>User ID: <input type="text" name="userID" /></p>
               </fieldset>
               <input type="submit" value="Run Filter" />
          </form>
     </div>

</body>
</html>


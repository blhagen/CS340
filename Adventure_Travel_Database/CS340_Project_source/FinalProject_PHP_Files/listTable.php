<!-- This works.
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
                    <td><h4>Gear Lists</h4></td>
               </tr>
               <tr>
                    <td>ID</td>
                    <td>User Id</td>
                    <td>Adventure ID</td>
                    <td>List Name</td>
                    <td>Date</td>
               </tr>

<?php

//build the table
if (!($stmt = $mysqli->prepare("SELECT list.id, list.uid, list.aid, list.name, list.date_created FROM list"))) {
     echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()) {
     echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//bind results to variable names
if(!$stmt->bind_result($id, $uid, $aid, $name, $date_created)) {
     echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/*$stmt->fetch will get the next row of results, if row exists, & put it into variables */
while ($stmt->fetch()) {
     echo "<tr>\n<td>" . $id . "\n</td>\n<td>" . $uid . "\n</td>\n<td>" . $aid . "\n</td>\n<td>" . $name . "\n</td>\n<td>" . $date_created . "</td\n</tr>";
}
$stmt->close();
?>

          </table>
     </div>
     <div>
          <form method="post" action="addList.php"> 
               <fieldset>
                    <legend>Add a New List</legend>
                    <p>User ID: <input type="text" name="userID"/></p>
                    <p>Adventure ID: <input type="text" name="adventureID"/></p>
                    <p>List Name: <input type="text" name="listName"/></p>
                    <p>Date: <input type="date" name="listDate"/></p>
                    <p><input type="submit" value="Add List"/></p>
               </fieldset>
          </form>
     </div>

     <div>
          <form method="post" action="filterByList.php">
               <fieldset>
                    <legend>View Items by List Name</legend>
                         <p>List Name: <input type="text" name="listName" /></p>
               </fieldset>
               <input type="submit" value="Run Filter" />
          </form>
     </div>

</body>
</html>


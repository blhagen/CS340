<!-- 
Course:        CS 340         
Names:         Ambrelle Palmer, Brook Hagen
Date:          11/2016
Content:       itemTable.php for CS340 final project, an outdoor adventure app database.
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
<html>
<body>
     <div>
          <table>
               <tr>
                    <td><h4>Items on Lists</h4></td>
               </tr>
               <tr>
                    <td>ID</td>
                    <td>List ID</td>
                    <td>Description</td>
               </tr>
<?php

//build the table
if (!($stmt = $mysqli->prepare("SELECT item.id, item.lid, item.description FROM item"))) {
     echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()) {
     echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//bind results to variable names
if(!$stmt->bind_result($id, $lid, $description)) {
     echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/*$stmt->fetch will get the next row of results, if row exists, & put it into variables */
while ($stmt->fetch()) {
     echo "<tr>\n<td>" . $id . "\n</td>\n<td>" . $lid . "\n</td>\n<td>" . $description . "</td\n</tr>";
}
$stmt->close();
?>

</table>
</div>
     <div>
          <form method="post" action="addItem.php"> 
               <fieldset>
                    <legend>Add an Item to a List:</legend>
                    <p><h4>Enter List Id and Item Description:</h4></p>
                    <p>List ID: <input type="text" name="listID"/></p>
                    <p>Description: <input type="text" name="itemDescription"/></p>
				<p><input type="submit" value="Add Item"/></p>
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

      <div>
          <form method="post" action="deleteItemFromList.php">
               <fieldset>
                    <legend>Delete an Item from a List:</legend>
                         <p>Item name: <input type="text" name="itemDescription" /></p>
                         <p>List Name: <input type="text" name="listID" /></p>
               </fieldset>
               <input type="submit" value="Delete" />
          </form>
     </div>

     <div>
          <table>
               <tr>
                    <td><h4>Available Gear Lists:</h4></td>
               </tr>

<?php

//build the table
if (!($stmt = $mysqli->prepare("SELECT list.name FROM list"))) {
     echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()) {
     echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//bind results to variable names
if(!$stmt->bind_result($name)) {
     echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/*$stmt->fetch will get the next row of results, if row exists, & put it into variables */
while ($stmt->fetch()) {
     echo "<tr>\n<td>" . $name . "</td\n</tr>";
}
$stmt->close();
?>

          </table>
     </div>

</body>
</html>


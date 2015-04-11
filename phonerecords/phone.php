<?php
include("dbconnect.php")
/* Fairly simple example - there's a form for inserting a new phone record and a set of forms, one for each record,
	that allows for deleting and updating each record. In these ones, the id of the record is passed using a hidden form field. 
*/
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP SQLite Database Example (Phone Records)</title>
<style type="text/css">
.subtleSet {
	border-radius:25px;
	width: 30em;
}
.deleteButton {
	color: red;
}
</style>
</head>

<body>
<h1>Phone Database</h1>
<form id="insert" name="insert" method="post" action="dbprocessphone.php">
<fieldset class="subtleSet">
    <h2>Insert new phone record:</h2>
    <p>
      <label for="name">Name: </label>
      <input type="text" name="name" id="name">
    </p>
    <p>
      <label for="phone">Phone: </label>
      <input type="text" name="phone" id="phone">
    </p>
    <p>
      <label for="address">Address: </label>
      <input type="text" name="address" id="address">
    </p>
    <p>
      <input type="submit" name="submit" id="submit" value="Insert Entry">
    </p>
</fieldset>
</form>

<fieldset class="subtleSet">
<h2>Current data:</h2>
<?php
// Display what's in the database at the moment.
$sql = "SELECT * FROM people";
foreach ($dbh->query($sql) as $row)
{
?>
<form id="deleteForm" name="deleteForm" method="post" action="dbprocessphone.php">
<?php
	echo "<h3>Name</h3><input type='text' name='name' id='name' value='$row[name]' /> <h3 >Phone</h3><p><input type='text' name='phone' id='phone' value='$row[phone]' /></p>\n
	<h3>Address</h3><input type='text' name='address' id='address' value='$row[address]' />";
	echo "<input type='hidden' name='id' value='$row[id]' />";
?>
<input type="submit" name="submit" value="Update Entry" />
<input type="submit" name="submit" value="Delete Entry" class="deleteButton">
<input type="submit" name="submit" value="X" class="deleteButton">
</form>
<?php
}
echo "</fieldset>\n";
// close the database connection  
$dbh = null;
?>
</body>
</html>
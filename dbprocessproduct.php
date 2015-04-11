<?php

include("dbconnector.php");
$debugOn = true;

if ($_REQUEST['submit'] == "X")
{
	$sql = "DELETE FROM siteData WHERE id = '$_REQUEST[id]'";
	if ($dbh->exec($sql))
		header("Location: product.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP SQLite Database </title>
</head>

<body>
<h1>Results</h1>
<?php
echo "<h2>Form Data</h2>";
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
// execute the appropriate query based on which submit button (insert, delete or update) was clicked
if ($_REQUEST['submit'] == "insert")
{
	$sql = "INSERT INTO siteData (name, description, price) VALUES ('$_REQUEST[name]', '$_REQUEST[description]', '$_REQUEST[price]')";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		echo "Inserted $_REQUEST[name]";
	else
		echo "Not inserted"; // in case it didn't work - e.g. if database is not writeable
}
else if ($_REQUEST['submit'] == "delete")
{
	$sql = "DELETE FROM siteData WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		echo "Deleted $_REQUEST[name]";
	else
		echo "Not deleted";
}
else if ($_REQUEST['submit'] == "update")
{
	$sql = "UPDATE siteData SET name = '$_REQUEST[name]', description = '$_REQUEST[description]',
	price = '$_REQUEST[price]' WHERE id='$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		echo "Updated $_REQUEST[name]";
	else
		echo "Not updated";
}
else {
	echo "This page did not come from a valid form submission.<br />\n";
}
echo "</strong></p>\n";

// Basic select and display all contents from table 

echo "<h2>Phone Records in Database Now</h2>\n";
$sql = "SELECT * FROM siteData";
$result = $dbh->query($sql);
$resultCopy = $result;

if ($debugOn) {
	echo "<pre>";	
// one row at a time:
/*	$row = $result->fetch(PDO::FETCH_ASSOC);
	print_r($row);
	echo "<br />\n";
	$row = $result->fetch(PDO::FETCH_ASSOC);
	print_r($row);
*/
// all rows in one associative array
	$rows = $result->fetchall(PDO::FETCH_ASSOC);
	echo count($rows) . " records in table<br />\n";
	print_r($rows);
	echo "</pre>";
	echo "<br />\n";
}
foreach ($dbh->query($sql) as $row)
{
	print $row[name] .' - '. $row[description] . ' - '. $row[price]."<br />\n";
}

// close the database connection 
$dbh = null;
?>
<p><a href="product.php">Return to database test page</a></p>
</body>
</html>
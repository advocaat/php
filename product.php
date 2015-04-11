<?php
include("dbconnector.php");
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Products</title>
<style type="text/css">

</style>
</head>
<body>
<header>
    <div id="title">
        <h1>Product Database</h1>
    </div>
    <div id="tagline">
        <p>where it is..</p>
    </div>
</header>
<div id="mainsection">
   <form id="insert" name="insert" method="post" action="dbprocessproduct.php">
    <fieldset class="shiny">
        <h2>Insert product record</h2>
        <p>
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name">
        </p>
        <p>
            <label for="description">Product Description:</label>
            <input type="text" name="description" id="description">
        </p>
        <p>
            <label for="price">Product Price:</label>
            <input type="text" name="price" id="price">
        </p>
        <p>
        <input type="submit" name="submit" id="submit" value="insert">
        </p>
        </fieldset>
        </form>

        <fieldset class="shiny">
            <h1>Current:</h1>
                <?php
                //display current contents of database
                $sql = "SELECT * FROM siteData";
                foreach ($dbh->query($sql) as $row)
                {
                ?>
                <form id="deleteform" name="deleteform" method="post" action="dbprocessproduct.php">
                <?php
                    echo "<h3>Name</h3><p><input type='text' name='name' id='name' value='$row[name]'/></p>
                          <h3>Price</h3><p><input type='text' name='price' id='price' value='$row[price]'></p>
                          <h3>Description</h3><p><input type='text' name='description' id='description' value='$row[description]'></p>";

                       echo "<input type='hidden' name='id' value='$row[id]'/>";
                       ?>
                <input type="submit" name="submit" value="update" />
                <input type="submit" name="submit" value="delete" class="delete" />
                <input type="submit" name="submit" value="X" class"deleteButton" />
                </form>
                <?php
                }
                echo "</fieldset>\n";
                //close database connection
                $dhb = null;
                ?>

</div>
<footer>
    <blockquote>&copy; 2015</blockquote>
</footer>
</body>
</html>



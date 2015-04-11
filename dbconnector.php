<?php
try{
//connect to SQLite database. in a separate file to be included in pages that need db access
    $dbh = new PDO("sqlite:mydata.sqlite");

}
catch(PDOException $e){

    echo $e->getMessage();
}
?>
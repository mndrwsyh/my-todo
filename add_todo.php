<?php 
// put the backend code for procesing daata
//connet to dtabase
//1. databoace size
$host = "127.0.0.1";
$database_name = "TODO";
$database_user = "root";
$database_password = "";

//2. coone tphp with the database
//pdo - php database object
$database = new PDO(
    "mysql:host=$host;dbname=$database_name", 
    $database_user, 
    $database_password
);

 // data from the input in index.php
 $todo_label = $_POST["todo_label"];

     // 3. add the student name to students table
 // 3.1 SQL command (recipe)
 $sql = "INSERT INTO todos (`label`) VALUES (:label)";
 // 3.2 prepare your SQL query (prepare your material)
 $query = $database->prepare( $sql );
 // 3.3 execute the SQL query (cook it)
 $query->execute([
     "label" => $todo_label
 ]);

 //4. redirect tje user back to index.php
 header("Location: index.php");
 exit;
 
?>
<?php 
//put all delete student logic
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

//data from delete form (id) kena id sbb kalau name takut name sama di delete
$todo_id = $_POST["todo_id"];

//3. delete teh studnent from student table using the student id
//3.1 sql command (recipe)
$sql = "DELETE FROM todos WHERE id=:id";
 // 3.2 prepare your SQL query (prepare your material)
$query = $database->prepare($sql);
 // 3.3 execute the SQL query (cook it)
 $query->execute([
    "id" => $todo_id
]);

// -> only available in object, => only for array
//4. redirect tje user back to index.php
header("Location: /");
exit;
?>
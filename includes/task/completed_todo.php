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

$todo_completed = $_POST["todo_completed"];
$todo_id = $_POST["todo_id"];

if ($todo_completed==0) {
    $sql = "UPDATE todos SET completed = 1 WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $todo_id
]); } else {
    $sql = "UPDATE todos SET completed = 0 WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $todo_id
]);
}

header("Location: /");
exit;

?>
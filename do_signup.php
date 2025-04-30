<?php 

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

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if (
    empty($name) ||
    empty($email) ||
    empty($password) ||
    empty($confirm_password)
) {
    echo "All the fields are required";
} else if ( $password !== $confirm_password) {
    echo "Your password is not matched" ;
} else {
    //5. create a user acc
    //5.1 SQL command
    $sql = "INSERT INTO todousers (`name`, `email`, `password`) VALUES (:name, :email, :password)";
    //5.2 prepare
    $query = $database->prepare( $sql );
    //5.3 execute
    $query->execute([
        "name" => $name,
        "email" => $email,
        "password" => password_hash( $password, PASSWORD_DEFAULT )
    ]);
    
    //6. redirect to login.php
    header("Location: login.php");
    exit;

}

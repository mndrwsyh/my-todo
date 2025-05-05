<?php 

$database = connectToDB();

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
    //check and make sure email provided is not already exists in user table
    //get user data by email
    $sql = "SELECT * FROM todousers WHERE email = :email";
    // 3.2 - prepare sql query (prepare your material)
    $query = $database->prepare( $sql );
    // 3.3 - execute sql query (cook it)
    $query->execute([
        "email" => $email
    ]);
    // 3.4 - fetch all the results from query (eat)
    $todouser = $query->fetch();

    //5.1 SQL command
    if ( $todouser ) {
        echo "The email provided already exists in our system";
    } else {
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
    header("Location: /login");
    exit;
}

}

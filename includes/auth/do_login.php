<?php 

$database = connectToDB();

//3. get all the data from the login page
$email = $_POST["email"];
$password = $_POST["password"];

//4. check for errer (make sure all the field are filled )
if (
    empty($email) ||
    empty($password) 
) {
    echo "All the fields are required";
} else {
    //5. get the user data by email
    //5.1 SQL
    $sql = "SELECT * FROM todousers WHERE email = :email";
    //5.2 prepare
    $query = $database->prepare( $sql );
    //5.3 execute
    $query->execute ([
        "email" => $email
    ]);
    //5.4 fetch
    $user = $query->fetch(); //fetch return the first row of list (one item only), fetchall return everything that is matched

    //check if the user exist or not
    if ( $user ){
        //6. check if password correct or not
        if ( password_verify( $password, $user["password"] ) ) {
            //7. store the user data in the session storage to login the user
            $_SESSION["user"] = $user;

            //8. redirect user back to index php
            header("Location:/");
            exit;
        } else {
            echo "The password provided is incorrect";
        }
    } else {
        echo "The email provided does not exist";
    }
}

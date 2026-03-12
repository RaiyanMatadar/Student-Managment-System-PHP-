<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $course = $_POST["course"];
    
    // this condition will check if the user click submit btn 
    // without entering data then we wont accept that and 
    // we will stop the forward code to be execute 

    require_once "db_connect.php";

    if (empty($username) || empty($email) || empty($phone) || empty($course)) {
        header("Location: index.php");
        exit();
    }

    $query="INSERT INTO students (username,email,phone,course) 
                VALUES (:username,:email,:phone,:course);";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam("username",$username);
    $stmt->bindParam("email",$email);
    $stmt->bindParam("phone",$phone);
    $stmt->bindParam("course",$course);
    
    $stmt->execute();

    // this set to null for closing the databse connection after 
    //data get  into database 
    $pdo = null;
    $stmt = null;

    // keeping tghe user to the existing page once user submit the data 
    header("Location: index.php");
    die();

} else {
    
    header("Location: index.php");
}
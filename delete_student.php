<?php 


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    require_once "db_connect.php";

    // get student_id from url and connected to variable 
    $student_id = $_GET["student_id"];

    $query = "DELETE FROM students WHERE student_id = :student_id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":student_id",$student_id);
    
    if ($stmt->execute()) {
        echo "data deleted!";
        header("Location: view_students.php");
    } else {
        echo "could'nt delete data";
    }
}

?>


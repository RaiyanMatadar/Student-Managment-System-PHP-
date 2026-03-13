<?php 

// this if is for adding the data to the input by default 
if ($_SERVER["REQUEST_METHOD"] == "GET") {

   try {
    // for connecting to databse 
    require_once "db_connect.php";

    // get student_id from url and connected to variable 
    $student_id = $_GET["student_id"];

    // made query with prepare statement to make it secure
    $stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = $student_id");

    // execute the query
    $stmt->execute();

    // for fetching data to user variable from database
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

   } catch (PDOException $e){
        echo "error in catch";
   }
}  

// this below code is for updating the data and showing to webpage 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    try {

        require_once "db_connect.php";

        $student_id = $_GET["student_id"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $course = $_POST["course"];

        $query = "UPDATE students 
                  SET username = :username, 
                      email = :email, 
                      phone = :phone, 
                      course = :course 
                  WHERE student_id = :student_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":phone",$phone);
        $stmt->bindParam(":course",$course);
              
        $stmt->execute();

        header("Location: view_students.php");

    } catch (Throwable $e) {
        echo "error came we are in catch mode right now";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Managment System</title>
</head>
<body>

    <form action="" method="post">
        <input type="text" value="<?= $user['username']; ?>" name="username" placeholder="enter name">
        <input type="text" value="<?= $user['email']; ?>" name="email" placeholder="enter email">
        <input type="number" value="<?= $user['phone']; ?>" name="phone" placeholder="enter phone number">
        <input type="text" value="<?= $user['course']; ?>" name="course" placeholder="enter course name">
        <button type="submit" name="update">Update data</button>
    </form>

</body>
</html>
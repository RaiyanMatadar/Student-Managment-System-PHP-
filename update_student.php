<?php 

// this if is for adding the data to the input by default 
if ($_SERVER["REQUEST_METHOD"] == "GET") {

   try {
    // for connecting to databse 
    require_once "db_connect.php";

    // get student_id from url and connected to variable 
    $student_id = $_GET["student_id"];

    // query for selecting specific student details 
    $query = "SELECT * FROM students WHERE student_id = $student_id";

    // made query with prepare statement to make it secure
    $stmt = $pdo->prepare($query);

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
        
        // for connecting to databse 
        require_once "db_connect.php";

        // selecting student_if from url using GET 
        $student_id = $_GET["student_id"];
        
        // selecting other using POST 
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $course = $_POST["course"];

        // query for updating the data 
        $query = "UPDATE students 
                  SET username = :username, 
                      email = :email, 
                      phone = :phone, 
                      course = :course 
                  WHERE student_id = :student_id";

        // this is for security perpuse 
        $stmt = $pdo->prepare($query);

        // connecting them using bind on the qury placeholder 
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":phone",$phone);
        $stmt->bindParam(":course",$course);
              
        // executing query 
        $stmt->execute();

        // sending the user to the view page 
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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: #0a0a0a;
            color: #e8e8e8;
            font-family: 'Segoe UI', system-ui, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            padding: 2rem;
        }

        form {
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            background: #111111;
            border: 1px solid #1f1f1f;
            border-radius: 16px;
            padding: 2.5rem 2rem;
        }

        input {
            width: 100%;
            background: #0a0a0a;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            color: #e8e8e8;
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input::placeholder {
            color: #444;
            text-transform: capitalize;
        }

        input:focus {
            border-color: #444;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.04);
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        button {
            margin-top: 0.4rem;
            width: 100%;
            padding: 0.8rem;
            background: #e8e8e8;
            color: #0a0a0a;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: background 0.2s, transform 0.1s;
        }

        button:hover {
            background: #ffffff;
        }

        button:active {
            transform: scale(0.98);
        }

        a {
            color: #0a0a0a;
            font-size: 0.9rem;
            text-decoration: none;
            letter-spacing: 0.02em;
            font-weight: 600;
            font-family: inherit;
            background: #e8e8e8;
            padding: 0.8rem;
            border-radius: 8px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            transition: background 0.2s, transform 0.1s;
            display: block;
        }

        a:hover {
            background: #ffffff;
        }

        a:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

    <form action="" method="post">
        <input type="text" value="<?= $user['username']; ?>" name="username" placeholder="enter name">
        <input type="text" value="<?= $user['email']; ?>" name="email" placeholder="enter email">
        <input type="number" value="<?= $user['phone']; ?>" name="phone" placeholder="enter phone number">
        <input type="text" value="<?= $user['course']; ?>" name="course" placeholder="enter course name">
        <button type="submit" name="update">Update data</button>
    </form>

    <a href="view_students.php">Back</a>

</body>
</html>
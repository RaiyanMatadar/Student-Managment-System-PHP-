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
        header("Location: add_student.php");
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
    header("Location: add_student.php");
    die();

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
    <form action="add_student.php" method="post">
        <input type="text" name="username" placeholder="enter name">
        <input type="text" name="email" placeholder="enter email">
        <input type="number" name="phone" placeholder="enter phone number">
        <input type="text" name="course" placeholder="enter course name">
        <button type="submit">add data</button>
    </form>

    <a href="view_students.php">view data</a>
</body>
</html>
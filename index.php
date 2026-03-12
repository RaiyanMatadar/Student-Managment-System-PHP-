<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Managment System</title>
</head>
<body>
    <form action="add_student.php" method="post">
        <input type="text" name="username" placeholder="enter name">
        <input type="text" name="email" placeholder="enter email">
        <input type="number" name="phone" placeholder="enter phone number">
        <input type="text" name="course" placeholder="enter course name">
        <button type="submit">add data</button>
    </form>

    <!-- Display Data  -->
     <button><a href="view_students.php">view data</a></button>
</body>
</html>
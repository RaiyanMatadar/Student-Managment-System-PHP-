<?php 

require_once "db_connect.php";
    
// query for selecting all the data 
$stmt = $pdo->query("SELECT * FROM students");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// once the fetch complete data connection should close 
$pdo = null;
$stmt = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table cellpadding="8" border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['student_id'])?></td>
            <td><?= htmlspecialchars($user['username'])?></td>
            <td><?= htmlspecialchars($user['email'])?></td>
            <td><?= htmlspecialchars($user['phone'])?></td>
            <td><?= htmlspecialchars($user['course'])?></td>
            <td>
                <button><a href="update_student.php?action=update&student_id=<?= $user['student_id']?>">Update</a></button>
                <button><a href="delete_student.php?action=delete&student_id=<?= $user['student_id']?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>

    <button><a href="index.php">back to Home</a></button>
</table>
</body>
</html>
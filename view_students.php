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

        table {
            width: 100%;
            max-width: 860px;
            border-collapse: collapse;
            background: #111111;
            border: 1px solid #1f1f1f;
            border-radius: 16px;
            overflow: hidden;
        }

        th {
            background: #161616;
            color: #888;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 1rem 1.2rem;
            text-align: left;
            border-bottom: 1px solid #1f1f1f;
        }

        td {
            padding: 0.9rem 1.2rem;
            font-size: 0.875rem;
            color: #ccc;
            border-bottom: 1px solid #181818;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #161616;
        }

        button {
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 6px;
            cursor: pointer;
            padding: 0;
            transition: border-color 0.2s, background 0.2s, transform 0.1s;
        }

        button:hover {
            background: #222;
            border-color: #444;
        }

        button:active {
            transform: scale(0.97);
        }

        /* delete button distinct styling */
        button:last-child {
            border-color: #2a1a1a;
        }

        button:last-child:hover {
            background: #1f1010;
            border-color: #5a2a2a;
        }

        button a {
            display: block;
            padding: 0.45rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 600;
            font-family: inherit;
            letter-spacing: 0.02em;
            text-decoration: none;
            color: #aaa;
        }

        button:last-child a {
            color: #c87070;
        }

        td:last-child {
            display: flex;
            gap: 0.5rem;
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
            max-width: 860px;
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

        /* override anchor styles that are inside buttons */
        button a {
            background: none;
            padding: 0.45rem 0.9rem;
            border-radius: 0;
            width: auto;
            max-width: none;
            color: #aaa;
        }

        button:last-child a {
            color: #c87070;
        }

        button a:hover {
            background: none;
        }

        button a:active {
            transform: none;
        }
    </style>
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

    <a href="add_student.php">back to Home</a>
</table>
</body>
</html>
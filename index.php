<?php
include 'db.php';

$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Project Management System</h2>

    <form action="add_project.php" method="POST">
        <input type="text" name="name" placeholder="Project Name" required>
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <select name="scope" required>
            <option value="Small">Small</option>
            <option value="Medium">Medium</option>
            <option value="Large">Large</option>
        </select>
        <button type="submit">Add Project</button>
    </form>

    <table>
        <tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Scope</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $row['start_date'] ?></td>
            <td><?= $row['end_date'] ?></td>
            <td><?= $row['scope'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="edit_project.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="mark_done.php?id=<?= $row['id'] ?>">Mark as Done</a>
                <a href="delete_project.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this project?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
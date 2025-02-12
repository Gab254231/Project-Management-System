<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM projects WHERE id=$id");
$project = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $scope = $_POST['scope'];

    if (strtotime($end_date) <= strtotime($start_date)) {
        die("End date must be after start date.");
    }

    $stmt = $conn->prepare("UPDATE projects SET name=?, start_date=?, end_date=?, scope=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $start_date, $end_date, $scope, $id);
    $stmt->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Project</title>
</head>
<body>
    <h2>Edit Project</h2>
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($project['name']) ?>" required>
        <input type="date" name="start_date" value="<?= $project['start_date'] ?>" required>
        <input type="date" name="end_date" value="<?= $project['end_date'] ?>" required>
        <select name="scope" required>
            <option value="Small" <?= $project['scope'] == 'Small' ? 'selected' : '' ?>>Small</option>
            <option value="Medium" <?= $project['scope'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
            <option value="Large" <?= $project['scope'] == 'Large' ? 'selected' : '' ?>>Large</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>
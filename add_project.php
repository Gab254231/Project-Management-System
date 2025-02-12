<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $scope = $_POST['scope'];

    if (strtotime($end_date) <= strtotime($start_date)) {
        die("End date must be after start date.");
    }

    $stmt = $conn->prepare("INSERT INTO projects (name, start_date, end_date, scope) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $start_date, $end_date, $scope);
    $stmt->execute();
    
    header("Location: index.php");
}
?>
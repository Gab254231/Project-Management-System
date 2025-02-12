<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("UPDATE projects SET status='Done' WHERE id=$id");

header("Location: index.php");
?>

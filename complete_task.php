<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("UPDATE tasks SET status='completed' WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: index.php");
exit();

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = trim($_POST['task']);
    if (!empty($task)) {
        $stmt = $conn->prepare("INSERT INTO tasks (task_name, status) VALUES (?, 'pending')");
        $stmt->bind_param("s", $task);
        $stmt->execute();
    }
}

header("Location: index.php");
exit();

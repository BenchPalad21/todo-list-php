<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_list";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL,
    status ENUM('pending', 'completed', 'deleted') NOT NULL DEFAULT 'pending'
)";
$conn->query($sql);
?>

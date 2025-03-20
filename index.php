<?php
include 'db.php';

// Fetch tasks from the database
$pendingTasks = $conn->query("SELECT * FROM tasks WHERE status='pending'");
$completedTasks = $conn->query("SELECT * FROM tasks WHERE status='completed'");
$deletedTasks = $conn->query("SELECT * FROM tasks WHERE status='deleted'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>">
</head>
<body>
    <div class="header">
        <h2>ToDo List</h2>
            <button id="dark-mode-toggle">🌙</button>
            <div class="task-input-box">
                <form action="add_task.php" method="POST">
                    <input type="text" name="task" placeholder="Enter Task" required>
                    <button type="submit">Add</button>
                </form>
            </div>
    </div>
    <div class="container">
        <div class="section pending">
            <h3>Pending Tasks</h3>
            <?php while ($row = $pendingTasks->fetch_assoc()): ?>
                <div class="task-box pending">
                    <span><?= htmlspecialchars($row['task_name']); ?></span>
                    <div class="task-actions">
                        <a href="complete_task.php?id=<?= $row['id']; ?>" class="complete-btn">✔</a>
                        <a href="delete_task.php?id=<?= $row['id']; ?>" class="delete-btn">✖</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="section completed">
            <h3>Completed Tasks</h3>
            <?php while ($row = $completedTasks->fetch_assoc()): ?>
                <div class="task-box completed">
                    <span><?= htmlspecialchars($row['task_name']); ?></span>
                        <div class="task-actions">
                            <a href="delete_task.php?id=<?= $row['id']; ?>" class="delete-btn">✖</a>
                        </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleButton = document.getElementById("dark-mode-toggle");
        const body = document.body;

        // Check for saved preference
        if (localStorage.getItem("theme") === "dark") {
            body.classList.add("dark-mode");
            toggleButton.textContent = "☀️";
        }

        toggleButton.addEventListener("click", function () {
            body.classList.toggle("dark-mode");

            if (body.classList.contains("dark-mode")) {
                localStorage.setItem("theme", "dark");
                toggleButton.textContent = "☀️";
            } else {
                localStorage.setItem("theme", "light");
                toggleButton.textContent = "🌙";
            }
        });
    });
    </script>

</body>
</html>
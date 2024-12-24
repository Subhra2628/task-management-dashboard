<?php
// Start session and check if admin is logged in
include 'Task_database.php';

// Check if task ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $task_id = intval($_GET['id']);

    // Fetch task details
    $sql = "SELECT * FROM tasks_db WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();

    if (!$task) {
        header("Location: view_task.php?error=Task not found");
        exit;
    }
} else {
    header("Location: view_task.php?error=Invalid task ID");
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks_db SET title = ?, description = ?, due_date = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $description, $due_date, $status, $task_id);

    if ($stmt->execute()) {
        header("Location: view_task.php?message=Task updated successfully");
        exit;
    } else {
        $error = "Failed to update the task";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="styles.css">
  
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #ffffff;
    width: 50%;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

h2 {
    text-align: center;
    color: #333333;
    margin-bottom: 20px;
}

form {
    width: 100%;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-size: 14px;
    font-weight: bold;
    color: #555555;
    margin-bottom: 5px;
}

input[type="text"],
input[type="date"],
textarea,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #dddddd;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
}

input:focus,
textarea:focus,
select:focus {
    border-color: #007BFF;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

button {
    display: inline-block;
    background-color: #007BFF;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

.btn-cancel {
    text-decoration: none;
    color: #ffffff;
    background-color: #6c757d;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    display: inline-block;
}

.btn-cancel:hover {
    background-color: #5a6268;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 90%;
    }
}
</style>
</head>
<body>
    <div class="container">
        <h2>Edit Task</h2>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Task Title:</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Task Description:</label>
                <textarea name="description" id="description" rows="5" required><?php echo htmlspecialchars($task['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" name="due_date" id="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="Pending" <?php if ($task['status'] === 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="In Progress" <?php if ($task['status'] === 'In Progress') echo 'selected'; ?>>In Progress</option>
                    <option value="Completed" <?php if ($task['status'] === 'Completed') echo 'selected'; ?>>Completed</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Update Task</button>
                <a href="view_tasks.php" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>

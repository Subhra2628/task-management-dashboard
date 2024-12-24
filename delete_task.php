<?php
// Start session and check if admin is logged in
include 'Task_database.php';
// Check if a task ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $task_id = intval($_GET['id']);

    // Delete the task from the database
    $sql = "DELETE FROM tasks_db WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        // Redirect back to view_tasks.php with success message
        header("Location: view_task.php?message=Task deleted successfully");
    } else {
        // Redirect back to view_tasks.php with error message
        header("Location: view_task.php?error=Failed to delete the task");
    }
    $stmt->close();
} else {
    // Redirect if no valid task ID is provided
    header("Location: view_tasks.php?error=Invalid task ID");
}

$conn->close();
?>

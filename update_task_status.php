<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    header("Location: employee_login.php");
    exit();
}

include 'Task_database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];

    // Update the task status
    $sql_update = "UPDATE tasks_db SET status = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $status, $task_id);

    if ($stmt_update->execute()) {
        $_SESSION['success'] = "Task status updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update task status.";
    }

    $stmt_update->close();
    $conn->close();

    // Redirect back to the dashboard
    echo"Status Updated";
    //header("Location: employee_dashboard.php");
    exit();
}
?>

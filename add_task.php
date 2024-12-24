<?php
include 'Task_database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $assigned_to = $_POST['assigned_to'];

    $insert_sql = "INSERT INTO tasks_db (title, description, due_date, assigned_to) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("sssi", $title, $description, $due_date, $assigned_to);

    if ($stmt->execute()) {
     echo "Task added successfully.";
        header("Location: view_task.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Failed to add task. Please try again.";
    }
}
?>
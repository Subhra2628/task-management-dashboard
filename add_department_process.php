<?php
include 'Task_database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO departments_db (name, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $description);
    
    if ($stmt->execute()) {
        echo"Department Added successfully";
    } else {
        $error = "Failed to add department: " . $conn->error;
    }
}
?>
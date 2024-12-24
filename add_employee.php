<?php
include 'Task_database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $department_id = intval($_POST['department_id']);

    $sql = "INSERT INTO employees_db (name, email, password, department_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $password, $department_id);

    if ($stmt->execute()) {
       echo"Employee Added Successfully";
    } else {
        $error_message = "Error: " . $stmt->error;
    }
}
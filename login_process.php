<?php
include 'Task_database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
 {
    // Fetch form data
    $email = $_POST['email'];
    $password = $_POST['password'];

  

    // Query to check if the employee exists
    $sql="SELECT * FROM employees_db WHERE email=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1)
     {
        $employee = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $employee['password']))
         {
            // Store employee details in session
            $_SESSION['employee_id'] = $employee['id'];
            $_SESSION['employee_name'] = $employee['name'];
            $_SESSION['employee_email'] = $employee['email'];

            // Redirect to dashboard
            header("Location: Employee_dashboard.php");
            exit();
        } 
        else
         {
            // Incorrect password
            echo "Invalid email or password.";
        }
    } 
    else {
        // Employee not found
        echo "No employee found with the given email.";
    }

    // Close the database connection
    $stmt->close();
}
?>

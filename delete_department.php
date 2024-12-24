<?php
// Start session and check if admin is logged in
include 'Task_database.php';

// Check if the 'id' parameter is passed in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $department_id = $_GET['id']; // Get the department ID

    // Step 1: Delete employees in the department
    $deleteEmployees = "DELETE FROM employees_db WHERE department_id = ?";
    if ($stmt = $conn->prepare($deleteEmployees)) {
        $stmt->bind_param("i", $department_id);
        $stmt->execute();
        $stmt->close();
    }

    // Step 2: Now delete the department
    $deleteDepartment = "DELETE FROM departments_db WHERE id = ?";
    if ($stmt = $conn->prepare($deleteDepartment)) {
        $stmt->bind_param("i", $department_id);
        if ($stmt->execute()) {
            // Set success message
            $message = "Department and associated employees deleted successfully.";
        } else {
            // Set error message if department deletion fails
            $message = "Error deleting department. Please try again.";
        }
        $stmt->close();
    }

    // Redirect to view_departments.php with a message
    header("Location: view_departments.php?message=" . urlencode($message));
    exit;

} else {
    // If no ID is passed, redirect with an error message
    header("Location: view_departments.php?message=" . urlencode("Invalid department ID."));
    exit;
}
?>

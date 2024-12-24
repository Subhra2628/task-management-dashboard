<?php
// Start session and check if admin is logged in
include 'Task_database.php';

// Check if the 'id' parameter is passed in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $employee_id = $_GET['id']; // Get the employee ID

    // Step 1: Delete tasks assigned to this employee
    $deleteTasks = "DELETE FROM tasks_db WHERE assigned_to = ?";
    if ($stmt = $conn->prepare($deleteTasks)) {
        $stmt->bind_param("i", $employee_id);
        $stmt->execute();
        $stmt->close();
    }

    // Step 2: Now delete the employee
    $deleteEmployee = "DELETE FROM employees_db WHERE id = ?";
    if ($stmt = $conn->prepare($deleteEmployee)) {
        $stmt->bind_param("i", $employee_id);
        if ($stmt->execute()) {
            // Set success message
            $message = "Employee and assigned tasks deleted successfully.";
        } else {
            // Set error message if employee deletion fails
            $message = "Error deleting employee. Please try again.";
        }
        $stmt->close();
    }

    // Redirect to view_employees.php with a message
    header("Location: view_employee.php?message=" . urlencode($message));
    exit;

} else {
    // If no ID is passed, redirect with an error message
    header("Location: view_employee.php?message=" . urlencode("Invalid employee ID."));
    exit;
}
?>

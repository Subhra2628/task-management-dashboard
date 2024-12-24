<?php
include 'Task_database.php';
session_start();

// Ensure the employee is logged in
if (!isset($_SESSION['employee_id'])) {
    header("Location: employee_login.php");
    exit();
}

// Fetch employee details
$employee_id = $_SESSION['employee_id'];
$sql_employee = "SELECT 
    employees_db.id AS employee_id,
    employees_db.name AS employee_name,
    employees_db.department_id,
    departments_db.name AS department_name
FROM 
    employees_db
LEFT JOIN 
    departments_db 
ON 
    employees_db.department_id = departments_db.id 
WHERE employees_db.id = ?";

$stmt_employee = $conn->prepare($sql_employee);
$stmt_employee->bind_param("i", $employee_id);
if (!$stmt_employee->execute()) {
    die("Error fetching employee details: " . $stmt_employee->error);
}
$result_employee = $stmt_employee->get_result();
$employee = $result_employee->fetch_assoc();

// Fetch tasks assigned to the employee
$sql_tasks = "SELECT id, title, description, status FROM tasks_db WHERE assigned_to = ?";
$stmt_tasks = $conn->prepare($sql_tasks);
$stmt_tasks->bind_param("i", $employee_id);
if (!$stmt_tasks->execute()) {
    die("Error fetching tasks: " . $stmt_tasks->error);
}
$result_tasks = $stmt_tasks->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 10px;
            text-align: center;
        }

        main {
            padding: 20px;
            background-color: #f4f4f4;
            min-height: 90vh;
        }

        .task-container {
            background-color: #ffffff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .task-container h3 {
            color: #2c3e50;
        }

        .task-container form {
            margin-top: 10px;
        }

        .task-container form select,
        .task-container form button {
            padding: 5px;
            margin-right: 10px;
        }

        .success, .error {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #2ecc71;
            color: #fff;
        }

        .error {
            background-color: #e74c3c;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, Employee</h1>
        <p>Employee Name: <?php echo htmlspecialchars($employee['employee_name']); ?> | Department: <?php echo htmlspecialchars($employee['department_name']); ?></p>
    </header>
    <main>
        <h2>Your Assigned Tasks</h2>
        <?php while ($task = $result_tasks->fetch_assoc()): ?>
            <div class="task-container">
                <h3>Task: <?php echo htmlspecialchars($task['title']); ?></h3>
                <p>Description: <?php echo htmlspecialchars($task['description']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($task['status']); ?></p>
                <form action="update_task_status.php" method="POST">
                    <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task['id']); ?>">
                    <label for="status">Update Status:</label>
                    <select name="status" id="status">
                        <option value="Pending" <?php if ($task['status'] === 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Completed" <?php if ($task['status'] === 'Completed') echo 'selected'; ?>>Completed</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </div>
        <?php endwhile; ?>
    </main>
</body>
</html>

<?php
include 'Task_database.php';

// Start session and check if admin is logged in


// Fetch employees and their departments
$sql = "SELECT e.id, e.name AS employee_name, e.email, d.name AS department_name 
        FROM employees_db e 
        LEFT JOIN departments_db d ON e.department_id = d.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f9;
            color: #333;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .action-btn {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #3498db;
            color: white;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        .action-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View Employees</h1>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['employee_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['department_name'] ?? 'Unassigned'); ?></td>
                            <td>
                                <button class="action-btn edit-btn" onclick="window.location.href='edit_employee.php?id=<?php echo $row['id']; ?>'">Edit</button>
                                <button class="action-btn delete-btn" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No employees found.</p>
        <?php endif; ?>
    </div>

    <script>
        function confirmDelete(employeeId) {
            if (confirm("Are you sure you want to delete this employee?")) {
                window.location.href = `delete_employee.php?id=${employeeId}`;
            }
        }
    </script>
    <p style="text-align: center"><a href="manage_employees_dashboard.php">Back To Main Page</a></p>
</body>
</html>

<?php $conn->close(); ?>

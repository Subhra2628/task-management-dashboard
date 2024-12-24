<?php
include 'Task_database.php';

// Fetch tasks with employee details
$sql = "SELECT tasks_db.id, tasks_db.title, tasks_db.description, tasks_db.due_date, 
        tasks_db.status, employees_db.name AS assigned_to 
        FROM tasks_db 
        LEFT JOIN employees_db ON tasks_db.assigned_to = employees_db.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tasks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }
        .edit-btn {
            background-color: #007bff;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h2>View Tasks</h2>
    
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($task = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $task['id']; ?></td>
                        <td><?php echo htmlspecialchars($task['title']); ?></td>
                        <td><?php echo htmlspecialchars($task['description']); ?></td>
                        <td><?php echo $task['due_date']; ?></td>
                        <td><?php echo $task['status']; ?></td>
                        <td><?php echo htmlspecialchars($task['assigned_to'] ?? 'Unassigned'); ?></td>
                        <td>
                            <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="edit-btn">Edit</a>
                            <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
     
    <?php } else { ?>
        <p>No tasks found.</p>
    <?php } ?>
   
</body>
</html>
<p><a href="manage_tasks_dashboard.php">Back To Main Page</a></p>

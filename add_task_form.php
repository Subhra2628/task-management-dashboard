<?php   
include 'Task_database.php';
$employees_sql = "SELECT id, name FROM employees_db";
$employees_result = $conn->query($employees_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Add Task</h2>
    <form method="POST" action="add_task.php">
        <label for="title">Task Title:</label>
        <input type="text" id="title" name="title" placeholder="Enter task title" required>

        <label for="description">Task Description:</label>
        <textarea id="description" name="description" placeholder="Enter task description" rows="4" required></textarea>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required>

        <label for="assigned_to">Assign To:</label>
        <select id="assigned_to" name="assigned_to" required>
            <option value="">-- Select Employee --</option>
            <?php while ($employee = $employees_result->fetch_assoc()) { ?>
                <option value="<?php echo $employee['id']; ?>">
                    <?php echo htmlspecialchars($employee['name']); ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Add Task</button>
    </form>
</body>
</html>
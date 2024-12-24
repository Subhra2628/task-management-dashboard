<?php
include 'Task_database.php';
$sql = "SELECT id, name FROM departments_db";
$result = $conn->query($sql);

$departments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #333;
        }
        .message.success {
            border-color: #2ecc71;
            background-color: #e9f8ed;
            color: #27ae60;
        }
        .message.error {
            border-color: #e74c3c;
            background-color: #fdecea;
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Employee</h1>

        <!-- Success or error message -->
        <?php if (isset($success_message)): ?>
            <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form action="add_employee.php" method="POST">
            <div class="form-group">
                <label for="name">Employee Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Employee Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Employee Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="department_id">Department</label>
                <select id="department_id" name="department_id" required>
                    <option value="" disabled selected>Select a department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?php echo $department['id']; ?>">
                            <?php echo htmlspecialchars($department['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Add Employee</button>
        </form>
    </div>
</body>
</html>
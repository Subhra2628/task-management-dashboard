<?php
include 'Task_database.php';
// Fetch employee data for editing
if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
    $employee_id = $_GET['id'];

    $sql = "SELECT * FROM employees_db WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    }
 }
// Handle form submission to update employee details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $employee['password'];
    $department_id = $_POST['department_id'];

    $update_sql = "UPDATE employees_db SET name = ?, email = ?, password = ?, department_id = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssii", $name, $email, $password, $department_id, $employee_id);

    if ($update_stmt->execute()) {
   echo"Employee Update Successfully";
        header("Location: view_employee.php");
        exit;
    } 
}

// Fetch all departments for the dropdown
$departments_sql = "SELECT * FROM departments_db";
$departments_result = $conn->query($departments_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h2>Edit Employee</h2>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required>

        <label for="password">Password (leave blank to keep current password):</label>
        <input type="password" id="password" name="password" placeholder="Enter new password">

        <label for="department_id">Department:</label>
        <select id="department_id" name="department_id" required>
            <option value="">-- Select Department --</option>
            <?php while ($department = $departments_result->fetch_assoc()) { ?>
                <option value="<?php echo $department['id']; ?>" 
                    <?php echo ($department['id'] == $employee['department_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($department['name']); ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Update Employee</button>
    </form>
</body>
</html>
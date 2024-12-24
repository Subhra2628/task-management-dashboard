<?php
// Start session and check if admin is logged in
include 'Task_database.php';

// Fetch all departments
$sql = "SELECT * FROM departments_db";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Departments</title>
    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f9;
            color: #333;
        }
        .btn {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #3498db;
            color: white;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }
        .btn-edit:hover {
            background-color: #2980b9;
        }
        .btn-delete:hover {
            background-color: #c0392b;
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
        <h1>View Departments</h1>
        
        <!-- Success or error message after delete -->
        <?php if (isset($_GET['message'])): ?>
            <div class="message <?php echo strpos($_GET['message'], 'success') !== false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td>
                                <a href="edit_department.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                                <a href="delete_department.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this department?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No departments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <p style="text-align: center"><a href="manage_departments_dashboard.php">Back To Main Page</a></p>
</body>
</html>



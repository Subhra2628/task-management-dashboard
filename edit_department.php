<?php
include 'Task_database.php';
// Fetch department data based on ID
if (isset($_GET['id'])) {
    $department_id = intval($_GET['id']);
    $sql = "SELECT * FROM departments_db WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $department_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $department = $result->fetch_assoc();
    } else {
        echo "Department not found!";
        exit;
    }
} else {
    echo "Invalid department ID!";
    exit;
}

// Update department data on form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $update_sql = "UPDATE departments_db SET name = ?, description = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $name, $description, $department_id);

    if ($update_stmt->execute()) {
        header("Location: view_departments.php?message=" . urlencode("Department updated successfully."));
        exit;
    } else {
        echo "Error updating department!";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <style>
        /* Basic styling for the page */
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
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
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
        <h1>Edit Department</h1>
        
        <!-- Success or error message after update -->
        <?php if (isset($_GET['message'])): ?>
            <div class="message <?php echo strpos($_GET['message'], 'success') !== false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <form action="edit_department.php?id=<?php echo $department_id; ?>" method="POST">
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($department['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Department Description</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($department['description']); ?></textarea>
            </div>

            <button type="submit">Update Department</button>
        </form>
    </div>
</body>
</html>

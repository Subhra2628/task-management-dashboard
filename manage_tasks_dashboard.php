

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Departments</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 20%;
            background-color: #333;
            color: #fff;
            min-height: 100vh;
            padding: 20px 10px;
        }
        .sidebar h2 {
            text-align: center;
            color: #ffcc00;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 20px 0;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            display: block;
            border-radius: 5px;
        }
        .sidebar ul li a:hover, .sidebar ul li a.active {
            background-color: #ffcc00;
            color: #000;
        }
        .main-content {
            width: 80%;
            padding: 20px;
        }
        .main-content h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .button-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .button-container a {
            display: inline-block;
            padding: 15px 25px;
            background-color: #ffcc00;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            width: 150px;
        }
        .button-container a:hover {
            background-color: #333;
            color: #ffcc00;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="manage_departments_dashboard.php">Manage Departments</a></li>
                <li><a href="manage_employees_dashboard.php"  >Manage Employees</a></li>
                <li><a href="manage_tasks.php" class="active">Manage Tasks</a></li>
               
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <h1>Manage Employees</h1>
            <div class="button-container">
                <a href="add_task_form.php">Add Task</a>
                <a href="view_task.php">View Task</a>
                <a href="edit_task.php">Edit Task</a>
                <a href="delete_task.php">Delete Task</a>
            </div>
        </main>
    </div>
</body>
</html>

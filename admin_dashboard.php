<?php
// Include your database connection
include 'Task_database.php'; // Ensure this file contains the database connection

// Query to get the total number of employees
$totalEmployeesQuery = "SELECT COUNT(*) FROM employees_db";
$totalEmployeesResult = $conn->query($totalEmployeesQuery);
$totalEmployees = $totalEmployeesResult->fetch_row()[0];

// Query to get the total number of tasks
$totalTasksQuery = "SELECT COUNT(*) FROM tasks_db";
$totalTasksResult = $conn->query($totalTasksQuery);
$totalTasks = $totalTasksResult->fetch_row()[0];

// Query to get the total number of completed tasks
$completedTasksQuery = "SELECT COUNT(*) FROM tasks_db WHERE status = 'completed'";
$completedTasksResult = $conn->query($completedTasksQuery);
$completedTasks = $completedTasksResult->fetch_row()[0];

// Query to get the total number of departments
$totalDepartmentsQuery = "SELECT COUNT(*) FROM departments_db";
$totalDepartmentsResult = $conn->query($totalDepartmentsQuery);
$totalDepartments = $totalDepartmentsResult->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Link to CSS file -->
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Container Layout */
        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
        }

        .sidebar-header h2 {
            margin: 0;
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #ecf0f1;
        }

        .menu {
            list-style: none;
            padding: 0;
            width: 100%;
        }

        .menu li {
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        .menu li a {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 1rem;
            display: block;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s; /* Added transition for color */
        }

        .menu li a:hover {
            background-color: #34495e; /* Darker shade on hover */
            color: #ffffff; /* Change text color on hover */
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
            color: #34495e;
            text-align: center;
        }

        /* Dashboard Stats */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .stat-card {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .stat-card p {
            font-size: 2rem; 
            margin-top: 10px; 
        }

        /* Logout Button */
        .logout {
            display: block;
            padding: 10px 20px; /* Increased horizontal padding for better click area */
            text-decoration: none; /* No underline */
            border-radius: 4px; /* Rounded corners */
            margin-top: auto; /* Pushes the logout button to the bottom of the sidebar */
            background-color: rgb(207, 67, 42); /* Default background color (blue) */
            color: white; /* Text color */
            font-weight: bold; /* Makes the text stand out */
            text-align: center; /* Centers the text */
            transition: background-color 0.3s ease; /* Smooth transition effect */
        }

        .logout:hover {
            background-color: rgb(73, 80, 180); /* Change to red on hover */
        }

    </style>
</head>
<body>
    <div class="container"> <!-- Fixed incorrect tag -->
        <!-- Sidebar -->
        <aside class="sidebar">
           <div class="sidebar-header">
                <h2>Admin Dashboard</h2>
           </div>
           <ul class="menu">
                <li><a href="manage_departments_dashboard.php">Manage Departments</a></li>
                <li><a href="manage_employees_dashboard.php">Manage Employees</a></li>
                <li><a href="manage_tasks_dashboard.php">Manage Tasks</a></li>
                <li><a href="logout.php" class="logout" aria-label="Logout">Logout</a></li> <!-- Added aria-label -->
           </ul>
       </aside>

       <!-- Main Content -->
       <main class="main-content">
           <header>
               <h1>Welcome, Admin</h1>
           </header>
           <section class="dashboard-stats">
               <div class="stat-card">
                   <h3>Total Departments</h3>
                   <p><?php echo $totalDepartments; ?></p> <!-- Dynamic data from PHP -->
               </div>
               <div class="stat-card">
                   <h3>Total Employees</h3>
                   <p><?php echo $totalEmployees; ?></p> <!-- Dynamic data from PHP -->
               </div>
               <div class="stat-card">
                   <h3>Total Tasks</h3>
                   <p><?php echo $totalTasks; ?></p> <!-- Dynamic data from PHP -->
               </div>
               <div class="stat-card">
                   <h3>Completed Tasks</h3>
                   <p><?php echo $completedTasks; ?></p> <!-- Dynamic data from PHP -->
               </div>
           </section>
       </main>
    </div>
</body>
</html>

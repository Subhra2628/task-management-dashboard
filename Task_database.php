<?php   
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Database
$database = "Task_management_db";
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
   // echo "Database Created<br>";
}

// Select Database
$conn->select_db($database);

// Create Admin Table
$admin = "CREATE TABLE IF NOT EXISTS admin_db (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    password VARCHAR(255)
)";


if ($conn->query($admin) === TRUE) {
   // echo "Admin Table Created<br>";
}

$sql="ALTER TABLE admin_db MODIFY COLUMN password VARCHAR(255)";
if($conn->query($sql)===TRUE)
{
  // echo"create";
}

// Create Department Table
$Department = "CREATE TABLE IF NOT EXISTS departments_db (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT
)";
if ($conn->query($Department) === TRUE) {
   // echo "Department Table Created<br>";
}

$sql="ALTER TABLE departments_db AUTO_INCREMENT = 1";
if($conn->query($sql)===TRUE)
{
    
}

// Create Employee Table
$Employee = "CREATE TABLE IF NOT EXISTS employees_db (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    department_id INT,
    role ENUM('employee') NOT NULL DEFAULT 'employee',
    FOREIGN KEY (department_id) REFERENCES departments_db(id)
)";
if ($conn->query($Employee) === TRUE) {
  //  echo "Employee Table Created<br>";
}

$sql="ALTER TABLE employees_db AUTO_INCREMENT = 1";
if($conn->query($sql)===TRUE)
{
    
}

// Create Task Table
$Task = "CREATE TABLE IF NOT EXISTS tasks_db (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    due_date DATE,
    status ENUM('Pending', 'In Progress', 'Completed') DEFAULT 'Pending',
    assigned_to INT,
    FOREIGN KEY (assigned_to) REFERENCES employees_db(id)
)";
if ($conn->query($Task) === TRUE) {
    //echo "Task Table Created<br>";
}

$sql="ALTER TABLE tasks_db AUTO_INCREMENT = 1";
if($conn->query($sql)===TRUE)
{
    
}

// Create Pages Table
$Pages = "CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    content TEXT
)";
if ($conn->query($Pages) === TRUE) {
    //echo "Pages Table Created<br>";
}

// Insert Default Admin
$name = "Myadmin";
$password = password_hash("myadmin@123", PASSWORD_BCRYPT);
$sql = "INSERT INTO admin_db (name, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $password);
if ($stmt->execute()) {
   // echo "Admin added successfully!<br>";
} else {
    //echo "Error adding admin: " . $stmt->error . "<br>";
}


?>

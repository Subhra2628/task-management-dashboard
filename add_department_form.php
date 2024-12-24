<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Link to your CSS file -->
    <style>
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
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="text"], textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        textarea {
            resize: none;
            height: 100px;
        }
        .btn {
            background-color: #ffcc00;
            color: #333;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #333;
            color: #ffcc00;
        }
        .message {
            margin-top: 10px;
            text-align: center;
            font-size: 16px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Department</h1>
        
        <form method="POST" action="add_department_process.php">
            <label for="name">Department Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter department name">

            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="Enter department description"></textarea>

            <button type="submit" class="btn">Add Department</button>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body Styling */
body {
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Login Container */
.login-container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Heading Styling */
.login-container h2 {
    margin-bottom: 20px;
    font-size: 1.8rem;
    color: #2c3e50;
}

/* Form Labels */
.login-container label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
    color: #34495e;
    font-size: 1rem;
    font-weight: bold;
}

/* Form Inputs */
.login-container input[type="email"],
.login-container input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #bdc3c7;
    border-radius: 4px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

/* Focused Input */
.login-container input:focus {
    border-color: #3498db;
    outline: none;
}

/* Submit Button */
.login-container button {
    background-color: #3498db;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

/* Hovered Button */
.login-container button:hover {
    background-color: #2980b9;
}

     </style>
</head>
<body>
    <div class="login-container">
        <h2>Employee Login</h2>
        <form action="login_process.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

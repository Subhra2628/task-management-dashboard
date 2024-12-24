<!DOCTYPE html>
<html>
<head>
    <style>
        input[type=password], input[type=text] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:hover, input[type=password]:hover {
            background-color: darkgrey;
        }

        button {
            background-color: #04AA6D;
            color: white;
            padding: 10px 10px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 1;
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
        }

        button:hover {
            background-color: blueviolet;
        }
    </style>
</head>
<body>
    <h1 style="text-align:center">Log-In</h1>
    <form action="admin_log_in_process.php" method="POST">
        <label for="name">User Name</label>
        <input type="text" name="name" id="name" placeholder="User Name" autocomplete="off" required>
        <br><br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <br>

        <label>Show Password</label>
        <input type="checkbox" onclick="checking()">
        <br><br>

        <button type="submit">Log-In</button>
    </form>

    <script>
        function checking() {
            const input = document.getElementById('password');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
    </script>
</body>
</html>

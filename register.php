<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

    <h2>Register</h2>
    <form action="action_register.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <span class="hint">Only lowercase, at least 3 characters</span>

        <input type="password" name="password" placeholder="Password" required>
        <span class="hint">One uppercase, 1 symbol, 1 number, at least 8 characters</span>

        <input type="password" name="repeat" placeholder="Repeat Password" required>
        <span class="hint">Must match password</span>

        <input type="submit" value="Register">
    </form>

</body>
</html>
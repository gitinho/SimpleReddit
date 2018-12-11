<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

    <form action="action_login.php" method="post">
      <label for="username">Username</label><br>
      <input type="text" placeholder="username" name="username">
      <label for="password">Password</label><br>
      <input type="password" placeholder="password" name="password">
      <div>
        <input type="submit" value="Login">
      </div>
      <a href="register.php">Register</a>
    </form>

</body>
</html>
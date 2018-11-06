<?php
include_once('includes/init.php');
include_once('database/user.php');
hash_password('Ben1', '123');
hash_password('Ben2', '234');
hash_password('Ben3', '345');

  if (isLoginCorrect($_POST['username'], md5($_POST['password']))) {
    //setCurrentUser($_POST['username']);
    echo "<script type='text/javascript'>alert('Done it!');</script>";
    //$_SESSION['success_messages'][] = "Login Successful!";
  } else {
    echo "<script type='text/javascript'>alert('Something goes wrong!');</script>";
    //$_SESSION['error_messages'][] = "Login Failed!";
  }

  //header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
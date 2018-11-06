<?php
include_once('includes/init.php');
include_once('database/user.php');

  if (isLoginCorrect($_POST['username'], $_POST['password'])) {
    //setCurrentUser($_POST['username']);
    echo "<script type='text/javascript'>alert('Done it!');</script>";
    //$_SESSION['success_messages'][] = "Login Successful!";
  } else {
    //$_SESSION['error_messages'][] = "Login Failed!";
  }

  //header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
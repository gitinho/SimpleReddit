<?php
    include_once('includes/init.php');
    include_once('database/user.php');

    if (addNewUser($_POST['username'], $_POST['password'])) {
        echo "<script type='text/javascript'>alert('Done it!');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Something goes wrong!');</script>";
    }
?>
<?php
    include_once('database/comment.php');
    include_once('database/connection.php');
    include_once('includes/session.php');
    insertComment($_SESSION["id_comment"] + 1, $_POST['id'], $_POST['username'], date('Y-m-d H:i:s'), $_POST['text']);

    header ("location: {$_SESSION["redirect"]}");

?>
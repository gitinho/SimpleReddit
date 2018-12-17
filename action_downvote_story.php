<?php
    include_once('database/story.php');
    include_once('database/connection.php');
    include_once('includes/session.php');
    downvoteStory($_SESSION["story"]["id_story"], $_SESSION["id_user"], $_SESSION["story"]["plus"]);

    header ("location: {$_SESSION["redirect"]}");

?>
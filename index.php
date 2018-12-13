<?php
    include_once('includes/init.php');

    include_once('database/story.php');
    include_once('database/comment.php');

    $stories = getAllStories();
    $comments = getAllComments();

    //include_once('login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <title>Document</title>
</head>
<body>
    <?php
        if ($_SESSION["logged_in"]) {
            echo $_SESSION["username"];
            echo '<a href="action_logout.php">Log Out</a>';
            echo '<a href="edit.php">Edit account</a>';
        } else {
            $_SESSION["redirect"] = "index.php";
            echo '<a href="login.php">Log In</a>';
            echo '<a href="register.php">Register</a>';
        }?>

<section id="list">
    <h1>List</h1>
    <?php 
        foreach( $stories as $story) {
            $id =  $story['id_story'];
            echo '<h1>' . "<a href=\"story_item.php?id_story=".$id."\">" .  $story['title'] . '</a>' . '</h1>';
            echo '<p>' .  $story['brief_intro'] . '</p>';
        } 
        ?>
</section>
    
</body>
</html>
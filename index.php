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
    <link rel="stylesheet" type="text/css" media="screen" href="layout.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />

    <title>Document</title>
</head>
<body>
<div class="wrapper">
<div class="box header">

<?php
        $_SESSION["redirect"] = "index.php";
        if ($_SESSION["logged_in"]) {
            ?>
            <div class = "logo"> <img src="style/logo.png" width="55"> </div>
            <div class = "username"><?= $_SESSION['username'] ?></div>
            <?php
            echo '<a href="action_logout.php"> Log Out</a>';
            echo '<a href="edit.php">Edit account</a>';
        } else { 
            ?>
            <div class = "logo"> <img src="style/logo.png" width="55"> </div>
            <?php
            echo '<a href="login.php"> Log In </a>';
            echo '<a href="register.php">Sign up</a>';
        }?>

</div>
<div class="box content">
<section id="list">
    <?php 
        foreach( $stories as $story) {
            $id =  $story['id_story'];
            echo '<h3>' . "<a href=\"story_item.php?id_story=".$id."\">" .  $story['title'] . '</a>' . '</h1>';
            echo '<p>' .  $story['brief_intro'] . '</p>';
        } 
        ?>
</section>
</div>

  <div class="box footer">
        </div>
</div>
</body>
</html>


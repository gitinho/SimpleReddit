<!DOCTYPE html>
<html lang="en">
<?php 
        include_once('database/story.php');
        include_once('database/comment.php');
        include_once('database/connection.php');
        include_once('includes/session.php');
        $_SESSION["redirect"] = basename($_SERVER['REQUEST_URI']);

        $id_story = $_GET['id_story'];
        
        $db = new PDO('sqlite:database/stories_db.db');
        $stmt = $db->prepare("SELECT * 
                               FROM stories 
                               WHERE id_story = ?
                               ORDER BY published");
        $stmt->execute(array($id_story));
        $story =  $stmt->fetch();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="style/layout.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/main.css" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$story["title"]?></title>
</head>
<body>
<div class="wrapper">
<div class="box header">
    <section id="story">
        <?php
        include_once('includes/header.php');
        
        /*
        echo'<h1>'. $id_story .'</h1>'; 
        */
        ?>
        </div>
        <div class = "box content">
        <?php
        echo '<div class="votes">';

        $_SESSION["story"] = $story;
		if($_SESSION["logged_in"]) {
			if(hasUpvotedStory($_SESSION["id_user"], $id_story))
				echo '<a href="action_upvote_story.php">⬆</a>';
			else
				echo '<a href="action_upvote_story.php">⇧</a>';
			echo $story['plus'];
			if(hasDownvotedStory($_SESSION["id_user"], $id_story))
				echo '<a href="action_downvote_story.php">⬇</a>';
			else
				echo '<a href="action_downvote_story.php">⇩</a>';
		} else {
			echo '<a href="login.php">⇧</a>';
			echo $story['plus'];
			echo '<a href="login.php">⇩</a>';
		}

        echo '</div>';

         echo '<h1>' . $story['title']  . ', by <a href="user_page.php?id_user=' . $story["id_user"] . '">' . getUsername($story["id_user"]) . '</a></h1>';
        
         echo '<p>' . $story['brief_intro'] . '</p>';
         echo '<p>'. $story['storie_text'] .'</p>';
         echo '<section id="comments">';
         ?>
         </div>
         <div class = "box footer">
         <?php
         $stmt = $db->prepare("SELECT *
                FROM comments 
                WHERE id_story = $id_story AND id_parent_comment = 0");
         $stmt->execute();
         $comments = $stmt->fetchAll();
         print_comments($db, $id_story, $comments);
         ?>
         
         </div>
         
         <form action="add_comment.php" method="post">
            <h2>Add a comment</h2>
            <?php 
                $_SESSION["redirect"] = basename($_SERVER['REQUEST_URI']);
                if ($_SESSION["logged_in"]) {?>
            <label>Username: 
                <?php echo $_SESSION["username"]; ?>
            </label>
            <input type="hidden" name="username" value="<?=$_SESSION["username"]?>">
            <label>Comment
                <textarea name="text"></textarea>
            </label>
            <input type="hidden" name="id" value="<?=$id_story?>">
            <input type="hidden" name="id_parent" value="0">
            <input type="submit" value="Reply">
            <?php } else {
                ?>
                <div id = "links">
                <?php
                echo '<a href="login.php">Log In</a>';
                echo '<a href="register.php">Register</a>';
                ?>
                </div>
                <?php
            }?>
        </form>
        
        <?php echo '</section>';
     ?>

    </section>
    </div>
    
<?php include_once('includes/footer.php'); ?>
</body>
</html>
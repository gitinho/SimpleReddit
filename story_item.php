<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="layout.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Story</title>
</head>
<body>
<div class="wrapper">
<div class="box header">
    <section id="story">
        <?php 
        include_once('database/story.php');
        include_once('database/comment.php');
        include_once('includes/session.php');
        $id_story = $_GET['id_story'];
        /*
        echo'<h1>'. $id_story .'</h1>'; 
        */
        $db = new PDO('sqlite:database/stories_db.db');
        $stmt = $db->prepare("SELECT * 
                               FROM stories 
                               WHERE id_story = ?
                               ORDER BY published");
        $stmt->execute(array($id_story));
        $story =  $stmt->fetch();

        $stmt = $db->prepare("SELECT *
                               FROM comments 
                               WHERE id_story = $id_story");
        $stmt->execute();
        $comments = $stmt->fetchAll();

         echo '<h1>' . $story['title']  . '</h1>';
         ?>
         </div>
         <div class = "box content">
         <?php
         echo '<p>' . $story['brief_intro'] . '</p>';
         echo '<p>'. $story['storie_text'] .'</p>';
         echo '<section id="comments">';
         ?>
         </div>
         <div class = "box footer">
         <?php
         foreach($comments as $comment){
            ?>
            <div id = "comment">
            <?php
           echo '<article class="comment">';
             echo '<span>' . $comment['id_user'] . '</span>';
             echo '<span>' . $comment['published'] . '</span>';
             echo '<p>' . $comment['comment_text'] . '</p>';
           echo '</article>';
           ?>
           </div>
           <?php
         }?>
         
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
</body>
</html>
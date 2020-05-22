<?php
    include_once('database/user.php');
    function getAllComments() {
        global $dbh;
        $stmt = $dbh->prepare("SELECT *
                               FROM comments JOIN
                                    stories USING (id_story)
                               ORDER BY id_comment DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    function getAllCommentsByIdStory($id_story) {
        global $dbh;
        $stmt = $dbh->prepare("SELECT *
                               FROM comments 
                               WHERE id_story = ?");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getCommentById($id_story, $id_comment) {
        global $dbh;
        $stmt = $dbh->prepare("SELECT *
                               FROM comments JOIN
                                    stories USING (id_story)
                               WHERE id_story = $id_story
                               AND id_comment = $id_comment");
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    function insertComment($id_parent_comment, $id_story, $id_comment, $id_user, $date, $text) {
        global $dbh;
        $stmt = $dbh->prepare("INSERT INTO comments VALUES (?,?,?,?,?,?,?);");
        $stmt->execute(array($id_parent_comment, $id_story, $id_comment, $id_user, $date, $text, 0));
        upvote($id_user, $id_comment, $id_story, 0);
    }

    function hasUpvoted($id_user, $id_comment, $id_story) {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM comment_upvotes WHERE id_comment = $id_comment AND id_story = $id_story AND id_user = $id_user");
        $stmt->execute();
        return $stmt->fetch() !== false;
    }

    function upvote($id_user, $id_comment, $id_story, $plus) {
        global $dbh;
        if(hasUpvoted($id_user, $id_comment, $id_story)){
            $stmt = $dbh->prepare("DELETE FROM comment_upvotes WHERE id_comment = $id_comment AND id_story = $id_story AND id_user = $id_user");
            $stmt->execute();
            $stmt = $dbh->prepare("UPDATE comments SET plus = $plus - 1 WHERE id_comment = $id_comment AND id_story = $id_story");
            $stmt->execute();
        } else {
            $stmt = $dbh->prepare("INSERT INTO comment_upvotes VALUES ($id_comment, $id_story, $id_user)");
            $stmt->execute();
            $stmt = $dbh->prepare("UPDATE comments SET plus = $plus + 1 WHERE id_comment = $id_comment AND id_story = $id_story");
            $stmt->execute();
        }

        if(hasDownvoted($id_user, $id_comment, $id_story)){
            $stmt = $dbh->prepare("DELETE FROM comment_downvotes WHERE id_comment = $id_comment AND id_story = $id_story AND id_user = $id_user");
            $stmt->execute();
            $stmt = $dbh->prepare("UPDATE comments SET plus = $plus + 2 WHERE id_comment = $id_comment AND id_story = $id_story");
            $stmt->execute();
        }
    }

    function hasDownvoted($id_user, $id_comment, $id_story) {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM comment_downvotes WHERE id_comment = $id_comment AND id_story = $id_story AND id_user = $id_user");
        $stmt->execute();
        return $stmt->fetch() !== false;
    }

    function downvote($id_user, $id_comment, $id_story, $plus) {
        global $dbh;
        if(hasDownvoted($id_user, $id_comment, $id_story)){
            $stmt = $dbh->prepare("DELETE FROM comment_downvotes WHERE id_comment = $id_comment AND id_story = $id_story AND id_user = $id_user");
            $stmt->execute();
            $stmt = $dbh->prepare("UPDATE comments SET plus = $plus + 1 WHERE id_comment = $id_comment AND id_story = $id_story");
            $stmt->execute();
        } else {
            $stmt = $dbh->prepare("INSERT INTO comment_downvotes VALUES ($id_comment, $id_story, $id_user)");
            $stmt->execute();
            $stmt = $dbh->prepare("UPDATE comments SET plus = $plus - 1 WHERE id_comment = $id_comment AND id_story = $id_story");
            $stmt->execute();
        }

        if(hasUpvoted($id_user, $id_comment, $id_story)){
            $stmt = $dbh->prepare("DELETE FROM comment_upvotes WHERE id_comment = $id_comment AND id_story = $id_story AND id_user = $id_user");
            $stmt->execute();
            $stmt = $dbh->prepare("UPDATE comments SET plus = $plus - 2 WHERE id_comment = $id_comment AND id_story = $id_story");
            $stmt->execute();
        }
    }

    function print_comments($db, $id_story, $comments) {
        
        foreach($comments as $comment){
            echo '<div id = "comment">';
           echo '<article class="comment">';
             echo '<span><a href="user_page.php?id_user=' . $comment['id_user'] . '">' . getUsername($comment['id_user']) . '</a></span>';
             echo '<span>' . $comment['published'] . '</span>';
			 
			 if($_SESSION["logged_in"]) {

				echo '<div class="votes"><a href="action_upvote.php';
				echo '?id_comment=' . $comment['id_comment'];
				echo '&id_story=' . $comment['id_story'];
				echo '&plus=' . $comment['plus'];
				
				if (hasUpvoted($_SESSION["id_user"], $comment['id_comment'], $comment['id_story']))
					echo '">⬆</a>';
				else
					echo '">⇧</a>';
	
				echo $comment['plus'];
	
				echo '<a href="action_downvote.php';
				echo '?id_comment=' . $comment['id_comment'];
				echo '&id_story=' . $comment['id_story'];
				echo '&plus=' . $comment['plus'];
	
				if (hasDownvoted($_SESSION["id_user"], $comment['id_comment'], $comment['id_story']))
					echo '">⬇</a></div>';
				else
					echo '">⇩</a></div>';
			 } else {
				echo '<div class="votes"><a href="login.php';
				echo '">⇧</a>';
				echo $comment['plus'];
				echo '<a href="login.php';
				echo '">⇩</a></div>';
			 }

             echo '<p>' . $comment['comment_text'] . '</p>';
           $_SESSION["id_comment"] = $comment['id_comment'];
           $id_comment = $comment['id_comment'];
           ?>

            <form action="add_comment.php" method="post" class="reply">
            <?php 
                $_SESSION["redirect"] = basename($_SERVER['REQUEST_URI']);
                if ($_SESSION["logged_in"]) {?>
            <label>Reply
                <textarea name="text"></textarea>
            </label>
            <input type="hidden" name="id" value="<?=$id_story?>">
            <input type="hidden" name="id_parent" value=<?=$id_comment?>>
            <input type="submit" value="Submit">
            <?php }

            
           $stmt = $db->prepare("SELECT *
                                 FROM comments 
                                 WHERE id_story = $id_story AND id_parent_comment = $id_comment");
           $stmt->execute();
           $subcomments = $stmt->fetchAll();
           echo '</article>';
           echo '<div class="subcomments">';
           print_comments($db, $id_story, $subcomments);
           echo '</div>';
           echo '</div>';
        }


    }

?>
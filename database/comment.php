<?php
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
                               FROM comments JOIN
                                    stories USING (id_story)
                               WHERE id_story = ?");
        $stmt->execute(array($id));
        return $stmt->fetch();
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

?>
<?php
    function getAllStories() {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM stories ORDER BY published");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function getStoryById($id_story){
        global $dbh;
        $stmt = $dbh->prepare("SELECT * 
                               FROM stories 
                               JOIN users USING (id_user)
                               WHERE id_story = ?
                               ORDER BY published");
        $stmt->execute(array($id));
        return $stmt->fetch();
    }
?>
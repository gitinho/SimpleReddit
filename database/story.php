<?php
    function getAllCategories() {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM stories ORDER BY published");
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>
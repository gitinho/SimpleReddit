<?php
    function isLoginCorrect($username, $password) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $stmt->execute(array($username, $password)); 
        return $stmt->fetch() !== false;
    }

    function isUserAlreadyInDB($username) {
        global $dbh;
        $stmt = $dbh->prepare("SELECT *
                               FROM users WHERE username = ?");
        $stmt->execute();
        return $stmt->fetch() !== false;
    }

    function addNewUser($username, $password) {
        global $dbh;
        $stmt = $dbh->prepare("INSERT INTO users (username, password) VALUES('$username', '$password');");
        $stmt->execute();
        return $stmt->fetch() !== false;
    }

?>
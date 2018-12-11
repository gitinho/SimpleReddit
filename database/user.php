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
        $stmt = $dbh->prepare("INSERT INTO users VALUES (?, ?)");
        $stmt->execute();
        return $stmt->fetch() !== false;
    }

    function hash_password($username, $password) {
        global $dbh;
        $hashed_password = md5($password);
        $stmt = $dbh->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->execute(array($hashed_password, $username));
        return $stmt->fetch() !== false;
    }

?>
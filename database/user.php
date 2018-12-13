<?php
    function isLoginCorrect($username, $password) {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * 
                               FROM users 
                               WHERE username = ?
                               ORDER BY id_user");
        $stmt->execute(array($username));
        $userData = $stmt->fetch();
        if ($userData !== false){
            if(!password_verify($password, $userData['password'])){
                return false;
            }
            return true;
        }
        return false;
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

        $hashed_password = makeHash($password);
        $sql = 'INSERT INTO users(username, password) '
                . 'VALUES(:username, :password)';
 
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $hashed_password,
        ]);
        return $stmt->fetch() !== false;
    }

    function makeHash($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

?>
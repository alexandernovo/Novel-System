<?php

class Signup extends Dbh
{
    protected function setUser($firstname, $lastname, $username, $email, $pwd)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (users_username, users_email, users_pwd, users_role) VALUES (?, ?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if ($stmt->execute(array($username, $email, $hashedPwd, 'READER'))) {
            $query = "SELECT * FROM users WHERE users_username = :username LIMIT 1";
            $statement = $this->connect()->prepare($query);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            $userData = $statement->fetch(PDO::FETCH_ASSOC);
            $stmt2 = $this->connect()->prepare("INSERT INTO profiles (firstname,lastname,users_id) VALUES(?,?,?);");
            $stmt2->execute([$firstname, $lastname, $userData['users_id']]);

            if ($userData) {
                return array(
                    'id' => $userData['users_id'],
                    'username' => $username,
                    'role' => 'READER'
                );
            }
        } else {
            return null;
        }
    }


    protected function checkUser($username, $email)
    {
        $stmt = $this->connect()->prepare('SELECT users_username FROM users WHERE
        users_username = ? OR users_email = ?;');

        if (!$stmt->execute(array($username, $email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function getUserId($username)
    {
        $stmt = $this->connect()->prepare('SELECT users_id FROM users WHERE users_username = ?;');

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../profile.php?error=profilenotfound");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileData;
    }
}

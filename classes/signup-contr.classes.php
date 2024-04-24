<?php
session_start();
class SignupContr extends Signup
{
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $pwd;
    private $pwdRepeat;

    public function __construct($firstname, $lastname, $username, $email, $pwd, $pwdRepeat)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
    }

    public function signupUser()
    {
        $errors = [];
        if ($this->emptyInput() == false) {
            $errors['empty'] = 'Please fill in all fields';
        }
        if ($this->invalidUsername() == false) {
            $errors['username'] = 'Invalid username';
        }
        if ($this->invalidEmail() == false) {
            $errors['email'] = 'Invalid Email';
        }
        if ($this->pwdMatch() == false) {
            $errors['password'] = 'Password do not match';
        }
        if ($this->uidTakenCheck() == false) {
            $errors['username'] = 'Username is taken';
        }

        if (count($errors) == 0) {
            $user = $this->setUser($this->firstname, $this->lastname, $this->username, $this->email, $this->pwd);
            if ($user) {
                $_SESSION["userid"] = $user["id"];
                $_SESSION["userusername"] = $user['username'];
                $_SESSION["name"] = $user['firstname'] . ' ' . $user['lastname'];
                $_SESSION["users_role"] = $user["role"];
                $_SESSION["firstname"] = $this->firstname;
                $_SESSION["lastname"] = $this->lastname;
                header('location: ../index.php?=Welcome ' . $user['username']);
            }
        } else {
            $this->retainValue();
            $this->returnError($errors);
            $this->redirect('../signup');
        }
    }
    function retainValue()
    {
        $_SESSION['inputs'] = $_POST;
    }
    function returnError($error)
    {
        // Store the error in the session
        if (!isset($_SESSION['errors'])) {
            $_SESSION['errors'] = array();
        }
        $_SESSION['errors'] = $error;
    }
    function redirect($location, $data = [])
    {
        $url = $location . ".php";
        if (!empty($data)) {
            $url .= "?" . http_build_query($data);
        }
        header("Location: " . $url);
        exit;
    }

    private function emptyInput()
    {
        if (
            empty($this->firstname) || empty($this->lastname) ||
            empty($this->username) || empty($this->email) || empty($this->pwd) ||
            empty($this->pwdRepeat)
        ) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUsername()
    {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        if ($this->pwd !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck()
    {
        if (!$this->checkUser($this->username, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function fetchUserId($username)
    {
        $userId = $this->getUserId($username);
        return $userId[0]["users_id"];
    }
}

<?php

class LoginContr extends Login
{
    private $username;
    private $pwd;

    public function __construct($username, $pwd)
    {
        $this->username = $username;
        $this->pwd = $pwd;
    }

    public function loginUser()
    {
        if ($this->emptyInput()) {
            header("location: ../login.php?empty=Please fill in the fields");
            exit();
        }

        $this->getUser($this->username, $this->pwd);
    }

    private function emptyInput()
    {
        if (empty($this->username) || empty($this->pwd)) {
            return true;  // Corrected this line
        }
        return false;
    }
}

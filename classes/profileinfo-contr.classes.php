<?php

class ProfileInfoContr extends ProfileInfo {
    
    private $userId;
    private $userUsername;

    public function __construct($userId, $userUsername) {
        $this->userId = $userId;
        $this->userUsername = $userUsername;
    }

    public function defaultProfileInfo() {
        $profileAbout = "Tell people about yourself!";
        $profileTitle = "Hi! I am " . $this->userUsername;
        $profileText = "Welcome to my profile";
        $this->setProfileInfo($profileAbout, $profileTitle, $profileText, $this->userId);
    }

    public function updateProfileInfo($about, $introTitle, $introText) {
        //Error Handlers
        if($this->emptyInputCheck($about, $introTitle, $introText) == true) {
            header("location: ../profilesettings.php?error=emptyinput");
            exit();
        }
        //Update Profile Info
        $this->setNewProfileInfo($about, $introTitle, $introText, $this->userId);
    }

    private function emptyInputCheck($about, $introTitle, $introText) {
        $result;
        if(empty($about) || empty($introTitle) || empty($introText)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }
}
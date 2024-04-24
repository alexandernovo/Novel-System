<?php
session_start();

unset($_SESSION['users_id']);
session_destroy();
header('Location: login.php');

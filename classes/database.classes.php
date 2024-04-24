<?php

class Dbh {
   protected function connect() {
    try {
        $username = "root";
        $password = "";
        $dbh = new PDO('mysql:host=localhost;dbname=books', $username, $password);
        return $dbh;
    }
    catch (PDOExeption $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
   }
}
<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    //Sample Database Connection Syntax for PHP and MySQL.

    //Connect To Database

    $hostname="adversary.gg";
    $username="bool";
    $password="boolsquad";
    $dbname="BoolDB";

    $conn= mysqli_connect($hostname,$username, $password, $dbname) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");

    function getDb($conn=null) { /* probably a bad name but I never do this and have no idea what to call it... I think drupal uses get for the same concept without OO */
        static $db;

        if($conn !== null) {
            $db = $conn;
        }

        return $db;
    }
?>
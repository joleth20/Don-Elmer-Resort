<?php
$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'resortdb';

$con = new mysqli($host, $username, $password, $dbname);
if (!$con) {
    die("Cannot connect to the database." . $con->error);   
}

<?php
$localhost = 'localhost';
$user = 'root';
$password = '';
$dbname = 'admin_panel';

$conn = new mysqli($localhost, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error Connection: " . $conn->connect_error);
}

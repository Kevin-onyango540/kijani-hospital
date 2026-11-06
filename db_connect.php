<?php
// Render + FreeSQLDatabase connection
$host = getenv('DB_HOST') ?: 'sql8.freesqldatabase.com';
$dbname = getenv('DB_NAME') ?: 'sql8840064';
$username = getenv('DB_USER') ?: 'sql8840064';
$password = getenv('DB_PASSWORD') ?: ' 4c2s5MJuAm';
$port = 3306;

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
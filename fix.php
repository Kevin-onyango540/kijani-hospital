<?php
$port = 3306; // we will try 3306 first
$conn = new mysqli("localhost", "root", "", "", $port);

if ($conn->connect_error) {
    // try 3307 if 3306 fails
    $port = 3307;
    $conn = new mysqli("localhost", "root", "", "", $port);
}

echo "<h2>Connected on port $port</h2>";

// Create database if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS kijani_hospital");
echo "Database kijani_hospital ensured<br>";

$conn->select_db("kijani_hospital");

// Create tables
$conn->query("CREATE TABLE IF NOT EXISTS patients (
  patient_id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100),
  id_number VARCHAR(20) UNIQUE,
  phone VARCHAR(15),
  gender ENUM('Male','Female'),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS doctors (
  doctor_id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100),
  specialization VARCHAR(100),
  phone VARCHAR(15),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255)
)");

$conn->query("CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE,
  password VARCHAR(255),
  role ENUM('receptionist','doctor','admin','pharmacy')
)");

$conn->query("CREATE TABLE IF NOT EXISTS appointments (
  appointment_id INT AUTO_INCREMENT PRIMARY KEY,
  patient_id INT,
  doctor_id INT,
  appointment_date DATE,
  appointment_time TIME,
  status ENUM('pending','completed','cancelled') DEFAULT 'pending'
)");

$conn->query("CREATE TABLE IF NOT EXISTS prescriptions (
  prescription_id INT AUTO_INCREMENT PRIMARY KEY,
  patient_id INT,
  doctor_id INT,
  diagnosis TEXT,
  drugs TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS bills (
  bill_id INT AUTO_INCREMENT PRIMARY KEY,
  patient_id INT,
  amount DECIMAL(10,2),
  payment_status ENUM('unpaid','paid') DEFAULT 'unpaid'
)");

echo "<h1 style='color:green'>SUCCESS! 6 tables created on port $port</h1>";
echo "<p>Now update your db_connect.php to use port $port</p>";
?>
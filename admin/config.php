<?php
$servername = "localhost";
$username = "etisparl_appointment_db";
$password = "etisparl_appointment_db";
$dbname = "etisparl_appointment_db";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

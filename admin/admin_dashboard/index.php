<?php
session_start();
require '../config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../"); // Redirect to login page if not logged in
    exit();
}

// Fetch data from the database
$totalOrdersQuery = "SELECT COUNT(*) AS total FROM appointments";
$hairTreatmentQuery = "SELECT COUNT(*) AS count FROM appointments WHERE services = 'Hair_Treatment'";
$hairColorQuery = "SELECT COUNT(*) AS count FROM appointments WHERE services = 'Hair_color'";
$hydraFacialQuery = "SELECT COUNT(*) AS count FROM appointments WHERE services = 'Hydra_Facial'";

$totalOrdersResult = $conn->query($totalOrdersQuery)->fetch_assoc();
$hairTreatmentResult = $conn->query($hairTreatmentQuery)->fetch_assoc();
$hairColorResult = $conn->query($hairColorQuery)->fetch_assoc();
$hydraFacialResult = $conn->query($hydraFacialQuery)->fetch_assoc();

$totalOrders = $totalOrdersResult['total'];
$hairTreatmentCount = $hairTreatmentResult['count'];
$hairColorCount = $hairColorResult['count'];
$hydraFacialCount = $hydraFacialResult['count'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <div class="card-container">
            <a href="all/?services=total" class="card">
                <h2>Total Orders</h2>
                <p><?php echo $totalOrders; ?></p>
            </a>
            <a href="all/?services=Hair_Treatment" class="card">
                <h2>Hair Treatment Orders</h2>
                <p><?php echo $hairTreatmentCount; ?></p>
            </a>
            <a href="all/?services=Hair_color" class="card">
                <h2>Hair Color Orders</h2>
                <p><?php echo $hairColorCount; ?></p>
            </a>
            <a href="all/?services=Hydra_Facial" class="card">
                <h2>Hydra Facial Orders</h2>
                <p><?php echo $hydraFacialCount; ?></p>
            </a>
        </div>
    </div>
</body>
</html>

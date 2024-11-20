<?php
session_start();
require '../../config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php"); // Redirect to login page if not logged in
    exit();
}
$services = $_GET['services'];

// Fetch appointments for Hair Treatment
if($services != 'total')
{
$query = "SELECT * FROM appointments WHERE services = '$services' ORDER BY id DESC";
$result = $conn->query($query);
}
else
{
    $query = "SELECT * FROM appointments ORDER BY id DESC ";
$result = $conn->query($query);
}
if (!$result) {
    die("Query failed: " . $conn->error);
}

$appointments = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title><?php echo $services ?> Appointments</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $services ?> Appointments</h1>
        <table class="appointments-table">
            <thead>
                <tr>
                    <?php if($services == 'total')
                                {  ?>
                              <th>Services</th>  
                              <?php } ?>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                    <?php if($services== 'Hair_Treatment' || $services == 'total'){ ?>
                    <th>Price</th>
                    <th>Length</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                <tr>
                <?php if($services == 'total')
                                {  ?>
                             <td><?php echo htmlspecialchars($appointment['services']); ?></td> 
                              <?php } ?>
                    <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['name']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['phone']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['date']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['time']); ?></td>
                    <?php if($services== 'Hair_Treatment' || $services == 'total'){ ?>
                    <td><?php echo htmlspecialchars($appointment['approximatePrice']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['selectedLength']); ?></td>
                    <?php } ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

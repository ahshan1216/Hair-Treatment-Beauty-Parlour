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

// Get form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$time = $_POST['time'];
$service = $_POST['service'];
$selectedLength = isset($_POST['selectedLength']) ? $_POST['selectedLength'] : '';
$approximatePrice = isset($_POST['approximatePrice']) ? $_POST['approximatePrice'] : '';

// Insert data into database
$sql = "INSERT INTO appointments (name, phone, date, time, selectedLength, approximatePrice,services) VALUES (?, ?, ?, ?, ?, ?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $name, $phone, $date, $time, $selectedLength, $approximatePrice,$service);

if ($stmt->execute()) {
 

$chat_id = '6753633594';
$token = '7143835896:AAFVKR3jVbFZygEG_MMYdOlDiapIW55rwzs';
$api_url = "https://api.telegram.org/bot$token/sendMessage";

    $text = urlencode("$service\nName: $name\nPhone: $phone\nDate: $date\nTime: $time\nLength: $selectedLength\nApproximate Price: $approximatePrice");
    $url = "$api_url?chat_id=$chat_id&text=$text";

    // Send message to Telegram
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2); // 2 seconds timeout
    $result = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $sql = "UPDATE appointments SET `check` = 1 WHERE name = '$name' AND phone = '$phone' AND services='$service'";

// Execute the query
// Execute the query
if ($conn->query($sql) === TRUE) {
   // echo "Record updated successfully";
} else {
   // echo "Error updating record: " . $conn->error;
}

$conn->close();
    }



    echo "<script>
        localStorage.removeItem('appointmentName');
        localStorage.removeItem('appointmentPhone');
        localStorage.removeItem('appointmentDate');
        localStorage.removeItem('appointmentTime');
        localStorage.removeItem('selectedLength');
        localStorage.removeItem('approximatePrice');
         window.location.href = '../thankyou/';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>

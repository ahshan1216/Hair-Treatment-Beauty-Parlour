<?php
// Check if the 'service' parameter is set in the URL
if (isset($_GET['service'])) {
    // Fetch the value of the 'service' parameter
    $service = $_GET['service'];

    // Output the value or use it as needed
   
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KBLK9W6W');</script>
<!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment System</title>
    <link rel="stylesheet" href="appstyles.css">
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBLK9W6W"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="container">
        <h1>Book Your Appointment</h1>
        <form id="appointmentForm" action="save_appointment.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>
            
            <label for="date">Appointment Date:</label>
            <input type="date" id="date" name="date" required onclick="this.showPicker()">
            
            <label for="time">Appointment Time:</label>
            <input type="time" id="time" name="time" required onclick="this.showPicker()">
            

<!-- Hidden input for the 'service' parameter -->
            <?php if (isset($service)): ?>
                <input type="hidden" name="service" value="<?php echo htmlspecialchars($service); ?>">
            <?php endif; ?>

            <button type="submit">Submit</button>
        </form>
        <div id="confirmation" class="hidden">
            <h2>Appointment Confirmed</h2>
            <p id="confirmMessage"></p>
        </div>
    </div>
    <script>
        if (window.localStorage.getItem('selectedLength')) {
            const form = document.getElementById('appointmentForm');
            const selectedLengthInput = document.createElement('input');
            selectedLengthInput.type = 'hidden';
            selectedLengthInput.name = 'selectedLength';
            selectedLengthInput.value = window.localStorage.getItem('selectedLength');
            form.appendChild(selectedLengthInput);

            const approximatePriceInput = document.createElement('input');
            approximatePriceInput.type = 'hidden';
            approximatePriceInput.name = 'approximatePrice';
            approximatePriceInput.value = window.localStorage.getItem('approximatePrice');
            form.appendChild(approximatePriceInput);
        }
    </script>
</body>
</html>

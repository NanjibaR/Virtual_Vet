<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "virtual_vet";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the values from the form
    $trxID = $_POST["trxID"];
    $phoneNumber = $_POST["phoneNumber"];

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the values into the table
    $sql = "INSERT INTO getpaymentinf (Number, TrxID) VALUES ('$phoneNumber', '$trxID')";

    if ($conn->query($sql) === TRUE) {
        // Display the payment confirmation popup window
        echo '<script>window.open("http://localhost/Payment/PopPayment.html", "Payment Confirmation", "width=400,height=400");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

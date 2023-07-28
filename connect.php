<?php
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$consultation = $_POST['consultation'];
$date = $_POST['date'];

// Check if the form was submitted before accessing $_POST values
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Form submission method not allowed.";
    exit;
}

$conn = new mysqli('localhost:3307', 'root', '', 'book_db');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Prepare the statement
$stmt = $conn->prepare("INSERT INTO booking (name, number, email, consultation, date) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}

// Bind the parameters
$stmt->bind_param("sssss", $name, $number, $email, $consultation, $date);

// Execute the statement
if ($stmt->execute()) {
    echo "You have Successfully Booked Your Appointment!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>

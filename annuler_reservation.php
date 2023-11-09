<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: connecter.php");
    exit();
}

// Include database connection file
include 'base.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reservation_id'])) {
    // Get the reservation_id from the form submission
    $reservation_id = $_POST['reservation_id'];

    // Prepare a delete statement for the reservation
    $sql = "DELETE FROM reservation WHERE reservation_id = ? AND user_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ii", $reservation_id, $_SESSION['user_id']);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Reservation cancelled successfully.";
        } else {
            echo "Error: Could not execute the cancellation query: " . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare the cancellation query: " . $conn->error;
    }
    
    // Close connection
    $conn->close();
}

// Redirect back to the reservation success page
header("Location: list.php");
exit();
?>

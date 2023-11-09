<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: connecter.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file
    include 'base.php';
    
    // Retrieve espace_id and reservation dates from the form submission
    $espace_id = $_POST['espace_id'];
    $user_id = $_SESSION['user_id']; // User ID from session
    $date_debut = $_POST['date_debut']; // Start date
    $date_fin = $_POST['date_fin']; // End date
    
    $conn->begin_transaction();
    
    // Prepare an insert statement for the reservation
    $sql = "INSERT INTO reservation (date_debut, date_fin, statut_de_la_reservation, espace_id, user_id) VALUES (?, ?, 1, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssii", $date_debut, $date_fin, $espace_id, $user_id);
        
        
        if ($stmt->execute()) {
            $update_sql = "UPDATE espace SET disponibilite = 0 WHERE espace_id = ?";
            if ($update_stmt = $conn->prepare($update_sql)) {
                $update_stmt->bind_param("i", $espace_id);
                $update_stmt->execute();
                $update_stmt->close();
            } else {
                echo "Error: Could not prepare the update query: " . $conn->error;
               
                $conn->rollback();
                exit();
            }
            
           
            $conn->commit();

            header("Location: list.php"); 
            exit();
        } else {
            echo "Error: Could not execute the reservation query: " . $stmt->error;
            $conn->rollback();
        }
        
        $stmt->close();
    } else {
        echo "Error: Could not prepare the reservation query: " . $conn->error;
        $conn->rollback();
    }
    
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>

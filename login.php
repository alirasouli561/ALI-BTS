<?php

include 'base.php';

$login = $_POST['login'];
$mdp = $_POST['mdp'];

$stmt = $conn->prepare("SELECT user_id, login FROM utilisateur WHERE login = ? AND mdp = ?");
$stmt->bind_param("ss", $login, $mdp);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    
    session_start();

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['login'] = $login;

    header("Location: index.php");
    exit();
} else {
    echo "<script>alert('Identifiants invalides'); window.location.href='login_page.php';</script>";
    exit(); 
}

$stmt->close();
$conn->close();

?>

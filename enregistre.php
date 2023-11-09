<?php
include 'base.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$login = $_POST['login'];
$mdp = $_POST['mdp'];


$check_query = "SELECT * FROM utilisateur WHERE login = ?";
$stmt_check = $conn->prepare($check_query);
$stmt_check->bind_param("s", $login);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Utilisateur existe déjà');</script>";
} else {

    $stmt_insert = $conn->prepare("INSERT INTO utilisateur (nom, prenom, login, mdp) VALUES (?, ?, ?, ?)");
    $stmt_insert->bind_param("ssss", $nom, $prenom, $login, $mdp);

    if ($stmt_insert->execute()) {
        header('Location: indexx.php');
        exit;
    } else {
        echo "<script>alert('Erreur : " . $stmt_insert->error . "');</script>";
    }

    $stmt_insert->close();
}

$stmt_check->close();
$conn->close();
?>

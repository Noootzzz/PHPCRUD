<?php

session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="logout.php">Déconnexion</a>
    <h1>Home</h1>
    <br>
    <h2>Message : <?= htmlspecialchars($_SESSION['message']) ?></h2>
    <br>
    <h2>Id : <?= htmlspecialchars($_SESSION['id']) ?></h2>
    <br>
    <h2>Pseudo : <?= htmlspecialchars($_SESSION['pseudo']) ?></h2>
    <br>
    <h2>Email : <?= htmlspecialchars($_SESSION['email']) ?></h2>
</body>
</html>
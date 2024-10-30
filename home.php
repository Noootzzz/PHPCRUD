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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Home</h1>
        <div id="side-infos">
            <div id="title-pseudo">
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {echo '<p class="admin-title">Admin</p>';} ?>
                <h2> Pseudo : <?= htmlspecialchars($_SESSION['pseudo']) ?></h2>
            </div>
            <br>
            <h2>Email : <?= htmlspecialchars($_SESSION['email']) ?></h2>
        </div>
        <a href="logout.php" id="logout">Déconnexion</a>
    </header>
    <main>

        

    </main>
</body>
</html>
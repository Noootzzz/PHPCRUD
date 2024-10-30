<?php

session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

// Générer le CSRF token si besoin
if(!isset($_SESSION['csrf']) || empty($_SESSION['csrf']))
{
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
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

        <div>
            <p><?= htmlspecialchars($_SESSION['content']); ?></p>
        </div>

        <form action="messages.php" method="POST" id="messages-form">
            <input type="text" name="content" id="content" placeholder="Envoyer un message">
            <input type="hidden" name="token" value="<?= $_SESSION['csrf']; ?>">
            <input type="submit" value="Envoyer">
        </form>

    </main>
</body>
</html>
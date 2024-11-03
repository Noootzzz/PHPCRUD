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

// Connexion à la base de données
require_once 'bdd.php';

// Récupérer le contenu du message, la date et l'id de qui l'a écrit
$getMessagesInfos = $connexion->prepare(
    'SELECT * FROM messages JOIN users ON messages.id_user = users.id ORDER BY messages.date_time DESC LIMIT 10'
);
$getMessagesInfos->execute();

// Si les messages sont bien récupérés
if ($getMessagesInfos->rowCount() > 0) {
    // Récupérer les messages
    $messages = $getMessagesInfos->fetchAll(PDO::FETCH_ASSOC);
    // Inverser l'ordre des messages pour afficher le dernier en bas
    $messages = array_reverse($messages);
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
            <?php foreach ($messages as $message) {echo '<p>'. 
                $message['content']. '<br>Écrit par '. 
                $message['pseudo'].' le '. 
                $message['date_time']. '</p>';
            
                 // Si admin
                 if($_SESSION['is_admin'] == 1){
                    // Ajouter un bouton pour modifier le message
                    echo '<a href="edit_message.php?id='. $message['id']. '" id="edit-message">Modifier</a>';
                    // Ajouter un bouton pour supprimer le message
                    echo '<a href="delete_message.php?id='. $message['id']. '" id="delete-message">Supprimer</a>';                    
                }
            } 
            ?>
        </div>

        <form action="messages.php" method="POST" id="messages-form">
            <input type="text" name="content" id="content" placeholder="Envoyer un message" autofocus>
            <input type="hidden" name="token" value="<?= $_SESSION['csrf']; ?>">
            <input type="submit" value="Envoyer">
        </form>

    </main>
</body>
</html>
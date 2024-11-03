<?php 
session_start();

// Connexion à la base de données
require_once 'bdd.php';

// Vérifiez la connexion à la bdd
if (!isset($connexion) || $connexion === null) {
    die("Erreur : connexion à la base de données non établie.");
}

if (isset($_POST['id_message']) && !empty($_POST['id_message']) && isset($_POST['content']) && !empty($_POST['content'])) {
    $message_id = $_POST['id_message'];
    $content = $_POST['content'];
    
    // Préparer et exécuter la requête SQL pour mettre à jour le message
    $update = $connexion->prepare("UPDATE messages SET content = :content WHERE id_message = :id_message");
    $update->execute([
        ':content' => $content,
        ':id_message' => $message_id
    ]);

    header("Location: home.php");
    exit();

} else {
    die("<p>Id du message ou contenu invalide.</p>");
}
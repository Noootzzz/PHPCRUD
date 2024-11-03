<?php 
session_start();

// Connexion à la base de données
require_once 'bdd.php';

// Vérifiez la connexion à la bdd
if (!isset($connexion) || $connexion === null) {
    die("Erreur : connexion à la base de données non établie.");
}

if (isset($_POST['id_message']) && !empty($_POST['id_message'])) {
    $message_id = $_POST['id_message'];
    
    // Préparer et exécuter la requête SQL pour supprimer le message
   $delete = $connexion->prepare("DELETE FROM messages WHERE id_message = :id_message");
   $delete->execute([
        ':id_message' => $message_id
   ]);

   header("Location: home.php");
   exit();

} else {
    die("<p>Id du message invalide.</p>");
}
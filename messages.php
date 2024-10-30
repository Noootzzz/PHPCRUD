<?php

session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

//On vérifie le csrf token
if(!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf'])
{
    die('<p>CSRF invalide</p>');
}

//Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf']);

//Si on reçoit le champ content et qu'il n'est pas vide
if(isset($_POST['content']) && !empty($_POST['content']))
{
    $content = htmlspecialchars($_POST['content']);
}

if(isset($content) && !empty($content))
{
    //Pas d'erreur, on sauvegarde en BDD
    require_once 'bdd.php';

    // Insertion du commentaire dans la base de données
    $insertion = $connexion->prepare(
        'INSERT INTO messages (content, id_user)
        VALUES (:content, :id_user)'
    );
    $insertion->execute([
        'content' => $content,
        'id_user' => $_SESSION['id']
    ]);

} else {
    die("<p>Erreur lors de l'ajout du contenu dans la BDD</p>");
}










header("Location:home.php");
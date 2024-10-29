<?php

session_start();


//On vérifie le csrf token
if(!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf'])
{
    die('<p>CSRF invalide</p>');
}


//Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf']);


//Si on reçoit le champ pseudo et qu'il n'est pas vide
if(isset($_POST['pseudo']) && !empty($_POST['pseudo']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
}
//Si on a pas reçu ou que le champ est vide
else{
    header("Location:index.php");
    die("<p>Le pseudo est obligatoire.</p>");
}


if(isset($_POST['email']) && !empty($_POST['email']))
{
    $email = htmlspecialchars($_POST['email']);
}
else{
    header("Location:index.php");
    die("<p>L'email est obligatoire.</p>");
}


if(isset($_POST['psw']) && !empty($_POST['psw']))
{
    $plainPsw = htmlspecialchars($_POST['psw']);
    $hashedPsw = password_hash(
        $plainPsw, 
        PASSWORD_BCRYPT, 
        []
    );
}
else{
    header("Location:index.php");
    die("<p>Le mot de passe est obligatoire.</p>");
}


if(isset($pseudo) && isset($email) && isset($hashedPsw))
{
    //Pas d'erreur, on sauvegarde en BDD
    
    require_once 'bdd.php';

    // Check si l'user existe déjà avec le pseudo et email
    $checkUser = $connexion->prepare(
        'SELECT id FROM users WHERE pseudo = :pseudo OR email = :email'
    );
    $checkUser->execute([
        'pseudo' => $pseudo,
        'email' => $email
    ]);
    // Si il existe déjà
    if ($checkUser->rowCount() > 0) {
        header("Location:index.php");
        die("<p>Un utilisateur avec ce pseudo ou cet email existe déjà.</p>");
    } else {
        // Si il n'existe pas déjà on l'insert
        $sauvegarde = $connexion->prepare(
            'INSERT INTO users (pseudo, email, psw)
            VALUES (:pseudo, :email, :psw)'
        );
        $sauvegarde->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'psw' => $hashedPsw
        ]);

        if ($sauvegarde->rowCount() > 0) {
            $_SESSION['message'] = "Vous êtes bien inscrit.";
            $_SESSION['id'] = $connexion->lastInsertId(); // Récupère l'id de l'utilisateur créé
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['email'] = $email;
            // Redirection vers la page d'accueil
            header("Location:home.php");
            exit();
        } else {
            header("Location:index.php");
            die("<p>Une erreur est survenue lors de l'inscription.</p>");
        }
    }
}
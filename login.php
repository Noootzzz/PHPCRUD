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
if(isset($_POST['login_pseudo']) && !empty($_POST['login_pseudo']))
{
    $pseudo = htmlspecialchars($_POST['login_pseudo']);
}
//Si on a pas reçu ou que le champ est vide
else{
    header("Location:index.php");
    die("<p>Le pseudo est obligatoire.</p>");
}

if(isset($_POST['login_psw']) && !empty($_POST['login_psw']))
{
    $plainPsw = htmlspecialchars($_POST['login_psw']);
}

if(isset($pseudo) && isset($plainPsw))
{
    //Pas d'erreur, on sauvegarde en BDD
    require_once 'bdd.php';

    // Vérifiez que la connexion à la bdd
    if (!isset($connexion) || $connexion === null) {
        die("Erreur : connexion à la base de données non établie.");
    }

    // Vérifier si l'utilisateur existe avec le pseudo donné
    $checkUser = $connexion->prepare(
        'SELECT id, pseudo, email, psw, is_admin FROM users WHERE pseudo = :pseudo'
    );
    $checkUser->execute([
        'pseudo' => $pseudo
    ]);

    // Si l'utilisateur existe
    if ($checkUser->rowCount() == 1) {
        // Récupérer les données de l'utilisateur
        $user = $checkUser->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le mot de passe est correct
        if (password_verify($plainPsw, $user['psw'])) {
            // Stocker les informations de l'utilisateur en session
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];
            $_SESSION['home-message'] = "Vous êtes bien connecté $pseudo.";
            // Redirection vers la page d'accueil
            header("Location:home.php");
            exit();
        }
        else {// Si le mot de passe n'est pas bon
            header("Location:index.php");
            die("<p>Mot de passe invalide.</p>");
            
        }

    } else {// Si l'user n'existe pas
        header("Location:index.php");
        die("<p>Pseudo ou mot de passe invalide.</p>");        
    }


}
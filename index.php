<?php 

session_start();

if(!isset($_SESSION['csrf_article_add']) || empty($_SESSION['csrf_article_add']))
{
    $_SESSION['csrf_article_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription/Connexion</title>
</head>
<body>
    <form action="register.php" method="POST">
        <label for="name">Nom : </label>
        <input type="text" name="name" id="name" placeholder="Nathan">
        <br>
        <label for="name">Email : </label>
        <input type="text" name="name" id="name" placeholder="exemple@gmail.com">
        <br>
        <label for="name">Mot de passe : </label>
        <input type="text" name="name" id="name" placeholder="...........................">
        <br>
        <label for="description">Description : </label>
        <textarea name="description" id="description" rows="5" cols="30"></textarea>
    </form>
</body>
</html>
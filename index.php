<?php 

session_start();

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
    <title>Inscription/Connexion</title>
</head>
<body>
    <!-- FORMULAIRE D'INSCRIPTION -->
    <div id="inscription-form">
        <h2>S'inscrire</h2>
        <form action="register.php" method="POST">
            <label for="pseudo">Nom : </label>
            <input type="text" name="pseudo" id="pseudo" placeholder="Nathan">
            <br>
            <label for="email">Email : </label>
            <input type="text" name="email" id="email" placeholder="exemple@gmail.com">
            <br>
            <label for="psw">Mot de passe : </label>
            <input type="password" name="psw" id="psw" placeholder="...........................">
            <br>
            <input type="hidden" name="token" value="<?= $_SESSION['csrf']; ?>">
            <button type="submit">S'inscrire</button>
        </form>
    </div>
    <!-- FORMULAIRE DE CONNEXION -->
    <div id="connexion-form">
        <h2>Se connecter</h2>
        <form action="login.php" method="POST">
            <label for="email">Email : </label>
            <input type="text" name="email" id="email" placeholder="exemple@gmail.com">
            <br>
            <label for="psw">Mot de passe : </label>
            <input type="text" name="psw" id="psw" placeholder="...........................">
            <br>
            <input type="hidden" name="token" value="<?= $_SESSION['csrf']; ?>">
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>
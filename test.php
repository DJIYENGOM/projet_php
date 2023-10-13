<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">votre Gmail</label>
        <input type="mail" name="mail">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["mail"];

    // Utilisation de preg_match pour valider l'adresse e-mail
    if (preg_match("/^[A-Z][a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]+[A-Z] $/", $email)) {
        echo "L'adresse e-mail est valide.";
    } else {
        echo "L'adresse e-mail n'est pas valide.";
    }
}

?>
</body>
</html>

<?php
session_start(); // Démarrez la session
$errors = array();
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si les champs obligatoires sont vides ou invalides
    if (
        empty($_POST["nom"]) || !preg_match("/^[a-zA-ZÀ-ÿ\s\-]+$/", $_POST["nom"]) ||
        empty($_POST["prenom"]) || !preg_match("/^[a-zA-ZÀ-ÿ\s\-]+$/", $_POST["prenom"]) ||
        empty($_POST["poids"]) || $_POST["poids"] <= 0 || $_POST["poids"] > 400 ||
        empty($_POST["temperature"]) || $_POST["temperature"] <= 0 || $_POST["temperature"] > 50 ||
        empty($_POST["age"]) ||
        empty($_POST["toux"])
    ) {
        if (empty($_POST["nom"]) || !preg_match("/^[a-zA-ZÀ-ÿ\s\-]+$/", $_POST["nom"])) {
            $errors['nom'] = "Le nom est obligatoire et ne doit contenir que des lettres et des espaces.";
        }
        if (empty($_POST["prenom"]) || !preg_match("/^[a-zA-ZÀ-ÿ\s\-]+$/", $_POST["prenom"])) {
            $errors['prenom'] = "Le prénom est obligatoire et ne doit contenir que des lettres et des espaces.";
        }
        if (empty($_POST["poids"]) || $_POST["poids"] <= 0 || $_POST["poids"] > 400) {
            $errors['poids'] = "Le poids est obligatoire et doit être compris entre 0 et 400 kg.";
        }
        if (empty($_POST["temperature"]) || $_POST["temperature"] <= 0 || $_POST["temperature"] > 50) {
            $errors['temperature'] = "La température est obligatoire et doit être comprise entre 0 et 50 °C.";
        }
        if (empty($_POST["age"])) {
            $errors['age'] = "L'âge est obligatoire.";
        }
        if (empty($_POST["toux"])) {
            $errors['toux'] = "La réponse à la toux est obligatoire.";
        }

    }else {

        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $temperature = $_POST["temperature"];
        $maux_de_tete = isset($_POST["maux_de_tete"]) ? $_POST["maux_de_tete"] : "Non";
        $diarree = isset($_POST["diarree"]) ? $_POST["diarree"] : "Non";
        $age = $_POST["age"];
        $toux = $_POST["toux"];
        $score = 0 ;

        // Calculer le score en fonction des critères
        if ($temperature >= 15 && $temperature <= 25) {
            $score += 10; // Ajoutez 10% au score
        } elseif ($temperature >= 29) {
            $score += 15; // Ajoutez 15% au score
        }

        if ($maux_de_tete == "Oui") {
            $score += 10; // Ajoutez 10% au score
        }

        if ($diarree == "Oui") {
            $score += 10; // Ajoutez 5% au score
        }

        if ($age == "18-30 ans") {
            $score += 5; // Ajoutez 5% au score
        } elseif ($age == "31-50 ans") {
            $score += 10; // Ajoutez 10% au score
        } elseif ($age == "Plus de 50 ans") {
            $score += 15; // Ajoutez 15% au score
        }

        if ($toux == "Oui") {
            $score += 15; // Ajoutez 15% au score
        }

        // Stockez également les données du formulaire dans la session
        $_SESSION['user_data'] = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'temperature' => $temperature,
            'maux_de_tete' => $maux_de_tete,
            'diarree' => $diarree,
            'age' => $age,
            'toux' => $toux,
            'score' => $score
        );
       // Affichez les informations de l'utilisateur à partir de la session
        $user_data = $_SESSION['user_data'];
        echo "<h1>Résultat du test COVID-19</h1>";
        echo "<p>Nom : " . $user_data['nom'] . "</p>";
        echo "<p>Prénom : " . $user_data['prenom'] . "</p>";
        echo "<p>Âge : " . $user_data['age'] . "</p>";
        echo "<p>Température : " . $user_data['temperature'] . " °C</p>";
        echo "<p>Maux de tête : " . $user_data['maux_de_tete'] . "</p>";
        echo "<p>Diarrhée : " . $user_data['diarree'] . "</p>";
        echo "<p>Toux : " . $user_data['toux'] . "</p>";
        echo "<p>Votre score est de :" . $user_data['score']."% </p>";

    if ($user_data['score'] >= 0 && $user_data['score'] < 29) {
        echo "<p>Vous êtes peu susceptible d'avoir le COVID-19.</p>";
    } elseif ($user_data['score'] >= 30 && $user_data['score'] <= 50) {
        echo "<p>Vous pourriez être susceptible d'avoir le COVID-19. Consultez un professionnel de la santé pour plus d'informations.</p>";
    } else {
        echo "<p>Vous pourriez être à haut risque de COVID-19. Consultez immédiatement un professionnel de la santé.</p>";
    }

    }
}



?>

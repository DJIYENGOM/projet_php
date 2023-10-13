

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une activité</title>
    
</head>
<body>
<?php
session_start();
$projets = array(
    array(
        'nom' => 'Éducation pour Tous',
        'description' => 'Accroître l\'accès à l\'éducation de qualité au Sénégal.',
        'activites' => array(
            array(
                'nom_A' => 'Construction d\'écoles',
                'description_A' =>'Construction d\'écoles',
                'date'=>'2023-06-09'
            ), 
            array(
                'nom_A' =>'Fourniture de matériel scolaire',
                'description_A' =>'donner des fournitures ',
                'date'=>'2023-06-09'
            ),
        ),
        'partenaires' => array(
            array(
            'nom_partenaire' => 'D_CLICK'
            ),
            array(
                'nom_partenaire' => 'ecole normale'
                ),
        ),
    ),
    array(
        'nom' => 'Développement Touristique',
        'description' => 'Promotion du tourisme au Sénégal pour stimuler l\'économie.',
        'activites' => array(
            array(
                'nom_A' => 'Aménagement des sites touristiques',
                'description_A' =>'Aménagement des sites',
                'date'=>'2023-06-09'
            ), 
            array(
                'nom_A' =>'Promotion du tourisme culturel',
                'description_A' =>'gerer les promotions touristiques ',
                'date'=>'2023-06-09'
            ),
            array(
                'nom_A' =>'Infrastructure hôtelière et de transport',
                'description_A' =>'mettre des infrastructures ',
                'date'=>'2023-06-09'
            ),
            array(
                'nom_A' =>'Organisation d\'événements touristiques',
                'description_A' =>'mettre en place des organisations ',
                'date'=>'2023-06-09'
            ),
        ),
        'partenaires' => array(
            array(
            'nom_partenaire' => 'Développement Touristique'
            ),
        ),
    ),
    array(
        'nom' => 'Santé',
        'description' => 'Amélioration des soins de santé pour les mères et les enfants.',
        'activites' => array(  
            array(
                'nom_A' => 'Construction de centres de santé maternelle',
                'description_A' =>'gerer les constructions ',
                'date'=>'2023-06-09'
            ),
            array(
                'nom_A' =>'Fourniture de soins prénatals et postnatals',
                'description_A' =>'gerer les soins ',
                'date'=>'2023-06-09'
            ),
            array(
                'nom_A' =>'Campagnes de vaccination',
                'description_A' =>'mettre des capagnes de vaccination ',
                'date'=>'2023-06-09'
            ),
            array(
                'nom_A' =>'Formation des professionnels de la santé',
                'description_A' =>'mettre en place des formations ',
                'date'=>'2023-06-09'
            ),
            array(
                'nom_A' =>'Éducation sur la planification familiale',
                'description_A' =>'la sensibilisation ',
                'date'=>'2023-06-09'
            ),
        ),
        'partenaires' => array(
            array(
            'nom_partenaire' => 'partenaire Santé'
            ),
        ),
    ),
    array(
        'nom' => 'Énergie Solaire',
        'description' => 'Développement de l\'énergie solaire pour l\'accès à l\'électricité.',
        'activites' => array( 
            array('nom_A' => 'Installation de panneaux solaires',
                'description_A' =>'gerer les installation de panneaux',
                'date'=>'2023-06-09'
            ),
            array('nom_A' => 'Réseau de distribution d\'électricité solaire',
                'description_A' =>'gerer les reseaux',
                'date'=>'2023-06-03'
            ),
            array('nom_A' => 'Promotion de l\'énergie renouvelable',
                'description_A' =>'gerer la promotion',
                'date'=>'2023-08-05'
            ),
        ),
        'partenaires' => array(
            array(
            'nom_partenaire' => 'partenaire Énergie Solaire '
            ),
        ),
    ),
);
$_SESSION['projet']=array();
$_SESSION['projet']=$projets;


?>

<h1>Ajouter d'activités à un projet</h1>
<!-- Formulaire pour ajouter une activité -->
<form method="post" action="">
    <label for="">Sélectionnez un projet :</label>
    <select name="projet" id="projet">
        <?php
        foreach ($projets as $projet) {
            echo '<option value="' . $projet['nom'] . '">' . $projet['nom'] . '</option>';
        }
        ?>
    </select>
    
    <br>
    <label for="nom_activite">Nom activité :</label>
    <input type="text" name="nom_activite" id="nom_activite">
    <br> <br>
    <label for="description_activite">Description de l'activité :</label>
    <textarea name="description_activite" id="description_activite"></textarea>
    <br><br>

    <label for="date_activite">Date de l'activité :</label>
    <input type="date" name="date_activite" id="date_activite">
    <br>

    <input type="submit" value="Ajouter une activité"> <br><br>
</form> <br>

<?php
// Récupérer les données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projetSelectionne = $_POST['projet'];
    $nomActivite = $_POST['nom_activite'];
    $descriptionActivite = $_POST['description_activite'];
    $dateActivite = $_POST['date_activite'];

    // Parcourir le tableau de projets pour trouver le projet sélectionné le  & permet de faire des modification en meme temps sur le projet qu'on se trouve
    foreach ($projets as &$projet) {
        if ($projet['nom'] === $projetSelectionne) {
            // Ajouter une nouvelle activité au projet sélectionné
            $nouvelleActivite = array(
                'nom_A' => $nomActivite,
                'description_A' => $descriptionActivite,
                'date' => $dateActivite,
            );
            $projet['activites'][] = $nouvelleActivite;
        }
    }
}

?>


<h1>Liste de projets</h1>
<?php
//pour lister les projets en fonction de leur nombre d'activité
$djiye;
for ($i=0; $i < count($projets) ; $i++) { 
  for ($j=$i; $j < count($projets) ; $j++) { 
    if(count($projets[$i]['activites']) > count($projets[$j]['activites'])){
            $djiye=$projets[$i];
            $projets[$i]=$projets[$j];
            $projets[$j]=$djiye;
            
    }
  }
}

// Affichage des projets
foreach ($projets as $key=> $projet) {
    echo $key .'<br>';

    echo 'Nom du projet : ' . $projet['nom'] . '<br>';
    echo 'Description du projet : ' . $projet['description'] . '<br>';
    echo 'Activités du projet :<br>';
    echo 'Nombre d\'activités : ' . count($projet['activites'] ). '<br>';
    echo '<ul>';
        foreach ($projet['activites'] as $activite) {
            echo '<li>';
            echo 'Nom de l\'activité : ' . $activite['nom_A'] . '<br>';
            echo 'Description de l\'activité : ' . $activite['description_A'] . '<br>';
            echo 'Date : ' . $activite['date'] . '<br>';
            echo '</li>';
        
        }
     echo '</ul>';

            echo'<form action="voir_plus.php" method="post">';
            echo ' <input type="hidden" name="index" value="'.$key.'">';
            echo' <input type="submit" value="Voir plus" name="voir_plus">';
            echo'</form>';
    }

?>









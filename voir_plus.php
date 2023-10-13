<?php
session_start();
$projet=$_SESSION['projet'];
if(isset($_POST['index'])){
    echo '<b> Nom projet: </b>' .$projet[$_POST['index']]["nom"] .'<br>';
    echo '<b> Description du projet: </b>' .$projet[$_POST['index']]["description"] .'<br>';

    echo '<ul>';
    foreach ($projet[$_POST['index']]['activites'] as $activite) {
        echo '<li>';
        echo '<b> Nom de l\'activité : </b> ' . $activite['nom_A'] . '<br>';
        echo 'Description de l\'activité : ' . $activite['description_A'] . '<br>';
        echo 'Date : ' . $activite['date'] . '<br>';
        echo '</li>';
    
    }
        echo '</ul>';

    echo '<ul>';
    echo '<b> Les partenaires : </b>';
        foreach ($projet[$_POST['index']]['partenaires'] as $numero=> $partenaire) {
            echo '<li>';
            echo  $partenaire['nom_partenaire'] . '<br>';
            echo '</li>';
   
 }
 echo '/<ul>';
}
?>
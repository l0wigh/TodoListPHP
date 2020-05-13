<?php
    if(isset($_GET["tache"])){
        $fichier = fopen("list.csv", "a");
        $tache = array($_GET["tache"]);
        fputcsv($fichier, $tache);
        fclose($fichier);
    }
    if(isset($_GET["lignedel"])){
        $ligne = $_GET["lignedel"] - 1;
        $csv = array_map('str_getcsv', file("list.csv"));
        unset($csv[$ligne]);
        $final = array_values($csv);
        $fichier = fopen("list.csv", "w");
        for($i = 0; $i < count($final); $i++){
            $tache = array($final[$i][0]);
            fputcsv($fichier, $tache);
        }
        fclose($fichier);
    }
    
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TodoList</title>
    </head>
    <body style="background: black; color: white;">
        <table border=1 style="padding: 1px; font-size: 40px;">
            <?php
                $fichier = fopen("list.csv", "r");
                while($maligne = fgetcsv($fichier)){
                    echo '<tr>';
                    foreach($maligne as $unecell){
                        echo '<td>'.htmlspecialchars($unecell, ENT_QUOTES, 'UTF-8').'</td>';
                    }
                echo '</tr>';
                }
            ?>
        </table>
        <form method="GET">
            <input type="text" name="tache" id="tache">
            <button type="submit">Ajouter</button>
        </form>
        <form method="GET">
            <input type="number" name="lignedel" id="lignedel">
            <button type="submit">Supprimer</button>
        </form>
    </body>
</html>

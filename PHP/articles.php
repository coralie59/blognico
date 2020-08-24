<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> blog</title>
	<link rel="stylesheet" media="screen" type="text/css" href="feuille de style general.php">
    </head>
        
    <body>
        <?php 
        include 'menu.php';
        ?>
        <h1> blog!</h1>
        <p>creation d'article</p>
<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=site;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// On récupère les 5 derniers billets
$req = $bdd->query('SELECT id, titre, text, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM blog ORDER BY date_creation DESC');

while ($donnees = $req->fetch())
{
?>
<div class="news">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>
    
    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($donnees['text']));
    ?>
    <br />
    <em><a href="articles.php?article=<?php echo $donnees['id']; ?>">lire la suite</a></em>
    </p>
</div>
<?php
} // Fin de la boucle des billets
$req->closeCursor();
?>
</body>
</html>


<?php 
// Vérification des champs du formulaire
if (empty($_POST['titre']) || empty($_POST['description']) || empty($_POST['artiste']) || empty($_POST['image'])
    || strlen($_POST['description']) <3 
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)
){
    // Redirection vers le formulaire d'ajout 
    header('Location: ajouter.php?');

   }
    
//    Si tout est bon, on insère dans la BDD
   else{
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);
// Connexion à la BDD
    include 'bdd.php';
    $bdd = connectToSql('artbox');
// Insertion dans la BDD
    $insert = $bdd->prepare('INSERT INTO oeuvres(titre, description, artiste, image) VALUES(?, ?, ?, ?)');
    // Exécution de la requête
    $insert->execute(array($titre, $description, $artiste, $image));
// Redirection vers la page de l'oeuvre ajoutée
    header('Location: oeuvre.php?id=' . $bdd->lastInsertId());

   }

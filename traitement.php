

<?php 
// Vérification des champs du formulaire
if (empty($_POST['titre']) || empty($_POST['description']) || empty($_POST['artiste']) || empty($_POST['image'])
    || strlen($_POST['description']) <3 
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)
){
    // Redirection vers le formulaire d'ajout 
    header('Location: ajouter.php?');
    // on utilise exit pour s'assurer que le script s'arrête ici
    exit();

   }
    
//    Si tout est bon, on insère dans la BDD
   else{
    // Récupération et nettoyage des données avec trim()
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $artiste = trim($_POST['artiste'] ?? '');
    $image = trim($_POST['image'] ?? '');
// Vérification que l'URL pointe vers une image de maniere detournée en demandant ses dimensions
    $imgIsImg = getimagesize($image);
    if ($imgIsImg === false) {

    header('Location: ajouter.php?error=invalidimage');
    exit();
    }

// Connexion à la BDD
    include 'bdd.php';
    $bdd = connectToSql('artbox');
// Insertion dans la BDD
    $insert = $bdd->prepare('INSERT INTO oeuvres(titre, description, artiste, image) VALUES(?, ?, ?, ?)');
    // Exécution de la requête
    $insert->execute(array($titre, $description, $artiste, $image));
// Redirection vers la page de l'oeuvre ajoutée
    header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
    exit();

   }

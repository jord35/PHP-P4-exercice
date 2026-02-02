<?php
    require 'header.php';
    require 'bdd.php';
    // On se connecte à la base. 
    $bdd = connectToSql('artbox');
    

    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
        exit();
    }

    /*
      On récupère l'ID En s'assurant que ce soit un entier et qu'il
      n'y ait pas de chaîne bizarre, ce qui permet de pouvoir réutiliser
      la variable ailleurs.  
      */
    $id = (int) $_GET['id'];

    // On prépare la requête SQL pour récupérer l'oeuvre correspondante. 
    $sqlQuery = "SELECT * FROM oeuvres WHERE id =  ?";

    // On envoie la requête, mais sans la valeur. La base SQL va donc préparer son plan. 
    $oeuvreStatement = $bdd->prepare($sqlQuery);
    // On envoie les valeurs séparément, ce qui permet à la base SQL de les traiter sans jamais pouvoir changer son plan. 
    $oeuvreStatement->execute([$id]);
    // On transforme les données en tableaux pour qu'elles soient utilisables. 
    $oeuvre = $oeuvreStatement->fetch();

    

    // Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    if(!$oeuvre) {
        header('Location: index.php');
        exit();
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= htmlspecialchars($oeuvre['image']) ?>" alt="<?= htmlspecialchars($oeuvre['titre']) ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= htmlspecialchars($oeuvre['titre']) ?></h1>
        <p class="description"><?= htmlspecialchars($oeuvre['artiste']) ?></p>
        <p class="description-complete">
             <?= htmlspecialchars($oeuvre['description']) ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>

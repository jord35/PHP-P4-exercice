<?php require 'header.php'; ?>

<form action="traitement.php" method="POST" novalidate>
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste">
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image">
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
    </div>

    <input type="submit" value="Valider" name="submit">
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            const titre = document.getElementById('titre').value.trim();
            const artiste = document.getElementById('artiste').value.trim();
            const image = document.getElementById('image').value.trim();
            const description = document.getElementById('description').value.trim();
// Validation des champs obligatoires
           if (!titre || !artiste || !image || !description) {
        event.preventDefault();
        alert('Veuillez remplir tous les champs du formulaire.');
        return;
    }
// Validation des longueurs minimales
    if (description.length < 3) {
        event.preventDefault();
        alert("La description doit contenir au moins 3 caractères.");
        return;
    }
// Validation de l'URL de l'image
    const urlPattern = /^(https?:\/\/)[^\s$.?#].[^\s]*$/;
    if (!urlPattern.test(image)) {
        event.preventDefault();
        alert("Veuillez entrer une URL valide pour l'image.");
        return;
    }
});

// message venant du PHP via ?error=invalidimage
if (document.location.search.includes('error=invalidimage')) {
    alert("L'URL de l'image ne pointe pas vers une image valide.");
}
    </script>
</form>

<?php require 'footer.php'; ?>

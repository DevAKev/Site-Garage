<?php
require_once('lib/car_tools.php');
require_once('templates/header.php');

// A CORRIGER
// if (isset($_POST['saveCar'])) {

//     $res = saveCar($pdo, $_POST['marque'], $_POST['modele'], $_POST['prix'], $_FILES['image'], $_POST['annee_mise_en_circulation'], $_POST['kilometrage'], $_FILES['galerie_images'], $_POST['caracteristiques'], $_POST['equipements_options'], $_POST['carburant']);
//     var_dump($res);
// }


?>

<!-- FORM START -->
<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae tenetur fuga ullam ad eaque at soluta asperiores, ipsam ratione reiciendis harum repellendus quibusdam minima illum ut velit quod quasi! Esse doloremque officia a mollitia eius, consequuntur quasi soluta suscipit at iste voluptates animi exercitationem voluptate tempore itaque, harum impedit inventore modi sed ad omnis ea. Nam, repellendus! Vero maiores sint, quod a commodi eveniet porro quae? Totam animi eius nobis, laborum corporis commodi rem cumque quasi, accusamus facilis cum exercitationem ut assumenda perferendis. Enim itaque nemo officia, pariatur beatae, ab quibusdam harum laudantium quidem incidunt totam. Dolor deserunt nisi, earum aliquid facilis perferendis amet autem, distinctio corrupti laboriosam maxime, asperiores voluptatem a ullam quae repellendus! Cupiditate quis itaque cum porro, perferendis quidem sapiente possimus cumque nesciunt praesentium quos asperiores voluptas quibusdam necessitatibus sequi alias voluptates nisi. Totam, eveniet dolorum. Nesciunt qui sunt similique cum cupiditate earum ipsa molestias beatae debitis nulla? Veritatis modi qui autem consequatur deserunt tempora inventore quam sint, delectus nesciunt sapiente aliquam quas repudiandae totam est praesentium iusto corporis sunt similique? Laborum exercitationem tenetur nulla quos quo soluta assumenda distinctio blanditiis. Eaque facilis ipsum, dolores, iure minima inventore ab voluptatibus quisquam dolore id ullam obcaecati omnis maiores?</p>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="marque" class="form-label">Marque : </label>
        <input type="text" name="marque" id="marque" class="form-control">
    </div>
    <div class="mb-3">
        <label for="modele" class="form-label">Modèle : </label>
        <input type="text" name="modele" id="modele" class="form-control">
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix : </label>
        <input type="number" name="prix" id="prix"> €
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Photo Principale : </label>
        <input type="file" name="image" id="image">
    </div>
    <div class="mb-3">
        <label for="annee_mise_en_circulation">Année : </label>
        <input type="number" name="annee_mise_en_circulation" id="annee_mise_en_circulation">
    </div>
    <div class="mb-3">
        <label for="kilometrage">Kilométrage : </label>
        <input type="number" name="kilometrage" id="kilometrage">
    </div>
    <div class="mb-3">
        <label for="galerie_images" class="form-label">Autres Photos : </label>
        <input type="file" name="galerie_images" id="galerie_images">
    </div>
    <div class="mb-3">
        <label for="caracteristiques" class="form-label">Caracteristiques : </label>
        <textarea name="caracteristiques" id="caracteristiques" cols="30" rows="5" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="equipements_options" class="form-label">Options du véhicule : </label>
        <textarea name="equipements_options" id="equipements_options" cols="10" rows="5" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="carburant" class="form-label">Carburant : </label>
        <select name="carburant" id="carburant" class="form-select">
            <option value="1">Essence</option>
            <option value="2">Diesel</option>
            <option value="3">Electrique</option>
            <option value="4">Hybride</option>
        </select>
    </div>
    <input type="submit" value="Enregistrer" name="saveCar" class="btn btn-primary">
</form>

<!-- FOOTER START -->
<?php
require_once('templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
require_once('lib/scripts.php');
?>
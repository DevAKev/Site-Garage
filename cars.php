<!-- STYLES CARS-->
<link rel="stylesheet" href="assets/css/cars.css">
<?php
require_once('templates/header.php');


$cars = getCars($pdo);
?>

<!-- HEADER START -->
<!-- Fil d'ariane -->
<nav aria-label="breadcrumb" class="mt-5 pt-5">
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item active" aria-current="page">Nos véhicules d'occasions</li>
    </ol>
  </div>
</nav>
<!-- HEADER END -->

<!-- MAIN START -->
<h1>Liste des véhicules</h1>
<p>Vous trouverez ci-dessous la liste des véhicules disponibles à la vente.</p>
<div class="mb-3">
  <form id="filter_form" action="" method="GET" class="form-control">
    <!-- Filtrage par marque -->
    <label for="marque">Marque :</label>
    <select name="marque" id="marque">
      <option value="">Toutes les marques</option>
      <option value="Abarth">Abarth</option>
      <option value="Alfa Romeo">Alfa Romeo</option>
      <option value="Aston Martin">Aston Martin</option>
      <option value="Audi">Audi</option>
      <option value="Bentley">Bentley</option>
      <option value="BMW">BMW</option>
      <option value="Cadillac">Cadillac</option>
      <option value="Chevrolet">Chevrolet</option>
      <option value="Chrysler">Chrysler</option>
      <option value="Citroen">Citroen</option>
      <option value="Corvette">Corvette</option>
      <option value="Dacia">Dacia</option>
      <option value="Daewoo">Daewoo</option>
      <option value="Daihatsu">Daihatsu</option>
      <option value="Dodge">Dodge</option>
      <option value="Ferrari">Ferrari</option>
      <option value="Fiat">Fiat</option>
      <option value="Ford">Ford</option>
      <option value="Honda">Honda</option>
      <option value="Hyundai">Hyundai</option>
      <option value="Isuzu">Isuzu</option>
      <option value="Iveco">Iveco</option>
      <option value="Jaguar">Jaguar</option>
      <option value="Jeep">Jeep</option>
      <option value="Kia">Kia</option>
      <option value="Lamborghini">Lamborghini</option>
      <option value="Lancia">Lancia</option>
      <option value="Land Rover">Land Rover</option>
      <option value="Lexus">Lexus</option>
      <option value="Lotus">Lotus</option>
      <option value="Maserati">Maserati</option>
      <option value="Mazda">Mazda</option>
      <option value="Mercedes">Mercedes</option>
      <option value="MG">MG</option>
      <option value="Mini">Mini</option>
      <option value="Mitsubishi">Mitsubishi</option>
      <option value="Nissan">Nissan</option>
      <option value="Opel">Opel</option>
      <option value="Peugeot">Peugeot</option>
      <option value="Pontiac">Pontiac</option>
      <option value="Porsche">Porsche</option>
      <option value="Renault">Renault</option>
      <option value="Rolls-Royce">Rolls-Royce</option>
      <option value="Rover">Rover</option>
      <option value="Saab">Saab</option>
      <option value="Seat">Seat</option>
      <option value="Skoda">Skoda</option>
      <option value="Smart">Smart</option>
      <option value="Subaru">Subaru</option>
      <option value="Suzuki">Suzuki</option>
      <option value="Tesla">Tesla</option>
      <option value="Toyota">Toyota</option>
      <option value="Volkswagen">Volkswagen</option>
      <option value="Volvo">Volvo</option>
    </select>
    <!-- USED ​​VEHICLES EXAMPLES -->
    <div class="card-container">

      <?php foreach ($cars as $key => $car) {
        include('templates/car_partial.php');
      } ?>
      <!-- MAIN END -->
      <!-- BUTTON BACK TO TOP -->
      <div class="back-to-top">
        <a href="cars.php">
          <button class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
            </svg>
          </button>
        </a>
      </div>

      <!-- FOOTER START -->
      <?php
      require_once('templates/footer.php');
      // FOOTER END
      //  IMPORT SCRIPTS 
      require_once('lib/scripts.php');
      ?>
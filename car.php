<?php
require_once('lib/car_tools.php');
require_once('templates/header.php');


$id = $_GET['id'];
// VOIR CE QUE RECUPERE GET
// var_dump($cars[$id]);
?>


<!-- MAIN START -->
<!--Content cards service cars-->
<!-- USED ​​VEHICLES EXAMPLES -->
<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fw-bold lh-1"><?= $cars[$id]['title']; ?></h1>
            <p class="lead"><?= $cars[$id]['description']; ?></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Contactez-nous</button>

            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
            <img class="rounded-lg-3" src="<?= _CARS_IMG_PATH_ . $cars[$id]['image']; ?>" alt="" width="450">
            <br>
            <img class="rounded-lg-3" src="uploads\cars\ferrari-2468015_1280.jpg" alt="" width="450">
            <br>
            <img class="rounded-lg-3" src="uploads\cars\ferrari-2468015_1280.jpg" alt="" width="450">
        </div>
    </div>
</div>
<!-- MAIN END -->

<!-- FOOTER START -->
<?php
require_once('templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
require_once('lib/scripts.php');
?>
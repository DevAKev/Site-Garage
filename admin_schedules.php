<?php
// HEADER START 
require_once('admin/templates/header.php');
?>
<!-- HEADER END -->

<body class="container">

    <!-- MAIN START -->
    <main class="">
        <div>
            <h1 class="text-center">Gestion des horaires</h1>
        </div>
        <div class="row">
            <div class="mt-5">
                <?php
                include('templates/schedules_form.php');
                ?>
            </div>
        </div>

    </main>
    <!-- MAIN END -->
    <!-- FOOTER START -->
    <?php
    require_once('admin/templates/footer.php');
    ?>
    <!-- FOOTER END -->

</body>
<?php
require_once('lib/scripts.php');
?>

</html>
<?php
// HEADER START 
require_once __DIR__ . ('/lib/session.php');
adminOnly();
require_once __DIR__ . ('/admin/templates/header.php');
?>
<!-- HEADER END -->

<body class="container">

    <!-- MAIN START -->
    <main class="">
        <div>
            <h1 class="display-5 fw-bold text-body-emphasis">Gestion des horaires</h1>
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
<script src="assets/js/schedules.js"></script>

</html>
<?php
// HEADER START 
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/schedules_tools.php";
adminOnly();
require_once __DIR__ . '/header.php';

// FETCH SCHEDULES FROM DB
$schedules = getSchedules($pdo);

// MANAGING SCHEDULES CONFIG
include_once __DIR__ . "/../../lib/schedules_conf.php";
?>
<!-- HEADER END -->

<body class="container">

    <!-- MAIN START -->
    <main>
        <div>
            <h1 class="display-5 fw-bold text-body-emphasis">Gestion des horaires</h1>
        </div>
        <div class="row">
            <div class="mt-5">
                <!-- SCHEDULES FORM -->
                <?php require_once __DIR__ . '/schedules_form.php'; ?>
    </main>
    <!-- MAIN END -->

    <!-- FOOTER START -->
    <?php
    require_once __DIR__ . '/footer.php';
    ?>
    <!-- FOOTER END -->

</body>

</html>
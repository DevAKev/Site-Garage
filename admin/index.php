            <?php
            require_once __DIR__ . "/../lib/session.php";
            adminOnly();

            require_once __DIR__ . ('/templates/header.php');
            ?>
            <div id="admin-image" class="container-fluid">
                <div id="containerMembre" class="container">
                    <h1> Bienvenue <?= isset($_SESSION["user"]["prenom"]) ? $_SESSION["user"]["prenom"] . ' ' . $_SESSION["user"]["nom"] : ''; ?></span> !</h1>
                </div>
            </div>
            </div>

            <?php
            require_once __DIR__ . ('/templates/footer.php');
            ?>
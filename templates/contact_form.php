<form id="contact-form" method="post" action="" novalidate>
    <div class="messages"></div>
    <div class="controls">
        <div class="row">
            <!-- Champ "objet" pré-rempli depuis l'URL -->
            <p class="text-muted">* Ces champs sont obligatoires.</p>
            <div class="form-group">
                <label for="form_subject">Objet *</label>
                <input id="form_subject" type="text" name="subject" class="form-control" placeholder="Entrez l'objet de votre message" value="<?= isset($_GET['objet']) ? htmlspecialchars($_GET['objet'], ENT_QUOTES, 'UTF-8') : ''; ?>" required="required" data-error="Veuillez entrer l'objet de votre message.">
                <div class="help-block with-errors"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input id="form_name" type="text" name="nom" class="form-control" placeholder="Entrez votre nom" required="required" data-error="Votre nom est requis." value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input id="form_prenom" type="text" name="prenom" class="form-control" placeholder="Entrez votre prénom" value="<?= isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone_number">Numéro *</label>
                <input id="form_number" type="number" name="phone_number" class="form-control" placeholder="Entrez votre numéro" required="required" data-error="Veuillez entrer un numéro de téléphone valide." value="<?= isset($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">Email *</label>
            <input id="form_email" type="email" name="email" class="form-control" placeholder="Entrez votre email" required="required" data-error="Veuillez entrer une adresse email valide." value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : ''; ?>">
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="form_message" name="message" class="form-control" placeholder="Entrez votre message" rows="4" cols="50" required="required" data-error="Veuillez entrer un message."><?= isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Envoyer
        </button>
    </div>
    </div>
</form>
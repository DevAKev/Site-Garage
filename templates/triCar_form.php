<form id="triForm">
    <label for="sortBy">Trier par :</label>
    <select id="sortBy" name="sortBy">
        <option value="recentes" <?= $tri === "recentes" ? "selected" : "" ?>>Plus récentes (Date de Publication)</option>
        <option value="anciennes" <?= $tri === "anciennes" ? "selected" : "" ?>>Plus anciennes (Date de Publication)</option>
        <option value="prix-croissant" <?= $tri === "prix-croissant" ? "selected" : "" ?>>Prix croissant</option>
        <option value="prix-decroissant" <?= $tri === "prix-decroissant" ? "selected" : "" ?>>Prix décroissant</option>
        <option value="kilometrage-croissant" <?= $tri === "kilometrage-croissant" ? "selected" : "" ?>>Kilométrage croissant</option>
        <option value="kilometrage-decroissant" <?= $tri === "kilometrage-decroissant" ? "selected" : "" ?>>Kilométrage décroissant</option>
        <option value="annee-mise-en-circulation-asc" <?= $tri === "annee-mise-en-circulation-asc" ? "selected" : "" ?>>Année de mise en circulation (Croissant)</option>
        <option value="annee-mise-en-circulation-desc" <?= $tri === "annee-mise-en-circulation-desc" ? "selected" : "" ?>>Année de mise en circulation (Décroissant)</option>
    </select>
</form>
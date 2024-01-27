<?php

function getServices(PDO $pdo, int $limit = null): array
{
    $sql = 'SELECT services.*, categorie.description as categorie_description
            FROM services
            LEFT JOIN categorie ON services.categorie_id = categorie.id
            ORDER BY RAND() DESC';
    if ($limit) {
        $sql .= ' LIMIT :limit';
    }
    $query = $pdo->prepare($sql);
    if ($limit) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }
    $query->execute();
    return $query->fetchAll();
}

function getServiceImage(?string $image): string
{
    if ($image === null) {
        return "assets/images/default_service_image.jpg";
    } else {
        return "assets/images/" . htmlspecialchars($image);
    }
}

function getTotalService(PDO $pdo): int
{
    $sql = "SELECT COUNT(*) as total FROM services;";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

function updateService(PDO $pdo): bool
{
    $sql = "UPDATE services SET titre = :titre, description = :description, image = :image, lien_page = :lien_page, mouvement = :mouvement WHERE id = :id";

    $query = $pdo->prepare($sql);

    $query->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    $query->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
    $query->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
    $query->bindValue(':image', $_POST['image'], PDO::PARAM_STR);
    $query->bindValue(':lien_page', $_POST['lien_page'], PDO::PARAM_STR);
    $query->bindValue(':mouvement', $_POST['mouvement'], PDO::PARAM_STR);

    return $query->execute();
}

function deleteService(PDO $pdo, int $id): bool
{
    $sql = "DELETE FROM services WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    return $query->execute();
}

function getServiceById(PDO $pdo, int $id): ?array
{
    $sql = "SELECT * FROM services WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $service = $query->fetch(PDO::FETCH_ASSOC);
    return $service ?: null;
}

function saveService(PDO $pdo, string $titre, string $description, string $image, int $categorie_id, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO services (titre, description, image, categorie_id) "
            . "VALUES(:titre, :description, :image, :categorie_id)");
    } else {
        $query = $pdo->prepare("UPDATE `services` SET `titre` = :titre, "
            . "`description` = :description, "
            . "image = :image, categorie_id = :categorie_id WHERE `id` = :id;");

        $query->bindValue(':id', $id, PDO::PARAM_INT);
    }

    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    $query->bindValue(':categorie_id', $categorie_id, PDO::PARAM_INT);
    return $query->execute();
}

function getCategories($pdo)
{
    $sql = 'SELECT * FROM categorie';
    $query = $pdo->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}

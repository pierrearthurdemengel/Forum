<h1>Liste des catégories</h1>

<?php
// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'topics' est extraite de ce tableau à travers $result["data"]['topics'] et assignée à une variable $topics.
if (isset($result["data"]['category'])) {
    $categorys = $result["data"]['category'];
}
?>

<h1>liste des catégories</h1>

<?php
if (isset($categorys)) {
    foreach ($categorys as $category) {

?>
        <div>
            <a href="index.php?ctrl=topic&action=listTopicByCategory&id=<?= $category->getId() ?>"><?= $category->getCategoryName() ?></a>
            <a><?= $category->getUser()->getPseudo() ?></a>
            <a><?= $category->getDateCreation() ?></a>
        </div>
<?php
    }
}
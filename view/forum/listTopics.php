<?php

$topics = (!$result['data']['topics']) ? [] : $result['data']['topics'];
$category = $result['data']['category'];
$categorySelected = null;

// catégorie
if (isset($result["data"]['categorySelected'])) {
    $categorySelected = $result["data"]['categorySelected'];
} else if (isset($id)) {
    $categorySelected = $id;
}

// utilisateur
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = null;
}

// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'categorys' est extraite de ce tableau à travers $result["data"]['categorys'] et assignée à une variable $categorys.

// Ensuite, le code affiche un titre <h1> "liste topics" et 
// utilise une boucle foreach pour parcourir chaque élément de la variable $topics. À chaque itération, le titre du sujet est récupéré à l'aide de la méthode getTitle() et affiché dans un paragraphe HTML <p>.
?>

<h1>Liste Topics</h1>
<?php

foreach ($topics as $topic) {
    // Vérifier si la catégorie sélectionnée est définie et si le sujet appartient à cette catégorie
    if (isset($categorySelected) && ($topic->getCategory() == false || $topic->getCategory()->getId() != $categorySelected)) {
        continue;
    }
    // Afficher le sujet
    ?>
    <div><br>
        <a href="index.php?ctrl=topic&action=listPosts&id=<?= $topic->getId() ?>"><?= $topic->getTopicName() ?></a>
        <p><?= $topic->getCreationDate() ?></p></br>
        <a><?= $topic->getUser()->getPseudo() ?></a></br>
        <a href="index.php?ctrl=topic&action=delAllPostAndTopic&id=<?= $topic->getId() ?>"> X </a></br>
        <br>
    </div>
    <?php } ?>


<!-- formulaire topic + 1er message du nouveau sujet -->

<form action="index.php?ctrl=topic&action=addTopic&id=<?= $categorySelected ?>" class="reply" method="post">
    <div>
        <label for="addTopic">Titre du nouveau topic : </label>
        <input type="text" name="addTopic"></br>
    </div>
    <div>
            <label for="addPost">Message: </label>
            <textarea name="addPost" rows= "3"></textarea>
        </div>
    <div>
        <input type="submit" name="submit" value="Ajouter"></br>
    </div>
</form>
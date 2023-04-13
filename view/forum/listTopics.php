
<?php

$topics = (!$result['data']['topics']) ? [] : $result['data']['topics'];
$category = $result['data']['category'];

// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'categorys' est extraite de ce tableau à travers $result["data"]['categorys'] et assignée à une variable $categorys.

// Ensuite, le code affiche un titre <h1> "liste topics" et 
// utilise une boucle foreach pour parcourir chaque élément de la variable $topics. À chaque itération, le titre du sujet est récupéré à l'aide de la méthode getTitle() et affiché dans un paragraphe HTML <p>.
?>


<?php

    foreach ($topics as $topic) {
?>

        <div><br>
            <a href="index.php?ctrl=topic&action=listPosts&id=<?= $topic->getId() ?>"><?= $topic->getTopicName() ?></a>
            <p><?= $topic->getCreationDate() ?></p>
            <a><?= $topic->getUser()->getPseudo() ?></a>
            <a href="index.php?ctrl=topic&action=delAllPostAndTopic&id=<?= $topic->getId() ?>"> X </a>
        <br>
        </div>

<?php } ?>
    <!-- formulaire topic + 1er message du nouveau sujet -->

        <form action="index.php?ctrl=topic&action=addTopic&id=<?= $category->getId() ?>" class="reply" method="post">
        <div>
            <label for="addTopic">Titre: </label>
            <input type="text" name="addTopic">
        </div>
    <!--    <div>
            <label for="text">Message: </label>
            <textarea name="text" rows= "3"></textarea>
        </div> -->
        <div>
            <input type="submit" name="submit" value="Ajouter">
        </div>
    </form>

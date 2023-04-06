<?php
$category = $result['data']['category'];
// var_dump($categorys); die;
$topics = $result['data']['topics'];

// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'categorys' est extraite de ce tableau à travers $result["data"]['categorys'] et assignée à une variable $categorys.
if (isset($result["data"]['category'])) {
    $topics = $result["data"]['topics'];
    $category = $result["data"]['category'];

}

// Ensuite, le code affiche un titre <h1> "liste topics" et 
// utilise une boucle foreach pour parcourir chaque élément de la variable $topics. À chaque itération, le titre du sujet est récupéré à l'aide de la méthode getTitle() et affiché dans un paragraphe HTML <p>.
?>

<h1>Liste des topics de la catégorie : <?= isset($category) ? $category->getCategoryName() : "" ?></h1>

<?php
if (isset($topics)) {
    foreach ($topics as $topic) {
?>

        <div>
            <a href="index.php?ctrl=topic&action=infoTopic&id=<?= $topic->getId() ?>"><?= $topic->getTopicName() ?></a>
            <p><?= $topic->getCreationDate() ?></p>
            <a><?= $topic->getUser()->getPseudo() ?></a>
            <a><?= $topic->getCategory()->getCategoryName() ?></a>
        </div>

<?php }} ?>

        <form action="index.php?ctrl=forum&action=addTopic&id=<?= isset($category) ? $category->getId() : "" ?>" method="POST">
            <label for="newTopic">Nouveau Topic</label>
            <input type="submit" name="submit" placeholder="Topic" required >

			<label for="postName">Nouveau Post</label>
			<textarea id="title" name="title" placeholder="Post" > </textarea>
			<input type="submit" name="submit" value="Ajouter" />

        </form>

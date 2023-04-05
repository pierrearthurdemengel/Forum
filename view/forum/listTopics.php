<?php
// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'topics' est extraite de ce tableau à travers $result["data"]['topics'] et assignée à une variable $topics.
if (isset($result["data"]['topics'])) {
    $topics = $result["data"]['topics'];
}

// Ensuite, le code affiche un titre <h1> "liste topics" et 
// utilise une boucle foreach pour parcourir chaque élément de la variable $topics. À chaque itération, le titre du sujet est récupéré à l'aide de la méthode getTitle() et affiché dans un paragraphe HTML <p>.
?>

<h1>liste topics de <?= $category->getCategoryName() ?></h1>
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

        <form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId() ?>" method="POST">
            <label for="newTopic">Nouveau Topic</label>
            <input trype="submit" name="submit" placeholder="Topic" required >

			<label for="postName">Nouveau Post</label>
			<textarea id="title" name="title" placeholder="Post" > </textarea>
			<input type="submit" name="submit" value="Ajouter" />

        </form>

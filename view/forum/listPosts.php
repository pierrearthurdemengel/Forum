<a href="index.php?ctrl=topic&action=infoTopic&id=<?= $post->getId() ?>"><?= $post->getTopicName() ?></a>
<?php
// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'posts' est extraite de ce tableau à travers $result["data"]['posts'] et assignée à une variable $posts.

if (isset($result["data"]['posts'])) {
    $posts = $result["data"]['posts'];
}

?>

<h1>liste des postes</h1>
<?php
if (isset($posts)) {
    foreach ($posts as $post) {

?>
        <div>
            <p><?= $post->getTitle() ?></p>
            <p><?= $post->getText() ?></p>
            <p><?= $post->getDatePost() ?></p>
            <a><?= $post->getUser()->getPseudo() ?></a>
            <a><?= $post->getTopic() ?></a>
            <a><?= $post->getCategory()->getCategoryName() ?></a>
        </div>
<?php
    }
}
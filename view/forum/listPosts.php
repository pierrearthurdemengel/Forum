<a href="index.php?ctrl=topic&action=infoTopic&id=<?= $post->getId() ?>"><?= $post->getTopicName() ?></a>
<?php
// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'posts' est extraite de ce tableau à travers $result["data"]['posts'] et assignée à une variable $posts.
$topic = $result["data"]["topic"];
$posts = $result["data"]['posts'];


if (isset($result["data"]['posts'])) {
    $posts = $result["data"]['posts'];
}

?>

<h1> Liste des postes de <?=$topic->getTitle()?> </h1>
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
<?php }} ?>

<p>Ajouter un nouveau Post"<?=$topic->getTitle()?>"</p>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST">
<textarea id="text" name="text" placeholder="text" required rows="5" cols="33"> </textarea>
    <input type="submit" name="submit" value="Ajouter"/>
</form>

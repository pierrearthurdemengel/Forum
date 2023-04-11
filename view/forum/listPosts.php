<?php
if (isset($result["data"]['topic'])) {
    $topic = $result["data"]['topic'];
}
// var_dump($result["data"]['posts']); die;
if (isset($result["data"]['post'])) {
    $post = $result["data"]['post'];
}

?>

<h1>Info Topic</h1>


<div>
    <a><?= $topic->getId() ?></a>
    <a><?= $topic->getTopicName() ?></a>
    <a><?= $topic->getCreationDate() ?></a>
    <a><?= $topic->getClosed() ?></a>
    <a><?= "créé par " . $topic->getUser()->getPseudo() ?></a>
    <a><?= $topic->getCategory()->getCategoryName() ?></a>
</div>
<span>
    <?php
    foreach ($post as $post) { ?>

        <a><?= $post->getId() ?></a>
        <a><?= $post->getText() ?></a>
        <a><?= $post->getDatePost() ?></a>
        <a><?= "créé par " . $post->getUser()->getPseudo() ?></a>
        <a><?= $topic->getTopicName() ?></a>

    <?php } ?>

    <form action='index.php?ctrl=post&action=addPost&id=<?= $topic->getId() ?>' method='POST'>
        <textarea id="text" name="text" placeholder="text"> </textarea>
        <input type="submit" name="submit" value="Ajouter" />
    </form>

</span>
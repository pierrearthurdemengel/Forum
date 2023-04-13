<?php
$test = [];
if (isset($result["data"]['topic'])) {
    $topic = $result["data"]['topic'];
}
// var_dump($result["data"]['posts']); die;
if (isset($result["data"]['post'])) {
    $posts = $result["data"]['post'];
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
    foreach ($posts as $post) { 

$test[] = $post;?>

        <a><?= $post->getId() ?></a>
        <a><?= $post->getText() ?></a>
        <a><?= $post->getDatePost() ?></a>
        <a><?= "créé par " . $post->getUser()->getPseudo() ?></a>
        <a><?= $topic->getTopicName() ?></a>
        <a href="index.php?ctrl=post&action=delPostById&id=<?= $post->getId() ?>"> X </a>
        <br>
    <?php } ?>

    <form action='index.php?ctrl=post&action=addPost&id=<?= $topic->getId() ?>' method='POST'>
        <textarea id="text" name="text" placeholder="text"> </textarea>
        <input type="submit" name="submit" value="Ajouter" />
    </form>

                <!-- formulaire delPost -->
                <form action="index.php?ctrl=post&action=delPost&id=<?= $topic->getId() ?>" class="reply" method="post">
            <div>
                <label for="text">Supprimer un poste :</label> 
                <select name="delPost" required id="id_post">
                    <?php

                    foreach ( $test as $post) {
                        echo "<option value='" . $post->getId() . "'>" . $post->getText() . "</option>";
                     }
                    ?>

            <div>
                <input type="submit" name="submit" value="Supprimer">
            </div>
        </form>

</span>
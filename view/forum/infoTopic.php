<?php


if (isset($result["data"]['topic'])) {
    $topic = $result["data"]['topic'];
}
// var_dump($result["data"]['posts']); die;
if (isset($result["data"]['posts'])) {
    $posts = $result["data"]['posts'];

}

?>

<h1>Info Topic</h1>

 
<div>
    <a><?=$topic->getId()?></a>
    <a><?=$topic->getTopicName()?></a>
    <a><?=$topic->getCreationDate()?></a>
    <a><?=$topic->getClosed()?></a>
    <a><?="créé par ".$topic->getUser()->getPseudo()?></a>
    <a><?=$topic->getCategory()->getCategoryName()?></a>
</div>
<span>
    <?php foreach($posts as $post) {?>

<a><?=$post->getId()?></a>

    <a><?=$post->getTitle()?></a> <!-- getTitle non récupéré !!!!! -->
    <a><?=$post->getText()?></a>
    <a><?=$post->getDatePost()?></a>
    <a><?="créé par ".$post->getUser()->getPseudo()?></a>
    <a><?=$topic->getTopicName()?></a>


    <?php } ?>
</span>




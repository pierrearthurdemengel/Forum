<?php
$topic = $result["data"]['topic'];
$posts = $result["data"]['post']
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
    <?php foreach($posts as $post){?>

    <a><?=$post->getId()?></a>
    <a><?=$post->getTitle()?></a>
    <a><?=$post->getText()?></a>
    <a><?=$post->getDatePost()?></a>
    <a><?="créé par ".$post->getUser()->getPseudo()?></a>
    <a><?=$post->getTopic()->getTopicName()?></a>
    <a><?=$post->getCategory()->getCategoryName()?></a>

    <?php } ?>
</span>




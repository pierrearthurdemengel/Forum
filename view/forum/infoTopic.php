<?php
$topic = $result["data"]['topic'];
?>

<h1>Info Topic</h1>

 
<div>
    <a><?=$topic->getId()?></a>
    <a><?=$topic->getTopicName()?></a>
    <a><?=$topic->getCreationDate()?></a>
    <a><?=$topic->getClosed()?></a>
    <a><?=$topic->getUser()->getPseudo()?></a>
    <a><?=$topic->getCategory()->getCategoryName()?></a>
</div>




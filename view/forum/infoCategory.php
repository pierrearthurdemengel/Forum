<?php

use Model\Entities\Category;

$category = $result["data"]['category'];
?>

<h1>Info catégories</h1>

 
<div>
    <a><?= $category->getId() ?></a>
    <a><?= $category->getCategoryName() ?></a>
    <a><?= $category->getDateCreation() ?></a>
    <a><?= $category->getUser()->getPseudo() ?></a>
    <?php foreach($category as $category): ?>
        <a><?= $category->getTopic()->getTopicName() ?></a>
    <?php endforeach; ?>
</div>





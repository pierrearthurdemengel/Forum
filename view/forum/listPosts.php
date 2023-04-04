<?php
// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'topics' est extraite de ce tableau à travers $result["data"]['topics'] et assignée à une variable $topics.
if(isset($result["data"]['posts']))
{
    $posts = $result["data"]['posts'];
    var_dump("test"); die;
}

// Ensuite, le code affiche un titre <h1> "liste topics" et 
// utilise une boucle foreach pour parcourir chaque élément de la variable $topics. À chaque itération, le titre du sujet est récupéré à l'aide de la méthode getTitle() et affiché dans un paragraphe HTML <p>.
?>

<h1>liste des postes</h1>
<?php
if(isset($posts)){
foreach($posts as $post ){
    
    ?>
    <div> 
        <a href="index.php?ctrl=topic&action=infoTopic&id=<?=$post->getId()?>"><?=$post->getTopicName()?></a>
        <p><?=$post->getTitle()?></p>
        <p><?=$post->getText()?></p>
        <p><?=$post->getDatePost()?></p>
        <a><?=$post->getUser()->getPseudo()?></a>
        <p><?=$post->getTopic()?></p>
        <a><?=$post->getCategory()->getCategoryName()?></a>
    </div>
    <?php
}}


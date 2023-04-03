<?php
// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'topics' est extraite de ce tableau à travers $result["data"]['topics'] et assignée à une variable $topics.
$topics = $result["data"]['topics'];

// Ensuite, le code affiche un titre <h1> "liste topics" et 
// utilise une boucle foreach pour parcourir chaque élément de la variable $topics. À chaque itération, le titre du sujet est récupéré à l'aide de la méthode getTitle() et affiché dans un paragraphe HTML <p>.
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><?=$topic->getTitle()?></p>
    <?php
}


  

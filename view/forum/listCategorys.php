
<?php


// récupère les données envoyées par le contrôleur à travers la variable $result et la clé data, qui contient un tableau associatif de données. La clé 'topics' est extraite de ce tableau à travers $result["data"]['topics'] et assignée à une variable $topics.

    $categorys = $result["data"]['categorys'];
    $test = [];
?>

<h1>liste des catégories</h1>

<?php
if (isset($categorys)) {
    foreach ($categorys as $category) {
        $test[] = $category;

?>
        <div>
            <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getCategoryName() ?></a>
        </div>
<?php }}
?>


    <!-- formulaire addCategory -->
    <form action="index.php?ctrl=category&action=addCategory" class="reply" method="post">
            <div>
                <label for="nomCategorie">Ajouter une catégorie:</label> 
                <input name="addCategory" required>
            </div>
            <div>
                <input type="submit" name="submit" value="Ajouter">
            </div>
        </form>

            <!-- formulaire delCategory -->
    <form action="index.php?ctrl=category&action=delCategory" class="reply" method="post">
            <div>
                <label for="categoryName">Supprimer une catégorie:</label> 
                <select name="delCategory" required id="id_category">
                    <?php

                    foreach ( $test as $category) {
                        echo "<option value='" . $category->getId() . "'>" . $category->getCategoryName() . "</option>";
                     }
                    ?>

            <div>
                <input type="submit" name="submit" value="Supprimer">
            </div>
        </form>

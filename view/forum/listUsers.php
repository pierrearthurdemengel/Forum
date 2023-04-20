
<?php

    $users = $result["data"]['users'];
?>

<h1>liste de la mort qui tue - ban</h1></br>

<?php
if (isset($users)) {
    foreach ($users as $user) {


?>
        <div>
            <a href="index.php?ctrl=user&action=listUsers"><?= $user->getPseudo() ?></a></br>
            <a href="index.php?ctrl=user&action=ban&id=<?= $user->getId() ?>"> Kill - Ban </a><br>
        </div>
<?php }} ?>
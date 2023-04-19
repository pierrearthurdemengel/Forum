<?php

$user = $result["data"]['user'];
if(App\Session::getFlash("modifyRequest")){
    $wantToModifyPassWord = true;
} else {
    $wantToModifyPassWord = null;
}

?>

<h1>Bienvenu(e) <?=$user->getPseudo() ?></h1>

<div id="forumList">
    <ul>
        <li><a href="index.php?ctrl=security&action=modifyPassword&id=<?=$user->getId()?>">Modifier votre mot de passe</a></li>
        <?php 
        if($wantToModifyPassWord){
        ?>
        <form action="index.php?ctrl=security&action=modifyPassword&id=<?=$user->getId()?>" method="post">
            <div>
                <label for="password">Mot de passe actuelle</label>
                <input type="password" name="password">
            </div>
            <div>
                <label for="newPassword1">Nouveau mot de passe</label>
                <input type="password" name="newPassword1">
            </div>            
            <div>
                <label for="newPassword2">Confirmez le Nouveau mot de passe</label>
                <input type="password" name="newPassword2">
            </div>
            <div>
                <input type="submit" name="submit" value="Modifier Mot de passe">
            </div>
        </form>
        <?php
        }
        if($user->getBan() == 1) {
        ?>
        <li><a href="index.php?ctrl=user&action=demandeDeBan">Faire une demande de déBan</a></li>
        <?php
        }
        ?>
    </ul>
</div>
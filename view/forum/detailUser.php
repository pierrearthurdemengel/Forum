<?php

$user = $result["data"]['user'];
if(isset($result["data"]['posts'])) {
    $posts = $result["data"]['posts'];
} else {
    $posts = null;
}
    
?>
<?php if (is_object($user)): ?>
<h1>Info sur <?=$user->getPseudo() ?></h1>
<?php endif; ?>


<div style="width: 66%">
    <h2 style="text-align:center;">Dernier Message</h2>
    <div>
        <?php 
        if ($posts) {
            // liste desderniers posts de l'utilisateur
            foreach($posts as $post) {
            ?>
                <div class="message-box">
                    <div>
                        <a href="index.php?ctrl=topic&action=listPostsByTopic&id=<?= $post->getTopic()->getId() ?>"><?= $post->getTopic()->getTopicName() ?></a>                    
                    </div>
                    <div>
                        <p><?= $post->getText() ?></p>
                        <p class="creation-date"><?= $post->getDatePost() ?></p>    
                    </div>

                </div>

            <?php
            }
        } else {
            ?>
            <div class="message-box">
                <p>L'utilisateur n'a pas encore écrit de posts</p>
            </div>
        <?php
        }
        ?>
    </div>
</div>






  
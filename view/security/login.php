<h1>Se Connecter</h1>


<?php if (isset($_SESSION['email'])) {
    echo "Vous êtes connecté en tant que : " . $_SESSION['email'];
} else { ?> 


    <form action='index.php?ctrl=security&action=login' class="reply" method='post'>
        <div>
            <label for="email">Email</label>
            <input name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <input class="input-checkbox" id="ckb1" type="checkbox" name="remember-me">
            <label class="label-checkbox" for="ckb1">
                Remeber me
            </label>
        </div>
        <div>
            <input type="submit" name="submitLogin" value="Se Connecter">
        </div>
    </form>
<?php } ?>

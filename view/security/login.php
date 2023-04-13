<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
        <h1>Se Connecter</h1>
        
        <?php if(isset($_SESSION['email']))
        {
            echo "Vous êtes connecté en tant que : " . $_SESSION['email'];
        }
        else{?>
            <form action='index.php?ctrl=security&action=login&id=<?= $userId -> userId() ?>' class="reply" method='post'>           

                    <div><a>
            
                        <label for="email">Email</label> 
                        <input name="email" required>
                    </a>
                    </div>
                    <div><a>
            
                        <label for="password">Mot de passe</label> 
                        <input name="pass" required>
                    </a>
                    </div>
                    <div><a>
            
                    </a>
                        <input class="input-checkbox" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox" for="ckb1">
                            Remeber me
                        </label>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Ajouter">
                    </div>
                </form>
            
            
            
            
            
            
            </form>
            
            
            
            
            <h1>S'Inscrire</h1>

            <?php
        }

session_start();

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pseudo = $_POST['pseudo'];

    $db = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', '');

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $db->prepare($sql);
    $result->execute();

    if($result->rowCount() > 0)
    {
        $data = $result->fetchAll();
        if (password_verify($pass, $data[0]["password"]))
        {
            echo "Connection effectuée";
            $_SESSION['email'] = $email;
        }
    }
    else{
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (pseudo, email, password) VALUES ('$pseudo','$email', '$pass')";
        $req = $bd->prepare($sql);
        $req->execute();
        echo "Vous êtes bien inscrit chez nous. Bienvenu <3";

    }

}

?>
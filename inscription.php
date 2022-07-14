<!DOCTYPE html>

<?php

$bdd = new PDO('mysql:host=localhost;dbname=aventurecrafteuse', 'root', 'chcolat');

if(isset($_POST['formsend'])) {
    if(!empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['pseudo'])){
        echo "ok";
    } else{
        echo "non";
    }
}

?>




<head>
    <title>L'aventure Crafteuse - Inscription</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="icon" type="image/png" href="./css/img/AC_Serveur_Icone.png">
</head>
<body>
<h1>L'Aventure Crafteuse</h1>
<h2>Veuillez vous connecter pour acceder a notre site</h2>

<form method="post">

<input type="email" name="email" id="email" placeholder="Votre Email" required><br/>
<input type="text" name="pseudo" id="pseudo" placeholder="Votre Pseudo" required><br/>
<input type="password" name="password" id="password" placeholder="Votre Mot De Passe" required><br/>
<input type="password" name="cpassword" id="cpassword" placeholder="Confirmez Votre Mot De Passe"><br/><br/>
<a href="sitebase.php"><input type="submit" name="formsend" value="Créer un compte"></a>
</form>
<p>Vous avez déjà un compte? <a href="./connexion.php"><p>cliquez-ici</p></a></p>

<?php

    if(isset($_POST['formsend'])){

        extract($_POST);        

        if(!empty($password) && !empty($cpassword) && !empty($email) && !empty($pseudo)){
            

            if($password == $cpassword){

                $options = [
                    'cost' => 12,
                ];

                $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);


                $q = $bdd->prepare("INSERT INTO users(email,password) VALUES (:email,:password)");
                $q->execute([
                    'email' => $email,
                    'password' => $hashpass,
                    'pseudo' => $pseudo
                ]);

            } else{
                echo "Les mots de passe ne sont pas identiques";
            }
            
            // if(password_verify($password, $hashpass)){
            //     echo "meme";
            // }else{
            //     echo "pas meme";
            // }
        
        }

    }

    
?>


</body>

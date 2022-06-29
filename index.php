<?php
// Vérification que l'image à bien été envoyé
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    $error = 1; // Sera réécrit avec la valeur 0, si c'est un succès
    // Taille maximum de l'image
    if ($_FILES['image']['size'] <= 3000000) {
        // Extension
        $informationsImage =pathinfo($_FILES['image']['name']);
        $extensionImage = $informationsImage['extension'];
        $extensionsAuthorisees = ['jpg', 'jpeg', 'png', 'gif'];

        /* Vérification de l'extension de l'image utilisateur avec les extensions
         de $extensionsAuthorisees */
        if (in_array($extensionImage, $extensionsAuthorisees)) {
            /* Path du dossier où sont les images,
            ne pas oublier le '.' suivi de la variable qui va vérifier l'extension */
            $localisationDeImage = 'uploads/'.time().rand().rand().'.'.$extensionImage;
            move_uploaded_file($_FILES['image']['tmp_name'], $localisationDeImage);
            /* Permet de vérifier depuis le HTML si l'image a bien été envoyé et que
            la taille ne dépasse pas la limite fixée */
            $error = 0;
        }
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hébergeur d'images</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Bienvenue au Mossad</h1>
    </header>

<!--    FORMULAIRE-->
        <div class="container">
            <article>
                <h2>Stocker vos images en toute simplicité</h2>
                <?php
                    if (isset($error) && $error == 0) {
                        echo '<div id="presentation-image">
                                    <img src="' .$localisationDeImage. '"alt="images diverses et variées" id="taille-image" />
                                </div>';
                        echo '<div class="url-image">
                                    <a target="_blank" href="http://localhost/projet-udemy/hebergeur_images/'.$localisationDeImage.'" >http://localhost/'.$localisationDeImage.'</a>
                                </div>';
                    } else if (isset($error) && $error == 1) {
                        echo '<div class="message-erreur">
                                    <p>L\'image ne peux pas être envoyée !</p>
                                    <p> Vérifier son extension et sa taille (maximum de 3 Mo)</p>
                                </div>';
                    }
                ?>
                <form method="post" action="index.php" enctype="multipart/form-data">
                    <div class="container-input">
                        <input type="file" name="image" required>
                        <br>
                        <button type="submit">Héberger </button>
                    </div>
                </form>
            </article>
        </div>
</body>
</html>





































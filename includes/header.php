<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlentities($title) ? $title : "HomePage du site" ?></title>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/styles.css">
    <script src="./assets/js/scripts.js" defer></script>
    <link rel="stylesheet" href="bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery bien ajouté -->
    <link rel="shortcut icon" href="assets/images/fad/fad-logo.jpg" type="image/x-icon">

</head>
<body>
    <header class="bg-light">

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid px-4 px-lg-5">
                <a class="navbar-brand" href="index.php?page=home"><img src="assets/images/fad/fad-card.webp" alt="logo" srcset="" style="width:60px">&nbsp; GreenFad Airlines</a>
                <style>
                    /* media queries */
                    @media screen and (max-width: 768px) {
                        a.navbar-brand {
                            font-size: 16px;
                        }
                        a.navbar-brand img {
                            width: 60px !important;
                        }
                    }
                </style>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <?= nav_item("home", "Acceuil") ?>
                        <?= nav_item("billet", "Billets") ?>
                        <?php nav_item("reserve", "Réservation") ?>
                        <?= nav_item("about", "A Propos") ?>

                        
                        <?php if(isset($_SESSION['user_id'])): ?>
                            
                            <?php if (!empty($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1):  ?>
                                <?= nav_item("add_billet", "Départ") ?>
                                <?= nav_item("dashboard", "Dashboard") ?>
                            <?php endif; ?>

                            <!-- Affichage du panier -->
                            <?php if (isset($_SESSION["panier"])):  ?>
                                <?= nav_item("cart", "Panier") ?>
                            <?php endif; ?>
                                                        
                            <?= nav_item("logout", "Se deconnecter") ?>
                        
                        <?php else: ?>
                            <?= nav_item("login", "Se connecter") ?>
                        <?php endif; ?>
                    </ul>

                    
                </div>
            </div>
        </nav>

        
    </header>


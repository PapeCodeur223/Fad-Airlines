<?php 
link_css("./assets/css/style.css");
link_css("./assets/css/about.css");

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données
    $nom = trim($_POST["name"]);
    $telephone = trim($_POST["phone_number"]);
    $email = trim($_POST["email"]);
    $sujet = trim($_POST["sujet"]);
    $commentaire = trim($_POST["comment"]);

    $errors = [];

    // Validation du nom (lettres et espaces uniquement)
    if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/", $nom)) {
        $errors[] = "Le nom ne doit contenir que des lettres et des espaces.";
    }

    // Validation du numéro de téléphone (exactement 8 chiffres)
    if (!preg_match("/^\d{8}$/", $telephone)) {
        $errors[] = "Le numéro de téléphone doit contenir exactement 8 chiffres.";
    }

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }

    // Vérification des champs sujet et commentaire
    if (empty($sujet)) {
        $errors[] = "Le sujet ne peut pas être vide.";
    }

    if (empty($commentaire)) {
        $errors[] = "Le commentaire ne peut pas être vide.";
    }

    // Affichage des erreurs ou traitement
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        // Ici, vous pouvez enregistrer les données dans une base de données ou envoyer un email
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (nom, telephone, email, sujet, commentaire) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $telephone, $email, $sujet, $commentaire]);
            echo "<div class='alert alert-success'>Formulaire envoyé avec succès !</div>";
        } 
        catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Erreur lors de l'enregistrement : " . $e->getMessage() . "</div>";
        }
        
    }
}

?>

<div class="container-fluid px-0">
    <!-- Section Hero -->
    <header class="bg-dark py-5 px-0 br-0" id="hero">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Green Fad</h1>
                <p class="lead fw-normal text-white-50 mb-0">Des destinations de rêve aux meilleurs prix !</p>
            </div>
        </div>
    </header>
</div>

<!-- Section -->
<section>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 d-flex justify-content-center align-items-center">
            <div class="col-sm-6 greenfad my-4">
                <h2 class="display-4 fw-bold">Green Fad</h2>
                <p class="lead">Nous sommes une entreprise de transportation et de voyage qui vise à proposer des services de voyageurs en plein air à des tarifs abordables et attractifs.</p>
                <p class="lead">Nous sommes passionnés par la création d'impact durable pour votre entreprise à travers des solutions numériques et marketing innovantes.</p>
                <p class="lead">Chez GreenFad, nous croyons en l’innovation continue et en l’excellence dans tout ce que nous entreprenons. Nous nous efforçons de devenir le partenaire privilégié de nos clients en leur fournissant non seulement des solutions créatives, mais aussi une valeur durable à long terme.</p>
                <a href="#" class="btn btn-primary w-100">En savoir plus</a>
    
            </div>
            <div class="col-sm-6">
                <img src="assets/images/fad/fad-card.webp" alt="About" class="img-fluid">
            </div>
        </div>

    </div>
</section>

<!-- Services de green fad -->
<section>
    <div class="container py-4">
        <div class="row py-5">
            <!-- CARD -->
            <div class="col-sm-4 mb-3">
                <div class="card product-card fad-card">
                    <div class="card-body p-5">
                        <h4 class="card-title fw-bold"><i class="fa-solid fa-laptop-code icons"></i> Web Development</h4>
                        <p class="card-text">Chez GreenFad, nous proposons des services complets de développement Web conçu pour aider votre entreprise à avoir un impact durable en ligne.</p>
                        <p class="card-text"><i class="fa-solid fa-circle-check"></i> Développement de sites Web personnalisés</p>
                        <p class="card-text"><i class="fa-solid fa-circle-check"></i> Site Web adaptatif</p>
                        <p class="card-text"><i class="fa-solid fa-circle-check"></i> E-commerce Development</p>

                        <a href="#" class="btn btn-primary w-100">En savoir plus</a>
                    </div>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="col-sm-4 mb-3">
                <div class="card product-card fad-card">
                    <div class="card-body p-5">
                        <h4 class="card-title fw-bold"><i class="fa-brands fa-android icons"></i> Development App</h4>
                        <p class="card-text">Développement d’applications Web dynamiques adaptées à vos opérations commerciales Intégration aux systèmes existants.</p>
                        <p class="card-text"><i class="fa-solid fa-circle-check"></i> Rationaliser les flux de travail</p>
                        <p class="card-text"><i class="fa-solid fa-circle-check"></i> Intégration avec les systèmes existants</p>
                        <p class="card-text"><i class="fa-solid fa-circle-check"></i> Construit avec les dernières technologies</p>

                        <a href="#" class="btn btn-primary w-100">En savoir plus</a>
                    </div>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="col-sm-4 mb-3">
                <div class="card product-card fad-card">
                    <div class="card-body p-5">
                        <h4 class="card-title fw-bold"><i class="fa-brands fa-telegram icons"></i> SEO Naturel</h4>
                        <p class="card-text">SEO sur page et technique pour améliorer le classement des moteurs de recherche Sites Web à chargement rapide qui améliore l’expérience utilisateur. performances d’optimisation</p>
                        <p class="card-text"><i class="fa-solid fa-circle-check"></i> SEO on-page et technique</p>
                        <p class="card-text"><i class="fa-solid fa-circle-check"></i> Améliorer le classement des moteurs de recherche</p>
                        <p class="card-text"><i class="fa-solid fa-circle-check"></i> Améliorer l'expérience utilisateur</p>

                        <a href="#" class="btn btn-primary w-100">En savoir plus</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
   
</section>


<!-- Section Fad -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-3 product-card" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="assets/images/fad/green.jpg.webp" class="img-fluid rounded-start w-100" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title green_fad">Notre Mission</h5>
                                <p class="card-text">Notre mission est d’accompagner les entreprises dans leur transformation digitale et leur expansion grâce à des solutions web et marketing.</p>
                                <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dexième card -->
            <div class="col-sm-6">
                <div class="card mb-3 product-card" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title green_fad">Notre Objectif</h5>
                                <p class="card-text">Nous concevons des sites web sur mesure et des applications dynamiques qui captivent vos utilisateurs et optimisent vos opérations.</p>
                                <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="assets/images/fad/greenfad-1.webp" class="img-fluid rounded-start w-100 h-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- Contactez-nous -->
<section>
    <div class="container py-4">
        <div class="row contact my-3">
            <div class="col-sm-12 p-5">
                <h4 class="fw-bold green_fad display-5 text-center">Vous avez des questions ou souhaitez discuter de votre projet avec nous ?</h4>
                <p class="lead text-center">Pour toute question ou demande d'information, veuillez nous contacter à l'adresse suivante:</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 p-0 text-center">
                <address class="adress p-4 green_contact text-white">
                    <strong>Adresse</strong><br>
                    Magnabougou/Faso Kanu, r37,porte 481BPE3910<br>
                </address>
            </div>
            <div class="col-sm-4 p-0 text-center">
                <address class="adress bg-white p-4 green_contact">
                    <strong>Téléphone</strong><br>
                    <abbr title="Phone">Tel</abbr> +223 7219 465 54 / +223 901 760 30
                    <br> +223 74 66 64 89
                </address>
            </div>
            <div class="col-sm-4 p-0 text-center">
                <address class="adress p-4 text-white">
                    <strong>Email</strong><br>
                    <abbr title="Email">Email:</abbr> contact@greenfad.tech / services@greenfad.tech
                </address>
            </div>
            
        </div>
    
    </div>
</section>

<!-- contact -->
<section class="mb-5">
    <div class="container">
        <div class="row py-5">
            <div class="col-sm-6 mb-5 formulaire">
                <h4 class="fw-bold green_fad display-5">Faites en sorte que votre Business Réussisse avec GreenFad</h4>
                <p class="lead">Chez GreenFad, notre mission est de transformer des idées innovantes en solutions pratiques qui favorisent le succès de l’entreprise. Nous nous efforçons de fournir des produits de haute qualité</p>
                <p class="lead">Maximisez votre visibilité en ligne grâce à notre expertise en SEO. Nous optimisons votre présence sur les moteurs de recherche pour attirer plus de visiteurs qualifiés et améliorer votre retour sur investissement.</p>

            </div>
            <div class="col-sm-6">
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group">
                        <label for="name">Nom *</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" class="form-control" name="phone_number" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="phone">Sujet</label>
                        <input type="text" class="form-control" name="sujet" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="phone">Commentaire</label>
                        <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
                    </div>
                    <bouton class="btn btn-primary my-2 w-100">Envoyer</bouton>
                </form>

            </div>
        </div>

    </div>
</section>
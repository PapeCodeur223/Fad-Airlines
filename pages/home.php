<?php 

    if (!isset($pdo)) {
        die("Erreur : connexion à la base de données non établie.");
    }

    $query = $pdo->query("SELECT * FROM billets");
    $billet = $query->fetchAll(PDO::FETCH_ASSOC);

    // inclusion du style css :
    link_css("./assets/css/style.css");
    link_css("./assets/css/home.css");


    
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
                <h1 class="display-4 fw-bolder">WECOME TO AIRLINES GREENFAD</h1>
                <p class="lead fw-normal text-white-50 mb-0">Des destinations de rêve aux meilleurs prix !</p>
            </div>
        </div>
    </header>
</div>

<!-- Section -->
<section class="">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card h-100 product-card">
                    <!-- image du vol-->
                    <img class="card-img-top" src="assets/images/city/89.jpg" alt="Image" />
                    <!-- Detail du vol-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Vol du vol-->
                            <h5 class="fw-bolder">Rome-Italie</h5>
                            <!-- Prix du vol-->
                            €300.00 - €400.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#logger_user">Plus de details</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100 product-card">
                    <!-- Billet bagde-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Visit</div>
                    <!-- image vol-->
                    <img class="card-img-top" src="assets/images/city/ville1.jpeg" alt="..." />
                    <!-- details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Billet -->
                            <h5 class="fw-bolder">Chicago</h5>
                            <!-- info-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill">Voyage</div>-
                                <div class="bi-star-fill">Tourisme</div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Vol prix-->
                            <span class="text-muted text-decoration-line-through">€480.00</span>
                            €420.00
                        </div>
                    </div>
                    <!-- actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#logger_user">Plus de details</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100 product-card">
                    <!-- badge -->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Visit</div>
                    <!-- image-->
                    <img class="card-img-top" src="assets/images/city/ville2.jpeg" alt="..." />
                    <!-- details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!--  name-->
                            <h5 class="fw-bolder">France</h5>
                            <!--  prix-->
                            <span class="text-muted text-decoration-line-through">€200.00</span>
                            €150.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#logger_user">Plus de details</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100 product-card">
                    <!-- Product image-->
                    <img class="card-img-top" src="assets/images/city/ville3.jpeg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">New York</h5>
                            <!-- reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill">Business</div>-
                                <div class="bi-star-fill">Voyage</div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- price-->
                            €560.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#logger_user">Plus de details</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100 product-card">
                    <!-- badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Visit</div>
                    <!-- image-->
                    <img class="card-img-top" src="assets/images/city/ville4.jpeg" alt="..." />
                    <!-- details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!--  name-->
                            <h5 class="fw-bolder">Paris</h5>
                            <!--  prix-->
                            <span class="text-muted text-decoration-line-through">€240.00</span>
                            €180.00
                        </div>
                    </div>
                    <!--  actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#logger_user">Plus de details</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100 product-card">
                    <!--  image-->
                    <img class="card-img-top" src="assets/images/city/ville5.jpg" alt="..." />
                    <!--  details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!--  name-->
                            <h5 class="fw-bolder">Brooklyn</h5>
                            <!--  price-->
                            €500.00 - €680.00
                        </div>
                    </div>
                    <!-- actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#logger_user">Plus de detail</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100 product-card">
                    <!--  badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">visit</div>
                    <!-- image-->
                    <img class="card-img-top" src="assets/images/city/ville6.jpg" alt="..." />
                    <!-- details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- name-->
                            <h5 class="fw-bolder">Los Angeles</h5>
                            <!-- reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill">Liberté</div>-
                                <div class="bi-star-fill">Egalité</div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- price-->
                            <span class="text-muted text-decoration-line-through">€780.00</span>
                            €620.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#logger_user">Plus de details</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100 product-card">
                    <!-- image-->
                    <img class="card-img-top" src="assets/images/city/ville10.jpeg" alt="..." />
                    <!-- details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- name-->
                            <h5 class="fw-bolder">Canada</h5>
                            <!-- reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill">Voyage</div>-
                                <div class="bi-star-fill">Travail</div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- price-->
                            €750.00
                        </div>
                    </div>
                    <!-- actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#logger_user">Plus de details</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Blog image -->
<section>
    <div class="container px-4 px-lg-5 my-2">
        <div class="row gx-4 gx-lg-5 d-flex justify-content-center align-items-center fad-card-green">
            <div class="col-sm-6 greenfad my-3">
                <h2 class="display-4 fw-bold green_fad">Découvrez la Fad Card de GreenFad</h2>
                <p class="lead">Chez GreenFad,nous nous engageons à développer des solutions innovantes qui simplifient et améliorent la vie professionnelle de nos clients, qu’il s’agisse de petites entreprises, de grandes entreprises ou de particuliers.</p>
                <p class="lead">Que vous soyez consultant indépendant, entrepreneur ou professionnel indépendant,  La Fad Card incarne notre engagement à intégrer la technologie de manière pratique et accessible. </p>
                <a href="https://greenfad.tech/decouvrez-la-fad-card-par-greenfad-revolutionnez-votre-facon-de-reseauter/" target="_blank" class="btn btn-primary w-100 product-card">En savoir plus</a>
    
            </div>
            <div class="col-sm-6 my-3 bg-white product-card">
                <img src="assets/images/fad/card.webp" alt="About" class="img-fluid">
            </div>
        </div>

    </div>
</section>


<!-- First carrousel -->

<!-- <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active my-2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 py-3">
                        <div class="card card-item product-card" style="width: 100%; box-shadow: 0 0 5px 0 rgba(0, 0, 0, .2);">
                            <img src="assets/images/city/hadj.jpeg" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </p>
                                <h5 class="card-title carousel-title">Mekkah</h5>
                                <p class="card-text">OMRA 14 Février 2025</p>
                                <hr class="divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content</p>
                                <a href="#" class="btn btn-primary">Reservez</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 py-3">
                        <div class="card card-item product-card" style="width: 100%;">
                            <img src="assets/images/city/oumra.jpeg" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </p>
                                <h5 class="card-title carousel-title">Medina</h5>
                                <p class="card-text">OMRA 28 Février 2025</p>
                                <hr class="divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content</p>
                                <a href="#" class="btn btn-primary">Reservez</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 py-3">
                        <div class="card card-item product-card" style="width: 100%;">
                            <img src="assets/images/city/mac.jpeg" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </p>
                                <h5 class="card-title carousel-title">Backiya</h5>
                                <p class="card-text">OMRA 10 Mars 2025</p>
                                <hr class="divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content</p>
                                <a href="#" class="btn btn-primary">Reservez</a>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="carousel-item my-2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 py-3">
                        <div class="card card-item product-card" style="width: 100%; box-shadow: 0 0 5px 0 rgba(0, 0, 0, .2);">
                            <img src="assets/images/city/chicago.jpeg" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </p>
                                <h5 class="card-title carousel-title">Chicago</h5>
                                <p class="card-text">20 Mars 2025</p>
                                <hr class="divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content</p>
                                <a href="#" class="btn btn-primary">Reservez</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 py-3">
                        <div class="card card-item product-card" style="width: 100%;">
                            <img src="assets/images/city/america.jpeg" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </p>
                                <h5 class="card-title carousel-title">New York</h5>
                                <p class="card-text">New York 16 Mars 2025</p>
                                <hr class="divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content</p>
                                <a href="#" class="btn btn-primary">Reservez</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 py-3">
                        <div class="card card-item product-card" style="width: 100%;">
                            <img src="assets/images/city/paris.jpeg" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </p>
                                <h5 class="card-title carousel-title">Paris</h5>
                                <p class="card-text">17 Février 2025</p>
                                <hr class="divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content</p>
                                <a href="#" class="btn btn-primary">Reservez</a>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="carousel-item my-2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 py-3">
                        <div class="card card-item product-card" style="width: 100%; box-shadow: 0 0 5px 0 rgba(0, 0, 0, .2);">
                            <img src="assets/images/burj.jpg" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </p>
                                <h5 class="card-title carousel-title">Dubai</h5>
                                <p class="card-text">25 Février 2025</p>
                                <hr class="divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content</p>
                                <a href="#" class="btn btn-primary">Reservez</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 py-3">
                        <div class="card card-item product-card" style="width: 100%;">
                            <img src="assets/images/city/ville11.jpeg" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </p>
                                <h5 class="card-title carousel-title">Amsterdam</h5>
                                <p class="card-text">30 Mars 2025</p>
                                <hr class="divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content</p>
                                <a href="#" class="btn btn-primary">Reservez</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 py-3">
                        <div class="card card-item product-card" style="width: 100%;">
                            <img src="assets/images/city/venise.jpeg" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </p>
                                <h5 class="card-title carousel-title">Venise Italie</h5>
                                <p class="card-text">24 Mars 2025</p>
                                <hr class="divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content</p>
                                <a href="#" class="btn btn-primary">Reservez</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->



<!-- Section -->
<section class="flyer px-4 px-lg-6 my-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-sm-3 mb-3">
            <div class="card h-100 card-one custom-card product-card">
                <!-- <img src="assets/images/city/ville11.jpeg" alt="Ville"> -->
                <div class="card-content">
                    <h4 class="card-title">Amsterdam</h4>
                    <p class="card-text">Découvrez les merveilles de la ville d'Amsterdam</p>
                    <a href="#fad_card" class="btn btn-outline-light">En savoir plus</a>
                </div>
            </div>
        </div>

        <div class="col-sm-3 mb-3">
            <div class="card h-100 card-one custom-card custom-2 product-card">
                <!-- <img src="assets/images/city/ville11.jpeg" alt="Ville"> -->
                <div class="card-content">
                    <h4 class="card-title">Paris</h4>
                    <p class="card-text">Visitez Paris la ville de l'amour et de la liberté</p>                     
                    <a href="#fad_card" class="btn btn-outline-light">En savoir plus</a>
                </div>
            </div>
        </div>

        <div class="col-sm-3 mb-3">
            <div class="card h-100 card-one custom-card custom-3 product-card">
                <!-- <img src="assets/images/city/ville11.jpeg" alt="Ville"> -->
                <div class="card-content">
                    <h4 class="card-title">Los Angeles</h4>
                    <p class="card-text">Découvrir Los Angeles la ville des opportunités</p>
                    <a href="#fad_card" class="btn btn-outline-light">En savoir plus</a>
                </div>
            </div>
        </div>

        <div class="col-sm-3 mb-3">
            <div class="card h-100 card-one custom-card custom-4 product-card">
                <!-- <img src="assets/images/city/ville11.jpeg" alt="Ville"> -->
                <div class="card-content">
                    <h4 class="card-title">Backiyah</h4>
                    <p class="card-text">Voyagez vers Los Angeles la ville de la Liberté</p>
                    <a href="#fad_card" class="btn btn-outline-light">En savoir plus</a>
                </div>
            </div>
        </div>

    </div>

</section>


<!-- contact -->
 
<section class="">
    <div class="container">
        <div class="row mx-0">
            <div class="col-sm-6 mb-5 formulaire">
                <h4 class="fw-bold green_fad display-5">Faites en sorte que votre Business Réussisse avec GreenFad</h4>
                <p class="lead">Chez GreenFad, notre mission est de transformer des idées innovantes en solutions pratiques qui favorisent le succès de l’entreprise. Nous nous efforçons de fournir des produits de haute qualité</p>
                <p class="lead">Maximisez votre visibilité en ligne grâce à notre expertise en SEO. Nous optimisons votre présence sur les moteurs de recherche pour attirer plus de visiteurs qualifiés et améliorer votre retour sur investissement.</p>

            </div>
            
            <!-- Demander à l'utilisateur qu'il doit se connecter pour poster un commentaire -->
            <?php if(!isset($_SESSION['user_id'])): ?>
                <div class="alert alert-warning logger_user">Vous devez vous connecter pour ajouter des suggestions</div>
            <?php else: ?>
                <div class="col-sm-6 is_logger" id="logger_user">
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
                        <bouton class="btn btn-primary my-2 py-2 fs-5 w-100 product-card">Envoyer</bouton>
                    </form>

                </div>
            <?php endif ?>
        </div>

    </div>
</section>


<!-- bloc image Fad red and fad red -->
<section id="fad_card">
    <div class="container px-4 px-lg-5 fad_card">
        <div class="row gx-4 gx-lg-5 d-flex justify-content-center align-items-center fad-card-green bg-white fad-container">
            <div class="col-sm-6 card-fad my-2 product-card">
                <img src="assets/images/fad/card-red.jpeg" alt="" srcset="">
            </div>
            <div class="col-sm-6 my-2 card-fad product-card">
                <img src="assets/images/fad/card-yellow.jpeg" alt="About" class="img-fluid">
            </div>
        </div>

    </div>
</section>


<!-- blog de fin -->
<section>
    <div class="container px-4 px-lg-5 py-5">
        <div class="row gx-4 gx-lg-5 d-flex justify-content-center align-items-center fad-card-green fad-container">
            <h4 class="display-5 text-center text-white fw-bold">Il est temps d'en parler au monde entier</h4>
            <p class="lead text-center text-white">Nous vous montrerons exactement quel contenu vous devez écrire pour figurer en haut des résultats des moteurs de recherche et générer le trafic que vous souhaitez.</p>
        </div>
    </div>
</section>
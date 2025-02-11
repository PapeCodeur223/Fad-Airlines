<?php 
link_css("./assets/css/style.css");
link_css("./assets/css/billet.css");

// Récupération des billets depuis la base de données
$stmt = $pdo->query("SELECT * FROM billets ORDER BY id DESC");
$billets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid px-0">
    <!-- Section Hero -->
    <header class="bg-dark py-5 px-0 br-0" id="hero">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Billeterie</h1>
                <p class="lead fw-normal text-white-50 mb-0">Des destinations de rêve aux meilleurs prix !</p>
            </div>
        </div>
    </header>
</div>

<!-- Fad card -->
<section class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 my-3">
                <div class="card mb-3 product-card" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="assets/images/fad/green.jpg.webp" class="img-fluid rounded-start w-100" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title green_fad">Notre Mission</h5>
                                <p class="card-text">Notre mission est d’accompagner les entreprises dans leur transformation digitale et leur expansion grâce à des solutions web et marketing.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deuxième card -->
            <div class="col-sm-6 my-3">
                <div class="card mb-3 product-card" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title green_fad">Notre Objectif</h5>
                                <p class="card-text">Nous concevons des sites web sur mesure et des applications dynamiques qui captivent vos utilisateurs et optimisent vos opérations.</p>
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

<!-- Billets d'avion -->
<section class="">
    <div class="container px-4 px-lg-5 mt-2">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($billets as $billet) : ?>
                <div class="col mb-5">
                    <div class="card h-100 product-card">
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Ticket</div>
                        <img src="<?= htmlspecialchars($billet['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($billet['name']) ?>">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="card-title"><?= htmlspecialchars($billet['name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($billet['description']) ?></p>
                                <p class="text-success fw-bold"><?= number_format($billet['price'], 2) ?>€</p>
                                <button class="btn btn-primary btn-add-cart w-100" 
                                    data-id="<?= $billet['id'] ?>" 
                                    data-name="<?= htmlspecialchars($billet['name']) ?>" 
                                    data-price="<?= $billet['price'] ?>">
                                    Achetez le billet
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Pour la redirection vers la page add_to_cart.php -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(".btn-add-cart").on("click", function() {
    let id = $(this).data("id");

    $.ajax({
        url: "pages/add_to_cart.php",
        type: "POST",
        data: { id: id },
        dataType: "json", // IMPORTANT : on attend du JSON
        success: function(data) {
            if (data.status === "success") {
                alert("✅ Billet ajouté au panier !");
                window.location.href = data.redirect; // Redirection
            } else {
                alert("❌ Erreur : " + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.log("❌ Erreur AJAX :", xhr.responseText, status, error);
            alert("❌ Une erreur s'est produite ! Vérifiez la console.");
        }
    });
});

</script>
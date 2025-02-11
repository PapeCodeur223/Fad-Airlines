<?php
link_css("./assets/css/style.css");
link_css("./assets/css/cart.css");


?>
<div class="container my-5">
    <section>
        <h2 class="display-6 text-center greenfad fw-bold">Votre Panier</h2>
        <div class="row my-5">
            <?php
            // On vérifie la session de connexion
            if(isset($_SESSION['panier']) && !empty($_SESSION['panier'])){
                $total = 0;
                
                // Pour chaque billet dans le panier
                foreach($_SESSION['panier'] as $billet_id => $quantity){
                    // Récupérer les informations du billet depuis la base de données
                    $statement = $pdo->prepare("SELECT * FROM billets WHERE id= :id");
                    $statement->execute(['id' => $billet_id]);
                    $billet = $statement->fetch();


                    echo "<div class='col-sm-6 mb-3'>
                        <div class='card mb-3 product-card'>
                            <div class='row g-0'>
                                <div class='col-md-4'>
                                    <div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>Ticket</div>
                                    <img src='{$billet['image']}' alt='{$billet['name']}' class='img-fluid' style='width:180px; height:250px'>
                                </div>
                                <div class='col-md-8'>
                                    <div class='card-body'>
                                        <h5 class='fs-3'>{$billet['name']}</h5>
                                        <p>Description : {$billet['description']} </p>
                                        <p class='prix'>Prix : {$billet['price']} €</p>
                                        <p class='quantite'>Quantité : <strong>{$quantity['quantity']} ". ($quantity['quantity'] > 1 ? 'tickets' : 'ticket') . "</strong> </p>
                                        <button class='btn btn-danger btn-remove-cart product-card' data-id='{$billet['id']}'>Retirer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";

                    // Calculer le total
                    $total += $billet['price'] * $quantity['quantity'];
                }

                echo "<div class='total my-3'>
                        <h5 class='my-2'>Montant TTC : $total €</h5>
                        <p class='my-2'><a href='index.php?page=checkout' class='btn btn-primary product-card py-2'>Payer la commande</a></p>
                      </div>";
                "<p><a href='index.php?page=checkout' class='btn btn-primary product-card py-2'>Payer la commande</a></p>";
            } else {
                echo "<div class='alert alert-danger mt-5'>Votre panier est vide.</div>";
            }
            ?>
        </div>
    </section>
</div>


<script>
    $(".btn-remove-cart").on("click", function() {
    let billet_id = $(this).data("id");

    $.ajax({
        url: "index.php?page=remove_from_cart",
        type: "POST",
        data: { id: billet_id },
        success: function(response) {
            console.log("Réponse AJAX ✅ :", response); // Voir la réponse du serveur
            let data = JSON.parse(response);
            if (data.status === "success") {
                alert("✅ Billet retiré du panier !");
                // Recharger la page pour mettre à jour le panier
                window.location.reload();
            } else {
                alert("❌ Erreur : " + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.log("❌ Erreur AJAX :", xhr.responseText, status, error);
            alert("❌ Erreur AJAX ! Vérifie la console (F12).");
        }
    });
});

</script>

<?php

link_css("./assets/css/style.css");
link_css("./assets/css/checkout.css");

// Vérifier si le panier est vide
if (empty($_SESSION['panier'])) {
    header('Location: index.php?page=cart'); // Rediriger vers la page panier si vide
    exit;
}

$panier = $_SESSION['panier'];
$total = 0;

var_dump($_SESSION['panier']);

// Calcul du total
foreach ($panier as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Si le formulaire de commande est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données de l'utilisateur (par exemple, adresse de livraison)
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];

    // Ajouter l'entrée de commande dans la base de données (vous devrez adapter cette partie)
    $stmt = $pdo->prepare("INSERT INTO commandes (nom, email, adresse, total) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $email, $adresse, $total]);

    // Récupérer l'ID de la commande insérée
    $order_id = $pdo->lastInsertId();

    // Ajouter chaque billet du panier dans la table `commande_items`
    foreach ($panier as $id => $item) {
        $stmt = $pdo->prepare("INSERT INTO commande_items (commande_id, billet_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $id, $item['quantity'], $item['price']]);
    }

    // Vider le panier
    unset($_SESSION['panier']);

    // Confirmation de la commande
    echo "<div class='container'>
            <h2>Commande réussie !</h2>
            <p>Merci pour votre commande. Vous allez recevoir un e-mail de confirmation sous peu.</p>
            <p><a href='index.php?page=home' class='btn btn-primary'>Retour à l'accueil</a></p>
          </div>";
    exit;
}
?>

<div class="container my-5 d-flex justify-content-center">
    <section style='width:900px'>
        <h2 class='greenfad text-center my-4'>Passer à la Caisse</h2>
        <form method="POST">
            <div class="mb-3 form-group">
                <label for="nom" class="form-label">Nom et Prénom complet</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3 form-group">
                <label for="email" class="form-label">Email de facturation</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3 form-group">
                <label for="adresse" class="form-label">Adresse de livraison</label>
                <textarea class="form-control" id="adresse" name="adresse" required></textarea>
            </div>
            
            <div class="my-5 total">
                <h5 class='greenfad'>Total de votre commande : <?= $total ?> €</h5>
                <button type="submit" class="btn btn-success product-card">Valider la commande</button>
            </div> 
            
        </form>
    </section>
</div>

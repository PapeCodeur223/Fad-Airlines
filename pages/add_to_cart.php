<?php
// On commence la session pour gérer les informations du panier
// session_start();

// Assurez-vous que la connexion à la base de données est incluse ici, par exemple
// include('config.php');

// Vérifier si les données sont présentes
if (isset($_POST['id'], $_POST['name'], $_POST['price'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Vérifier si la session panier existe, sinon l'initialiser
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Ajouter l'article au panier
    if (isset($_SESSION['panier'][$id])) {
        // Si l'article existe déjà, augmenter la quantité
        $_SESSION['panier'][$id]['quantity']++;
    } else {
        // Sinon, ajouter l'article avec une quantité de 1
        $_SESSION['panier'][$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => 1
        ];
    }

    // Répondre en JSON pour la réussite
    echo json_encode([
        'status' => 'success',
        'message' => 'Billet ajouté au panier avec succès.'
    ]);
} else {
    // Si les données ne sont pas présentes
    echo json_encode([
        'status' => 'error',
        'message' => 'Billet ou quantité manquante'
    ]);
}
?>



</script>
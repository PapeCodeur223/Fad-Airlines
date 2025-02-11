<?php

$response = array("status" => "error", "message" => "Erreur inconnue");

// Vérifier si l'ID du billet est fourni
if(isset($_POST['id']) && !empty($_POST['id'])){
    $billet_id = $_POST['id'];

    // Vérifier si le billet existe dans le panier
    if(isset($_SESSION['panier'][$billet_id])) {
        unset($_SESSION['panier'][$billet_id]); // Retirer le billet du panier

        // Vérifier si le panier est maintenant vide et rediriger si nécessaire
        if(empty($_SESSION['panier'])){
            $_SESSION['panier'] = array(); // Réinitialiser le panier
        }

        $response = array("status" => "success", "message" => "Billet retiré du panier avec succès");
    } else {
        $response = array("status" => "error", "message" => "Billet introuvable dans le panier");
    }
} else {
    $response = array("status" => "error", "message" => "ID du billet manquant");
}

// Retourner la réponse en JSON
echo json_encode($response);
?>

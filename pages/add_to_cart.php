<?php

session_start();
ob_start(); // Empêcher toute sortie indésirable

header('Content-Type: application/json'); // Indiquer que la réponse sera en JSON

// Activer l'affichage des erreurs pour débogage (désactive-le en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $billet_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); // Sécuriser l'ID

    if (!$billet_id) {
        ob_end_clean();
        echo json_encode(["status" => "error", "message" => "ID de billet invalide"]);
        exit;
    }

    // Vérifier si $_SESSION['panier'] est bien un tableau
    if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Ajouter ou mettre à jour la quantité du billet
    if (isset($_SESSION['panier'][$billet_id])) {
        $_SESSION['panier'][$billet_id]['quantity'] += 1;
    } else {
        $_SESSION['panier'][$billet_id] = ['quantity' => 1];
    }

    // Nettoyer la sortie avant d'envoyer JSON
    ob_end_clean();

    // Retourner une réponse JSON correcte
    echo json_encode([
        "status" => "success",
        "message" => "Billet ajouté au panier",
        "redirect" => "index.php?page=cart"
    ]);
    exit;
}

// Nettoyer et renvoyer une erreur JSON si la requête est invalide
ob_end_clean();
echo json_encode(["status" => "error", "message" => "Requête invalide"]);
exit;

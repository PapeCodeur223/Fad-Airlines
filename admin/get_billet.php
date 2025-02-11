<?php
require '../config/database.php';

header('Content-Type: application/json; charset=UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(["error" => "ID du billet non fourni"]);
    exit;
}

$id = intval($_POST['id']);

try {
    $stmt = $pdo->prepare("SELECT * FROM billets WHERE id = ?");
    $stmt->execute([$id]);
    $billet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$billet) {
        echo json_encode(["error" => "Billet introuvable"]);
        exit;
    }

   

    echo json_encode($billet, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur SQL : " . $e->getMessage()]);
}
exit;
?>

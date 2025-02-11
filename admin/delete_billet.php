<?php

$id = $_POST['id'];
$stmt = $pdo->prepare("DELETE FROM billets WHERE id = ?");
$stmt->execute([$id]);

echo json_encode(["status" => "success", "message" => "Billet supprimé"]);

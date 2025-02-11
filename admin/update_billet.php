<?php

$data = $_POST;
$stmt = $pdo->prepare("UPDATE billets SET name=?, description=?, price=?, stock=? WHERE id=?");
$stmt->execute([$data['name'], $data['description'], $data['price'], $data['stock'], $data['id']]);

echo json_encode(["status" => "success", "message" => "Billet mis à jour"]);

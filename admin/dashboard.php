<?php

link_css("./assets/css/style.css");
link_css("./assets/css/dashboard.css");

// Vérification admin (ajouté ici aussi pour plus de sécurité)
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header("Location: index.php?page=home");
    exit;
}

// Récupération des billets
$stmt = $pdo->query("SELECT * FROM billets ORDER BY id DESC");
$billets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery (Obligatoire pour Bootstrap JS) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<div class="container my-5 px-0">
    <h2 class="my-5 text-center greenfad">Dashboard Administrateur - Gestion des billets</h2>
    <h5 class="my-4 green-title"><a href="index.php?page=add_billet" class="text-warning green text-decoration-none">Ajouter un nouveau départ</a></h5>
    <table class="table table-bordered mb-5">
        <thead class="table-dark py-4 my-5">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($billets as $billet): ?>
                <tr id="billet-<?= $billet['id'] ?>">
                    <td><?= $billet['id'] ?></td>
                    <td><img src="<?= $billet['image'] ?>" width="70" alt="<?= $billet['name'] ?>"></td>
                    <td><?= htmlspecialchars($billet['name']) ?></td>
                    <td><?= htmlspecialchars($billet['description']) ?></td>
                    <td><?= number_format($billet['price'], 2) ?>€</td>
                    <td><?= $billet['stock'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-edit" data-id="<?= $billet['id'] ?>">Modifier</button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $billet['id'] ?>">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- MODAL POUR MODIFIER UN BILLET -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier un billet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" id="edit-name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea id="edit-description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix</label>
                        <input type="number" id="edit-price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" id="edit-stock" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
// Suppression d'un billet
$(".btn-delete").on("click", function() {
    let id = $(this).data("id");

    if (confirm("Voulez-vous vraiment supprimer ce billet ?")) {
        $.post("index.php?page=delete_billet", { id: id }, function(response) {
            alert(response.message);
            if (response.status === "success") {
                $("#billet-" + id).remove();
            }
        }, "json");
    }
});


// Modifier un billet (Pré-remplir les champs du modal)

// Derrier test
$(document).ready(function () {
    $(".btn-edit").on("click", function () {
        let id = $(this).data("id");

        console.log("ID du billet sélectionné :", id); // Vérification

        if (!id) {
            alert("Erreur : ID du billet introuvable !");
            return;
        }

        $.ajax({
            url: "admin/get_billet.php",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                console.log("Réponse AJAX ✅ :", response);

                if (response.error) {
                    alert("❌ Erreur : " + response.error);
                } else {
                    $("#edit-id").val(response.id);
                    $("#edit-name").val(response.name);
                    $("#edit-description").val(response.description);
                    $("#edit-price").val(response.price);
                    $("#edit-stock").val(response.stock);

                    let modal = new bootstrap.Modal(document.getElementById("editModal"));
                    modal.show();
                }
            },
            error: function (xhr, status, error) {
                console.log("❌ Erreur AJAX :", xhr.responseText, status, error);
                alert("Erreur AJAX ! Vérifie la console (F12).");
            }
        });
    });
});



// Enregistrement des modifications
$("#editForm").on("submit", function(e) {
    e.preventDefault();

    let data = {
        id: $("#edit-id").val(),
        name: $("#edit-name").val(),
        description: $("#edit-description").val(),
        price: $("#edit-price").val(),
        stock: $("#edit-stock").val()
    };

    $.post("index.php?page=update_billet", data, function(response) {
        alert(response.message);
        if (response.status === "success") {
            location.reload(); // Recharger la page après modification
        }
    }, "json");
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

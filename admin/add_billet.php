<?php 
link_css("./assets/css/style.css");
link_css("./assets/css/add_product.css");


// Vérification de l'authentification
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit();
}

// Vérification des permissions administrateur
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] === 0) {
    echo "<div class='alert alert-danger mt-5'>Désolé, vous n'êtes pas autorisé à accéder à cette page.</div>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Récupération et nettoyage des données du formulaire
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;
    $price = isset($_POST['price']) ? (float)$_POST['price'] : null;
    $stock = isset($_POST['stock']) ? (int)$_POST['stock'] : null;

    // Vérification des champs obligatoires
    if (empty($name) || empty($description) || $price <= 0 || $stock < 1) {
        die("<div class='alert alert-danger text-center'>Erreur : Veuillez remplir tous les champs correctement.</div>");
    }

    // Vérification et création du dossier uploads
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Gestion de l'upload de l'image
    $upload_path = null;
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
        $file_name = $_FILES["image"]["name"];
        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_extensions)) {
            die("<div class='alert alert-danger text-center'>Erreur : Format d'image non valide (JPG, JPEG, PNG, GIF uniquement).</div>");
        }

        // Générer un nom unique pour l'image
        $new_file_name = uniqid("vol_", true) . "." . $file_ext;
        $upload_path = $upload_dir . $new_file_name;

        // Déplacement de l'image
        if (!move_uploaded_file($file_tmp, $upload_path)) {
            die("<div class='alert alert-danger text-center'>Erreur lors de l'upload de l'image.</div>");
        }
    } else {
        die("<div class='alert alert-danger'>Erreur : Aucune image fournie.</div>");
    }

    // Insertion dans la base de données avec PDO
    try {
        $requete = $pdo->prepare("INSERT INTO billets (name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)");
        if ($requete->execute([$name, $description, $price, $stock, $upload_path])) {
            $success = "Vol vers {$name} enregistré avec succès !";
        } else {
            $error = "Erreur lors de l'enregistrement du vol.";
        }
    } catch (PDOException $e) {
        $error = "Erreur SQL : " . $e->getMessage();
    }
}
?>

<!-- Section des messages de succès ou d'erreur -->
<section class="success">
    <?php if (isset($success)): ?>
        <div class="container mt-5">
            <div class="alert alert-success text-center"><?= $success ?></div>
        </div>
    <?php elseif (isset($error)): ?>
        <div class="container mt-5">
            <div class="alert alert-danger text-center"><?= $error ?></div>
        </div>
    <?php endif ?>
</section>

<!-- Formulaire d'ajout de vol -->
<section class="addproduct my-5">
    <div class="container content-addproduct">
        <div class="row">
            <h4 class="text-title text-center">Ajouter un nouveau vol</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name" class="label-control">Nom du vol</label>
                    <input type="text" name="name" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="description" class="label-control">Description</label>
                    <input type="text" name="description" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="price" class="label-control">Prix du billet</label>
                    <input type="number" name="price" step="0.01" required class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="stock" class="label-control">Nombre de billets disponibles</label>
                    <input type="number" name="stock" required class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="image" class="label-control">Image de destination</label>
                    <input type="file" name="image" accept="image/*" required class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary w-100 my-3">Enregistrer le vol</button>
            </form>
        </div>
    </div>
</section>


<?php 
link_css("./assets/css/style.css");
link_css("./assets/css/login.css");

// Si l'utilisateur est connecté on le renvoit sur la page d'accueil
if(isset($_SESSION['user_id'])){
    header("Location: index.php?page=home");
    exit();
}

// On vérifie la logique et les méthodes de connexion
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email= :email");
    $statement->execute(['email' => $email]);
    $user = $statement->fetch();

    if($user && password_verify($password, $user['password'])){
        // L'utilisateur est connecté
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['is_admin'] = (int) $user['is_admin'];

        // Redirection après la connexion de l'utilisateur
        header("Location: index.php?page=home");
        exit();

    }else{
        $error = "Please, Identifiant ou mot de passe incorrect";
    }


}


?>


<?php if(isset($error)): ?>
    <div class="container mt-5 mb-0">
        <div class="alert alert-danger text-center">
            <?= $error ?>
        </div>
    </div>
<?php endif ?>

<section class="login">
    <div class="container content-login">
        <div class="login-header">
            <h4 class="text-center green_fad"><img src="assets/images/fad/fad-card.webp" alt="logo" srcset="">&nbsp;Login</h4>
            <form method="POST" action="">
                <div class="form-group my-2">
                    <label for="email" class="label-form my-2">Email</label>
                    <input type="email" name="email" required class="form-control">
                </div>
                
                <div class="form-group my-2">
                    <label for="password" class="label-form my-2">Mot de passe</label>
                    <input type="password" name="password" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mb-3 mt-2 w-100">Se connecter</button>
            </form>

            <p class="text-center">Pas encore inscrit ? <a href="index.php?page=register">Inscrivez-vous ici</a></p>

        </div>
    
    </div>
</section>
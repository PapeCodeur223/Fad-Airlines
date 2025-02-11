<?php 
link_css("./assets/css/style.css");
link_css("./assets/css/register.css");

// Vérification de la logique : s'il est déja connecté on lui renvoit vers la page d'accueil
if(isset($_SESSION['user_id'])){
    header("Location: index.php?page=home");
    exit();
}

// On verifie l'authenticité de l'utilisateur
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_verify'];

    // Pas besoin de vérifier le type du champ email
    if($password !== $password_confirm){
        $error = "Les deux mots de passe ne correspondent pas !";
    }else{
        // On encode, on cript le mot de passe dans la base de donnée
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // vérifie si l'utilisateur est déja utilisé
        $statement = $pdo->prepare("SELECT * FROM users WHERE email= :email");
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        if($user){
            $error = "L'utilisateur avec l'adresse ". $user['email'] . " est déja utilisé";
        }else{
            // ON insère l'utilisateur dans la DB
            $statement = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)")->execute(['username'=> $username  ,'email'  => $email, 'password'  => $password_hash ]);

            // on recupère les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['email'] = $email;

            // redirection
            header("Location: index.php?page=login");
            exit();
        }

    }


}


?>

<?php if(isset($error)): ?>
    <div class="container mt-5">
        <div class="alert alert-danger text-center">
            <?= $error ?>
        </div>
    </div>
<?php endif ?>


<section class="register">
    <div class="container content-register">
        

        <div class="register-header">
            <h4 class="green_fad text-center mb-4"><img src="assets/images/fad/fad-card.webp" alt="logo" srcset="">&nbsp;Register</h4>
            <form method="POST" action="">
                <div class="form-group my-2">
                    <label for="username" class="label-form">Nom complet</label>
                    <input type="text" name="username" required class="form-control">
                </div>
                <div class="form-group my-2">
                    <label for="email" class="label-form">Email</label>
                    <input type="email" name="email" required class="form-control">
                </div>
                
                <div class="form-group my-2">
                    <label for="password" class="label-form">Mot de Passe</label>
                    <input type="password" name="password" required class="form-control">
                </div>
                <div class="form-group my-3">
                    <label for="password" class="label-form">Confirmer le mot de Passe</label>
                    <input type="password" name="password_verify" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mb-3 w-100">S'inscrire</button>
            </form>

            <p class="text-center">Déjà inscrit ? <a href="index.php?page=login">Connectez-vous ici</a></p>
        </div>
    </div>
</section>
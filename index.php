<?php 

session_start();

// Initialisation du panier si non défini
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Pour les titre de la pages
$page = $_GET['page'] ?? 'home';
$titles = [
    'home' => 'Greenfad Airlines',
    'about' => 'A Propos de nous',
    'billet' => 'Nos billets de vols disponibles',


    'cart' => 'Votre compte',
    'reserve' => 'Reservez vos billets',
    'login' => 'Se connecter',
    'logout' => 'Se deconnecter',
    'register' => 'S\'inscrire',

   
    'delete_billet' => 'Annuler le vol',
    'update_billet' => 'Modifier le vol',
    'add_billet' => 'Ajouter des vols',
    'dashboard' => 'Panneau d\'administration',

    'add_to_cart' => 'Ajouter un billet',
    'checkout' => 'Passer à la caisse',

    'remove_from_cart' => 'Retirer un billet',
    'get_billet' => 'Modifier un billet',

    'erreur' => 'Page 404',

];
$title = $titles[$page] ?? 'Page 404';

// Import des fichiers neccessaires pour la connexion :
require 'includes/functions.php';
require 'includes/header.php';
require 'config/database.php';


// Récupération de la page en cours
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Sécuriser le nom du fichier (évite l'exécution de fichiers non autorisés)
$pages_disponibles = ['home', 'about', 'billet', 'add_billet', 'update_billet', 'dashboard', 'delete_billet', 'get_billet', 'login', 'register', 'add_to_cart', 'remove_from_cart' ,'cart', 'checkout', 'logout'];
$page = in_array($page, $pages_disponibles) ? $page : 'erreur';

?>


<!-- Inclusion de la page demandée -->
<?php 

$admin = ['add_billet', 'update_billet', 'dashboard', 'delete_billet', 'get_billet'];

if(in_array($page, $admin)){
    require "admin/$page.php";
}else{
    require "pages/$page.php"; 
}

?>




<?php require 'includes/footer.php';  ?>
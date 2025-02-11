<?php 
// Identifiants de la base de donnée 
$host = 'localhost';
$dbname = 'kilakodon_voyage';
$charset = 'utf8mb4';
$user = 'root';
$password = '';

// Connexion à la PDO

try{
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die("Connexion à MySql faibled : ". $e->getMessage());
}


// Création de la base de donnée si elle n'existe pas
$pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");


try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die("Erreur lors de la connexion à la base de donnée : ". $e->getMessage());
}


// Création des tables :
$tables = [
    "CREATE TABLE IF NOT EXISTS billets (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        stock INT NOT NULL,
        image VARCHAR(255) NOT NULL
    )",
    // Création de la table USERS
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        is_admin INT DEFAULT 0, -- 0 = utilisateur classique, 1 = administrateur,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(100) NOT NULL
    )",
    // Table Cart :
    "CREATE TABLE IF NOT EXISTS cart(
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        total DECIMAL(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users (id)
    )",
    "CREATE TABLE IF NOT EXISTS cart_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cart_id INT NOT NULL,
        billet_id INT NOT NULL,
        quantity INT NOT NULL,
        FOREIGN KEY (cart_id) REFERENCES cart(id),
        FOREIGN KEY (billet_id) REFERENCES billets(id)
    )",
    "CREATE TABLE IF NOT EXISTS contacts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(100) NOT NULL,
        telephone VARCHAR(8) NOT NULL,
        email VARCHAR(100) NOT NULL,
        sujet VARCHAR(255) NOT NULL,
        commentaire TEXT NOT NULL,
        date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    // Pour les commandes
    "CREATE TABLE IF NOT EXISTS commandes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        adresse TEXT NOT NULL,
        total DECIMAL(10, 2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    
    "CREATE TABLE IF NOT EXISTS commande_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        commande_id INT NOT NULL,
        billet_id INT NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (commande_id) REFERENCES commandes(id),
        FOREIGN KEY (billet_id) REFERENCES billets(id)
    )"
    

];


// Table crées :
foreach ($tables as $table) {
    $pdo->exec($table);
}

// Modifier le rôle de lutilisateur avec le SQL
// "UPDATE users SET is_admin = 1 WHERE email = 'admin@email.com';"

<?php 

// session_start();    // démarrer la session
session_unset();    // supprimer les variables de sessions
session_destroy(); // detruire les sessions

header("Location: index.php?page=home");
exit();

?>

<?php 
    link_css("./assets/css/style.css");
    // link_css("./assets/css/erreur.css");

?>

<div class="container">
    <div class="content">
        <img src="assets/images/not_found.jpeg" alt="not_found404" class="img-fluid">
        <h2 class='greenfad'>Erreur 404 : Page introuvable</h2>
        <p class="mb-0">Désolé, la page demandée n'existe pas.</p>
        <p class="my-0">Pour aller à la page <a href="index.php?page=home" class="lien-home">Home du site</a></p>
    </div>
</div>*

<style>
    :root{
    --secondary : #143D60;
    --three : #23486A;
    --four : #16404D;
    --five: #2E5077;
    --seven: #2A3663;
    --prime : #FCC737;
    --since: #3E5879;
    --greenfad: #356c7e;

}

.content{
    height: 100vh !important;
    text-align: center;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

}
.greenfad{
    font-weight: bold;
    color: var(--greenfad);
}
header, .footer-card{
    display: none;

}
a.lien-home{
    text-decoration: none;
    color: var(--greenfad);
    font-weight: 600;
}

a.lien-home:hover{
    color: black;
}

img.img-fluid{
    width: 600px;
}
</style>
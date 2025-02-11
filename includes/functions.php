<?php 

$page = $_GET['page'] ?? 'home';

function nav_item(string $url, string $title):string {
    global $page;
    $active = ($page == $url) ? 'active' : '';
    return 
    "<li class='nav-item'>
        <a class='nav-link $active' href='./index.php?page=$url'>$title</a>
    </li>";
}


//  POUR LES LIENS EN LINK
function link_css(string $url):void {
    echo "<link rel='stylesheet' href='$url'>"; 
}

function script_js(string $url):void {
    echo "<script src='$url'></script>"; 
}

?>

<h1>Desenvolvimento Web</h1>


<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$paginaAtual = basename($_SERVER['PHP_SELF']);

if ($paginaAtual !== 'index.php') {
    echo '<a href="../class/home.php">Home</a>';
    

}

if (isset($_SESSION['name'])) {
    echo '<h1>Login: ' . strtoupper($_SESSION['name']) . '</h1>';
            
     echo '<a href="../class/logout.php">Logout</a>';

}




?>
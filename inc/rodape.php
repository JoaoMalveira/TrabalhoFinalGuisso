<div class="footer">
<?php
$paginaAtual = basename($_SERVER['PHP_SELF']);
if ($paginaAtual !== 'sobre.php') {
   echo '<p class="footer p"><a class="footer a" href="../inc/sobre.php">Sobre</a></p>';

}
if ($paginaAtual !== 'index.php') {
   echo '<p class=".pa"><a class="footer a" href="../inc/logout.php">Logout</a></p>';
}
?>
</div>
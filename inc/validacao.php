<?php


 if (!isset($_SESSION['name'])){
     header('Location: ../paginas/index.php');

     exit;  
 }

 if (isset($_POST['name'])){
   echo '<p>' . $_POST['name'] . '</p>';
   echo "<a href='../paginas/logout.php'></a>";

}   
?>
<?php


 if (!isset($_SESSION['name'])){
     header('Location: ../class/index.php');

     exit;  
 }

 if (isset($_POST['name'])){
   echo '<p>' . $_POST['name'] . '</p>';
   echo "<a href='../class/logout.php'></a>";

}   
?>
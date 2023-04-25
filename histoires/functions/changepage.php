<?php session_start();
$history=$_SESSION['currentHistory'];
$id=$_POST['NB_ID'];
header("Location: ../modifyparag.php?S_ID=".$history."&P_ID=".$id);
exit();
<?php
session_start();
ob_start();
include "conn.php";
?>

<?php
if (!isset($_SESSION['userid'])){
header('location:../pages/index.php');
}
$id_session=$_SESSION['userid'];
include "conn.php";

?>
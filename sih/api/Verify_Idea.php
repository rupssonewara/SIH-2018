<?php

// Check connection
require '../include/DB_CONNECT.php';

$db= new DB_CONNECT();

$con=$db->connect();

$id = $_POST['id'];
$decision = $_POST['decision'];


$sql = "Update Idea SET STATUS = $decision WHERE id = $id";
$query = mysqli_query($con, $sql);

if($query){
  echo '<script type="text/javascript">';
  echo 'alert("Verification Done");' ;
  echo 'window.location.href = "../Web_Portal/complain.php";';
  echo '</script>';
}else{
  echo "not success";
}

?>

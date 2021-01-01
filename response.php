<?php
require 'config/db.php';

if($_SERVER['REQUEST_METHOD']=='POST')
{

$ifsc = $_POST['ifsc'];
$res = mysqli_query($conn, "SELECT ifsc FROM data WHERE ifsc='$ifsc'");
$row = mysqli_fetch_assoc($res);
if($row == NULL)
  echo "is-invalid";
else 
  echo "is-valid";
}
else{
  header("location:errors/404.html");
}
	
?>
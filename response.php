<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
  require 'config/db.php';
  $ifsc = $_POST['ifsc'];
  $res = mysqli_query($conn, "SELECT ifsc FROM data WHERE ifsc='$ifsc'");
  $row = mysqli_fetch_assoc($res);

  if(!$row)
    echo "is-invalid";
  else 
    echo "is-valid";
  
  if($conn){
    mysqli_close($conn); 
  }
}

else{
  header("location:errors/error_404.html");
}
	
?>
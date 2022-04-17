<?php
$host="localhost";
$user="root";
$password="";
$db="mall";
session_start();
$data=mysqli_connect($host,$user,$password,$db);
if($data===false)
{
	die("connection error");
}
$passid =$_SESSION['sid'];



?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="shopowner_style.css" rel="stylesheet">
    <title>Owner</title>
  </head>
  <body>

    <!-- As a heading -->
    <nav class="nav">
    <a class="nav-link" aria-current="page" href="index.php">MALL</a>
    <a class="nav-link disabled">SHOP OWNER</a>
    </nav>
    <div class="shopowner_class">
  <br>
  <br>
  <br>

<center>
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 style="color:white" class="card-title">GOODS</h5>
          <p class="card-text"></p>
          <a href="goodsview.php" class="btn btn-light">Go </a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 style="color:white" class="card-title">RENT</h5>
          <p class="card-text"></p>
          <a href="rentview.php" class="btn btn-light">Go</a>
        </div>
      </div>
    </div>
  </div>

  <br>
  <br>
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 style="color:white" class="card-title">EMPLOYEES</h5>
          <p class="card-text"></p>
          <a href="emplist.php" class="btn btn-light">Go </a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 style="color:white" class="card-title">CUSTOMERS</h5>
          <p class="card-text"></p>
          <a href="customer.php" class="btn btn-light">Go</a>
        </div>
      </div>
    </div>
  </div>

  <br>
  <br><br><br><br><br><br><br><br><br>

  

  
  

</center>
    

   







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<br><br>
</div> 
  </body>
</html>
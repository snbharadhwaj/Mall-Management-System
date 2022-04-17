<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "mall";

$sname = "";
$sfloor = "";


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href="floor_style.css" rel="stylesheet">
    <title>MALL MANAGEMENT</title>
</head>
<body>
<nav class="nav">
    <a class="nav-link" aria-current="page" href="index.php">MALL</a>
    <a class="nav-link" href="admin.php">ADMIN</a>
    <a class="nav-link disabled">FLOOR</a>
  </nav>
  <div class="body">
  <br>
  <br>
  <br>
  <br>
    <div class="container">
    <table class="table table-light table-hover">
  <thead>
    <tr>
      <th scope="col">SHOP NAME</th>
      <th scope="col">FLOOR NAME</th>
    </tr>
  </thead>
  <tbody>
<?php

$sql="Select * from `shop`";
$result=mysqli_query($connect,$sql);
if($result){
    while($row=mysqli_fetch_assoc($result)){
                $sname= $row['sname'];
                $sfloor = $row['sfloor'];
               
        echo '<tr>
        <th scope="row">'.$sname.'</th>
        <td>'.$sfloor.'</td>
        
       
      </tr>';
    }
}

?>

  </tbody>
</table>
</div>
<br><br><br><br><br><br><br><br><br><br>
</div>
</body>
</html>
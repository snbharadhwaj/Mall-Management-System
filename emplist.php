<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "mall";

$eid = "";
$ename= "";
$ephone = "";
$eaddress = "";
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
    <link href="emplist_style.css"rel='stylesheet'>
    <title>MALL MANAGEMENT</title>
</head>
<body>
<nav class="nav">
    <a class="nav-link" aria-current="page" href="index.php">MALL</a>
    <a class="nav-link" href="shopowner.php">SHOP OWNER</a>
    <a class="nav-link disabled">EMPLOYEE LIST</a>
  </nav>
  <br>
    <center>
<div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          
          <a href="temp.php" class="btn btn-success">Temperature</a>
        </div>
      </div>
    </div>

<div class="container">
    

  <tbody>
<?php
session_start();
$sid = $_SESSION['sid'];
$sql="Select * from employee where sid='$sid' " ;
$result=mysqli_query($connect,$sql);
if($result = mysqli_query($connect, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<table class="table table-bordered table-hover">';
            echo "<thead>";
                echo "<tr>";
                    echo "<th>EID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Phone</th>";
                    echo "<th>Email</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['eid'] . "</td>";
                    echo "<td>" . $row['ename'] . "</td>";
                    echo "<td>" . $row['ephone'] . "</td>";
                    echo "<td>" . $row['eaddress'] . "</td>";
                    echo "<td>";
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else{
    echo "Oops! Something went wrong. Please try again later.";
}

?>

  </tbody>
</table>
</div>
</body>
</html>
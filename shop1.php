<!DOCTYPE Html>
<html>
    <head>
        <title>PHP INSERT UPDATE DELETE SEARCH</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="shop1_style.css" rel="stylesheet">
    </head>
    <centre>
    <body>
    <nav class="nav">
    <a class="nav-link" aria-current="page" href="index.php">MALL</a>
    <a class="nav-link" href="admin.php">ADMIN</a>
    <a class="nav-link disabled">SHOP</a>
    </nav>
  <div class="body">
  <br>
  <br>
  <br>
  <center>

<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "mall";

$sid = "";
$sname = "";
$sfloor = "";
$service = "";
$did = "";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}

// get values from the form
function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['sid'];
    $posts[1] = $_POST['sname'];
    $posts[2] = $_POST['sfloor'];
    
    $posts[4] = $_POST['did'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM `shop` WHERE `sid` = '$data[0]'";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $sid = $row['sid'];
                $sname = $row['sname'];
                $sfloor = $row['sfloor'];
               
                $did = $row['did'];
            }
        }else{
            echo 'No Data For This Id';
        }
    }else{
        echo 'Result Error';
    }
}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `shop`(`sid`,`Sname`,`sfloor`,`did`) VALUES ('$data[0]','$data[1]','$data[2]','$data[4]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Inserted';
            }else{
                echo 'Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();
    $delete_Query = "DELETE FROM `shop` WHERE `sid` = '$data[0]'";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Deleted';
            }else{
                echo 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query = "UPDATE `shop` SET `sname`='$data[1]',`sfloor`='$data[2]',`did`='$data[4]'  WHERE `sid` = '$data[0]'";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Updated';
            }else{
                echo 'Data Not Updated';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}



?>
<br><br>


    <center>
        <form action="shop1.php" method="post">
        <div class="input">
            <input type="text" name="sid" placeholder="sid" value="<?php echo $sid;?>"><br></br>
            <input type="text" name="sname" placeholder="shop name" value="<?php echo $sname;?>"><br></br>
            <input type="text" pattern="[0-9]*" name="sfloor" placeholder="floorname" value="<?php echo $sfloor;?>"><br></br>
            <input type="text" name="did" placeholder="department no" value="<?php echo $did;?>"><br></br>
            </div>
            <br>

            <div class="col-sm-6">
                
                <!-- Input For Add Values To Database-->
                <input type="submit" name="insert" class="btn btn-light" value="Add">
                

                
                <!-- Input For Edit Values -->
                <input type="submit" name="update" class="btn btn-light" value="Update">
                
                <!-- Input For Clear Values -->
                <input type="submit" name="delete" class="btn btn-light" value="Delete">
                
                <!-- Input For Find Values With The given ID -->
                <input type="submit" name="search" class="btn btn-light" value="Find">

                

            </div>  
        </form>
        </center>
        <br><br> <br>
    <br>
    <br>
    <br> <br>
    <br>
    <br>
    <br>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </div>
    </body>
    
</html>
<!DOCTYPE Html>
<html>
    <head>
        <title>GOODS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="goods_style.css" rel="stylesheet">
    </head>
    <centre>
    <body>
    <nav class="nav">
    <a class="nav-link" aria-current="page" href="index.php">MALL</a>
    <a class="nav-link" href="security.php">SECURITY</a>
    <a class="nav-link disabled">GOODS</a>
    </nav>
  <div class="body">
  <br>
  <br>
  <center>

<?php


$host = "localhost";
$user = "root";
$password ="";
$database = "mall";

$track_id = "";
$sid = "";
$arr_time = "";
$quantity = "";
$price = "";
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
    $posts[0] = $_POST['track_id'];
    $posts[1] = $_POST['sid'];
    $posts[2] = $_POST['arr_time'];
    $posts[3] = $_POST['quantity'];
    $posts[4] = $_POST['price'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM `goods` WHERE `track_id` = '$data[0]'";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $track_id = $row['track_id'];
                $sid = $row['sid'];
                $arr_time = $row['arr_time'];
                $quantity = $row['quantity'];
                $price = $row['price'];
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
    $insert_Query = "INSERT INTO `goods`(`track_id`,`sid`,`arr_time`,`quantity`,`price`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')";
    if($data[3]<1){echo '<script>alert("ERROR!! Invalid quantity")</script>';}
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
    $delete_Query = "DELETE FROM `goods` WHERE `track_id` = '$data[0]'";
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
    $update_Query = "UPDATE `goods` SET `sid`='$data[1]',`arr_time`='$data[2]',`quantity`='$data[3]',`price`='$data[4]'  WHERE `track_id` = '$data[0]'";
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
        <form action="goods.php" method="post">
        <div class="input_box">
            <input type="text" name="track_id" placeholder="track_id" required value="<?php echo $track_id;?>"><br></br>
            <input type="text" name="sid" placeholder="shop id"  value="<?php echo $sid;?>"><br></br>
           
            <input type="text" pattern="[0-9]*" name="quantity" placeholder="quantity"  value="<?php echo $quantity;?>"><br></br>
            <input type="text" pattern="[0-9]*" name="price" placeholder="price"  value="<?php echo $price;?>"><br></br>
            <input type="date" name="arr_time" placeholder="Date"  value="<?php echo $arr_time;?>"><br></br>
        </div>  
        <br> 
            <div class="col-sm-6"> 
                
                <!-- Input For Add Values To Database-->
                <input type="submit" name="insert" class="btn btn-light" value="Add">
                
                <!-- Input For Find Values With The given ID -->
                <input type="submit" name="search" class="btn btn-light" value="Find">

                

            </div>  
        </form>
        </center>
        <br><br><br><br><br><br><br><br><br>
    </div>
    </body>
    </centre>
</html>
<!DOCTYPE Html>
<html>
    <head>
        <title>shop owner</title>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="rent_style.css" rel="stylesheet">
    </head>
    
    <body>
    <nav class="nav">
    <a class="nav-link" aria-current="page" href="index.php">MALL</a>
    <a class="nav-link" href="admin.php">ADMIN</a>
    <a class="nav-link disabled">SHOP RENT</a>
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

$tras_id = "";
$sid = "";
$rent_amt = "";
$date = "";
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
    $posts[0] = $_POST['tras_id'];
    $posts[1] = $_POST['sid'];
    $posts[2] = $_POST['rent_amt'];
    $posts[3] = $_POST['date'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM `own_account` WHERE `sid` = '$data[1]'";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $tras_id = $row['tras_id'];
                $sid = $row['sid'];
                $rent_amt = $row['rent_amt'];
                $date= $row['date'];
            
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
    $insert_Query = "INSERT INTO `own_account`(`tras_id`, `sid`, `rent_amt`, `date`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        if($data[2]<0){echo '<script>alert("invalid amount")</script>';}
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
    $delete_Query = "DELETE FROM `own_account` WHERE `tras_id` = '$data[0]'";
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
    $update_Query = "UPDATE `own_account` SET `sid`='$data[1]',`rent_amt`='$data[2]',`date`='$data[3]' WHERE `sid` = '$data[1]'";
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
        <form action="rent.php" method="post">
            <div class="input">
            <input type="text" name="tras_id" placeholder="tras_id" value="<?php echo $tras_id;?>"><br></br>
            <input type="text" name="sid" placeholder="shop id" value="<?php echo $sid;?>"><br></br>
            <input type="text" pattern="[0-9]*" name="rent_amt" placeholder="rent_amt" value="<?php echo $rent_amt;?>"><br></br>
            <input type="date"  name="date" placeholder="date" value="<?php echo $date;?>"><br></br>
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
        <br><br><br><br><br><br><br><br><br><br>
</div>
    </body>
  
</html>
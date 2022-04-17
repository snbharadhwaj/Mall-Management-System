<!DOCTYPE Html>
<html>
    <head>
        <title>PHP INSERT UPDATE DELETE SEARCH</title>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="customer_style.css" rel="stylesheet">
    </head>
    
    <body>
    <nav class="nav">
    <a class="nav-link" aria-current="page" href="index.php">MALL</a>
    <a class="nav-link" href="shopowner.php">SHOP OWNER</a>
    <a class="nav-link disabled">CUSTOMER</a>
    </nav>
    <div class="body">
        <br><br><br>
<center>
<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "mall";

$cust_id = "";
$cname = "";
$sid = "";
$cphone = "";
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
    $posts[0] = $_POST['cust_id'];
    $posts[1] = $_POST['cname'];
    $posts[2] = $_POST['sid'];
    $posts[3] = $_POST['cphone'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM `customer` WHERE `cust_id` = '$data[0]'";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $cust_id = $row['cust_id'];
                $cname = $row['cname'];
                $sid = $row['sid'];
                $cphone = $row['cphone'];
            
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
    $insert_Query = "INSERT INTO `customer`(`cust_id`,`cname`,`sid`,`cphone`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
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
    $delete_Query = "DELETE FROM `customer` WHERE `cust_id` = '$data[0]'";
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
    $update_Query = "UPDATE `customer` SET `cname`='$data[1]',`sid`='$data[2]',`cphone`='$data[3]' WHERE `cust_id` = '$data[0]'";
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



    <center>
        <br><br>
        <form action="customer.php" method="post">
            <div class="input">
            <input type="text" name="cust_id" placeholder="cust_id" required value="<?php echo $cust_id;?>"><br></br>
            <input type="text" name="cname" placeholder="cname" required value="<?php echo $cname;?>"><br></br>
            <input type="text" name="sid" placeholder="sid" required  value="<?php echo $sid;?>"><br></br>
            <input type="text" pattern="[0-9]{10}" name="cphone" placeholder="cphone" required  value="<?php echo $cphone;?>"><br></br>
            </div>
            <br>
            <div class="col-sm-6">
                
                    <!-- Input For Add Values To Database-->
                    <input type="submit" name="insert" class="btn btn-light" value="Add">
                    

                    
                    <!-- Input For Edit Values -->
                    <input type="submit" name="update" class="btn btn-light" value="Update">
                    
                    
                    
                    <!-- Input For Find Values With The given ID -->
                    <input type="submit" name="search" class="btn btn-light" value="Find">

                    <a href="custlist.php" class="btn btn-light">List</a>

                </div>  
            
        </form>


        </center>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>   
    <br><br><br><br><br><br><br><br><br><br><br>
    </div>
    </body>

    
</html>
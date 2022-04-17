<!DOCTYPE Html>
<html>
    <head>
        <title>checking</title>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="checking_style.css" rel="stylesheet">
    </head>
    <body>
    <nav class="nav">
    <a class="nav-link" aria-current="page" href="index.php">MALL</a>
    <a class="nav-link" href="security.php">SECURITY</a>
    <a class="nav-link disabled">CHECKING</a>
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

$eid = "";
$ch_no = "";
$temp = "";
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
    $posts[0] = $_POST['eid'];
    $posts[1] = $_POST['ch_no'];
    $posts[2] = $_POST['temp'];
    $posts[3] = $_POST['date'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM `checking` WHERE `ch_no` = '$data[1]'";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $sid = $row['eid'];
                $sname = $row['ch_no'];
                $sfloor = $row['temp'];
                $sservice = $row['date'];
            
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
    $insert_Query = "INSERT INTO `checking`(`eid`,`ch_no`,`temp`,`date`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
    if($data[2]>103){echo '<script>alert("High Temperature!!!")</script>';}
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
    $delete_Query = "DELETE FROM `checking` WHERE `ch_no` = '$data[0]'";
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
    $update_Query = "UPDATE `checking` SET `eid`='$data[0]',`temp`='$data[2]',`date`='$data[3]' WHERE `ch_no` = '$data[1]'";
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
        <form action="checking.php" method="post">
            <div class="input_box">
            <input type="text" name="eid" placeholder="eid" required value="<?php echo $eid;?>"><br></br>
            <input type="text" name="ch_no" placeholder="ch_no" required value="<?php echo $ch_no;?>"><br></br>
            <input type="text" pattern="[0-9]*" name="temp" placeholder="temperature" required value="<?php echo $temp;?>"><br></br>
            <input type="date" name="date" placeholder="date" required value="<?php echo $date;?>"><br></br>
            </div>
            <br>
            <div class="col-sm-6">
                
                    <!-- Input For Add Values To Database-->
                    <input type="submit" name="insert" class="btn btn-light" value="Add">
                    

                    
                    <!-- Input For Edit Values -->
                   

                    

                </div>  
        </form>


   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <br> <br>
    <br>
    <br>
    <br><br><br><br><br><br><br><br><br>
    </div>

    </body>
    
</html>
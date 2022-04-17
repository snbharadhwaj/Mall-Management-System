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
    
    $search_Query = "SELECT * FROM `shop` WHERE `sid` = '$data[0]'";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $sid = $row['tras_id'];
                $sname = $row['sid'];
                $sfloor = $row['rent_amt'];
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
    $insert_Query = "INSERT INTO `own_account`(`tras_id`,`sid`,`rent_amt`,`date`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
    if($data[2]<0)
        {
            echo '<script>alert("invalid amount")</script>';
        }
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
    $update_Query = "UPDATE `own_account` SET `sid`='$data[1]',`rent_amt`='$data[2]',`date`='$data[3]' WHERE `tras_id` = '$data[1]'";
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


<!DOCTYPE Html>
<html>
    <head>
        <title>PHP INSERT UPDATE DELETE SEARCH</title>
    </head>
    <centre>
    <body>
    <centre>
        <form action="owner.php" method="post">
            <input type="text" name="tras_id" placeholder="tras_id" value="<?php echo $tras_id;?>"><br></br>
            <input type="text" name="sid" placeholder="shop id" value="<?php echo $sid;?>"><br></br>
            <input type="text" name="rent_amt" placeholder="rent_amt" value="<?php echo $rent_amt;?>"><br></br>
            <input type="text" name="date" placeholder="date" value="<?php echo $date;?>"><br></btext>
            
            <div>
                <!-- Input For Add Values To Database-->
                <input type="submit" name="insert" value="Add">
                
                <!-- Input For Edit Values -->
                <input type="submit" name="update" value="Update">
                
                <!-- Input For Clear Values -->
                <input type="submit" name="delete" value="Delete">
                
                <!-- Input For Find Values With The given ID -->
                <input type="submit" name="search" value="Find">
                
            </div>
            
        </form>
        </centre>
    </body>
    </centre>
</html>
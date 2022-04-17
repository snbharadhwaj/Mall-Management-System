<!DOCTYPE Html>
<html>
    <head>
        <title>EMPLOYEE</title>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="employee1_style.css" rel="stylesheet">
    </head>
    <centre>
    <body>
    <nav class="nav">
    <a class="nav-link" aria-current="page" href="index.php">MALL</a>
    <a class="nav-link" href="admin.php">ADMIN</a>
    <a class="nav-link disabled">EMPLOYEE</a>
    </nav>
    <div class="body">
  <br>
<center>

<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "mall";

$eid = "";
$ename = "";
$ephone = "";
$eaddress = "";
$sid = "";
$did = "";
$desig = "";
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
    $posts[1] = $_POST['ename'];
    $posts[2] = $_POST['ephone'];
    $posts[3] = $_POST['eaddress'];
    $posts[4] = $_POST['sid'];
    $posts[5] = $_POST['did'];
    $posts[6] = $_POST['desig'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM `employee` WHERE `eid` = '$data[0]'";
    
    try{
        $search_Result = mysqli_query($connect,$search_Query);
        
            if($search_Result)
            {
                if(mysqli_num_rows($search_Result))
                {
                    while($row = mysqli_fetch_array($search_Result))
                    {
                        $eid = $row['eid'];
                        $ename = $row['ename'];
                        $ephone = $row['ephone'];
                        $eaddress = $row['eaddress'];
                        $sid = $row['sid'];
                        $did = $row['did'];
                        $desig = $row['desig'];
                    }
                }else{
                    echo 'No Data For This Id';
                }
            }else{
                echo 'Result Error';
            }
        }catch (Exception $ex) {
                echo 'Error Insert '.$ex->getMessage();
            }

}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `employee`(`eid`, `ename`, `ephone`, `eaddress`, `sid`, `did`, `desig`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
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
    $delete_Query = "DELETE FROM `employee` WHERE `eid` = '$data[0]'";
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
    $update_Query = "UPDATE `employee` SET `ename`='$data[1]',`ephone`='$data[2]',`eaddress`='$data[3]',`sid`='$data[4]' ,`did`='$data[5]',`desig`='$data[6]' WHERE `eid` = '$data[0]'";
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
        <form action="employee1.php" method="post">
        <div class="input">
            <input type="text" name="eid"  placeholder="eid" required value="<?php echo $eid;?>"><br></br>
            <input type="text" name="ename" placeholder="ename"  value="<?php echo $ename;?>"><br></br>
            <input type="text" pattern="[0-9]{10}" name="ephone" placeholder="ephone"  value="<?php echo $ephone;?>"><br></br>
            <input type="text" name="eaddress" placeholder="eaddress"  value="<?php echo $eaddress;?>"><br></br>
            <input type="text" name="sid" placeholder="shop id"  value="<?php echo $sid;?>"><br></br>
            <input type="text" name="did" placeholder="department id"   value="<?php echo $did;?>"><br></br>
            <input type="text" name="desig" placeholder="designation"   value="<?php echo $desig;?>"><br></br>
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
        <br><br><br><br><br><br><br><br>
</div>
    </body>
    </centre>
</html>
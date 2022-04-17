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


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST["username"];
	$password=$_POST["password"];


	$sql="select * from employee where ename='".$username."' AND eid='".$password."' ";

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row)
	{	

		

		header("location:security.php");
	}
	else
	{
		echo "username or password incorrect";
	}

}




?> 



<!DOCTYPE html>
<html>
<head>
	<title>security login</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="securitylogin_style.css" rel="stylesheet">
</head>
<body>

<center>
	<div class="security">
	<h1>Security Login </h1>
	</div>
	<br><br><br><br>
	<div class="login_box">
		<br><br>


		<form action="#" method="POST">

	<div>
		<label>username</label>
		<input type="text" name="username" required>
	</div>
	<br><br>

	<div>
		<label>password</label>
		<input type="password" name="password" required>
	</div>
	<br><br>

	<div>
		
	<button name="submit" class="btn btn-light">Login</button>
	</div>


	</form>


	<br><br>
 </div>
</center>

</body>
</html>
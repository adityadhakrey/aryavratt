<?php
include("connection.php");

$msg="";

$fn=$_REQUEST["firstname"];
$ln=$_REQUEST["lastname"];
$gender=$_REQUEST["gender"];
$age=$_REQUEST["age"];
$city=$_REQUEST["city"];
$country=$_REQUEST["country"];
$email=$_REQUEST["email"];
$password=$_REQUEST["password"];
$pic=$gender=="male"?"male.png":"female.png";
	
$check=mysqli_query($con,"select * from signup where EMAIL='$email'");
if(mysqli_num_rows($check)>0)
{
	echo $msg="Email is Already Taken!Please Try Another;";
}
else
{
$send=mysqli_query($con,"insert into signup(FIRSTNAME,LASTNAME,GENDER,AGE,CITY,COUNTRY,EMAIL,PASSWORD,PIC)values('$fn','$ln','$gender','$age','$city','$country','$email','$password','$pic')");
 if($send==true)
 {
 $msg="Congratulation!Just Login To Your Account.";
}
else
{
$msg="error!upload";
}
}
echo $msg;
?> 
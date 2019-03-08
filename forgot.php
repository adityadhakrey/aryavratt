<?php
include("connection.php");
$email=$_REQUEST["email"];
$checkemail=mysqli_query($con,"select * from signup where EMAIL='$email'");
if(mysqli_num_rows($checkemail)>0)
{
$fetchpassword=mysqli_query($con,"select * from signup where EMAIL='$email");
$pwd=mysqli_fetch_array($fetchpassword)
$password=$pwd["PASSWORD"];
$header="From: dhakrey@aryavratt.com";
mail("$email","password recovery from aryavratt.com","your password is $password",$header);

echo "password has been sent to $email";
}
else
{
echo "Email Doesn't Exist";
}

?>

<?php
include('connection.php');
$em="adhakare@gmail.com";
$q=$_REQUEST['searchword'];
$q=str_replace("@","",$q);
$q=str_replace(" ","%",$q);
$sql_res=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.PIC,s.AGE,s.CITY,s.COUNTRY,f.EMAIL,f.FRIENDEMAIL from signup s,friend f where s.FIRSTNAME like '%$q%' and(s.EMAIL=f.FRIENDEMAIL and f.EMAIL='$em' and f.FRIENDEMAIL<>'$em')");
while($row=mysqli_fetch_array($sql_res))
{
$fname=$row["FIRSTNAME"];
$lname=$row["LASTNAME"];
$img=$row["PIC"];
$country=$row["COUNTRY"];

?>

<div class="display_box" align="left">
<img src="user/<?php echo $img; ?>" class="image"/>
<a href="#" class='addname' title='<?php echo $fname; ?>&nbsp;<?php echo $lname; ?>'>
<?php echo $fname; ?>&nbsp;<?php echo $lname; ?> </a><br/>
<?php
}

?>

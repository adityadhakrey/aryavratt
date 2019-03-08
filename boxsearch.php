<?php
include('connection.php');
$em="adhakare@gmail.com";
$q=$_REQUEST['searchword'];
$q=str_replace("@","",$q);
$q=str_replace(" ","%",$q);
$sql_res=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.PIC,s.AGE,s.CITY,s.COUNTRY,f.EMAIL,f.FRIENDEMAIL from signup s,friend f where s.FIRSTNAME like '%$q%' and (s.EMAIL=f.FRIENDEMAIL and f.EMAIL='$em' and f.FRIENDEMAIL<>'$em') ");
while($row=mysqli_fetch_array($sql_res))
{
$fname=$row["FIRSTNAME"];
$lname=$row["LASTNAME"];
$img=$row["PIC"];
$country=$row["COUNTRY"];

?>

<div class="display_box"  align="left">
<div class="row">
<div class="col-sm-4">
<img src="user/<?php echo $img; ?>" class="image"/>
</div>
<div class="col-sm-8">
<a style="font-size:16px;color:dodgerblue;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='dodgerblue'" onclick="taged('<?php echo $fname; ?>&nbsp;<?php echo $lname; ?>')" id="addname" >
<?php echo $fname; ?>&nbsp;<?php echo $lname; ?> </a><br/>
</div>
</div>
</div>
<?php
}

?>

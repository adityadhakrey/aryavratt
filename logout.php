<?php
setcookie("Email","",time()-3600);
//unset($_COOKIE["Email"]);

header("location:index.php");
?>
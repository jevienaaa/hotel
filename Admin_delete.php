<?php

session_start();
include "Database_connection.php";

if(isset($_GET['id']))
{
$OID=$_GET['id'];
$SQL= "DELETE FROM owner WHERE owner_id='$OID' ";
if(!mysqli_query($conn,$SQL))
{
echo 'Try Again';
}
else
echo 'Delete Successful';
header("location: http://localhost/hotel/Admin_list.php");
}
?>

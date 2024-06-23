<?php

session_start();
include "Database_connection.php";

if(isset($_GET['id']))
{
$OID=$_GET['id'];
$SQL= "DELETE FROM room WHERE room_id='$OID' ";
if(!mysqli_query($conn,$SQL))
{
echo 'Try Again';
}
else
echo 'Delete Successful';
header("location: http://localhost/hotel/Room_list.php");
}
?>
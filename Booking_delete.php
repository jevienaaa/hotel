<?php

session_start();
include "Database_connection.php";

if(isset($_GET['id']))
{
$BID=$_GET['id'];
$SQL= "DELETE FROM booking WHERE booking_id='$BID' ";
if(!mysqli_query($conn,$SQL))
{
echo 'Try Again';
}
else
echo 'Delete Successful';
header("location: http://localhost/hotel/Booking_list.php");
}
?>
<?php
$SERVERNAME="localhost";
$USERNAME="root";
$PASSWORD="";
$DB="hotel";
$conn= mysqli_connect($SERVERNAME,$USERNAME,$PASSWORD,$DB);
if(!$conn)
{
echo 'Not connected';
}
if(!mysqli_select_db($conn,'hotel'))
{
echo 'Database not selected';
}
?>
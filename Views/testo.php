<?php 
$id = 1;
$conn=mysqli_connect("127.0.0.1","admone","123","tienda");

$sql="CALL menos($id,1);";
$result=mysqli_query($conn,$sql);
echo $result;

?>

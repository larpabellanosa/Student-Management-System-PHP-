<?php

include_once("connections/connections.php");
$con = connection();

$id = $_GET['ID'];
$sql = "DELETE from student_info WHERE student_id = '$id' ";
$con->query($sql) or die ($con->error);
echo header("Location: index.php");

?>
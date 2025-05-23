<?php

include("connections.php");

$user_id = $_POST["user_id"];

mysqli_query($connections, "DELETE FROM mytbl WHERE id = '$user_id' ");

echo "<script languages='javascript'>alert('Record has been Deleted!')</script>";
echo "<script>window.location.href='index.php';</script>";

?>


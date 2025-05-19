<?php

$user_id = $_REQUEST["id"];

include("connections.php");

$query_delete = mysqli_query($connections, "SELECT * FROM mytbl WHERE id = $user_id");

while($row_delete = mysqli_fetch_assoc($query_delete)) {

    $user_id = $row_delete["id"];

    $db_name = $row_delete["name"];
    $db_address = $row_delete["address"];
    $db_email = $row_delete["email"];
    $db_contact = $row_delete["contact"];
}

echo "<h1> Are you sure you want to delete $db_name ? </h1>";

?>

<form method="POST" action="Delete_Now.php">
<input type="hidden"
name="user_id"
value="<?php echo $user_id; ?>">

<br>
<br>

<input type="submit" value="Yes"> &nbsp; <a href="index.php">No</a>

</form>
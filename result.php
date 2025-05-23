<?php

include("connections.php");

if (empty($_GET["search"])) {

    echo "Please enter a search term.";
} else {
    $check = $_GET["search"];
    $terms = explode(" ", $check);
    $q = "SELECT * FROM mytbl WHERE ";
    $i = 0;

    foreach ($terms as $each) {
        $i++;
        if ($i == 1) {
            $q .= "name LIKE '%" . mysqli_real_escape_string($connections, $each) . "%' ";
        } else {
            $q .= "OR name LIKE '%" . mysqli_real_escape_string($connections, $each) . "%' ";
        }
    }

    $query = mysqli_query($connections, $q);
    $c_q = mysqli_num_rows($query);

    if ($c_q > 0 && $check != "") {
        while ($row = mysqli_fetch_assoc($query)) {
            $name = $row["name"];
            echo $name . "<br>";
        }
    } else {
        echo "No Result.";
    }
}

?>

<?php
$email = $password = "";
$emailErr = $passwordErr = $loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    if ($email && $password) {
        include("connections.php");

        $check_email = mysqli_query($connections, "SELECT * FROM mytbl WHERE email='$email'");
        $check_email_rows = mysqli_num_rows($check_email);

        if ($check_email_rows > 0) {
            $found = false;
            while ($row = mysqli_fetch_assoc($check_email)) {
                $user = $row["id"];
                $db_password = $row["password"];
                $db_account_type = $row["account_type"];

                if ($password === $db_password) {
                    session_start();
                    $found = true;
                    if ($db_account_type == "1") {
                        echo "<script>window.location.href='Admin';</script>";
                    } else {
                        echo "<script>window.location.href='user';</script>";
                    }
                    exit(); 
                }
            }

            if (!$found) {
                $passwordErr = "Incorrect password!";
            }
        } else {
            $emailErr = "Email not found!";
        }
    }
}
?>

<style>
    .error {
        color: red;
    }
</style>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
    <span class="error"><?php echo $emailErr; ?></span>
    <br>
    <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>">
    <span class="error"><?php echo $passwordErr; ?></span>
    <br>
    <input type="submit" value="Login">
</form>
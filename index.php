<?php
    $connect = new mysqli('localhost', 'root', '', 'register');
 
    if ($connect->connect_error) {
        die('Ошибка подключения (' . $connect->connect_errno . ') '
                . $connect->connect_error);
    }
 
    if (mysqli_connect_error()) {
        die('Ошибка подключения (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
 
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $r_password = $_POST['r_password'];
        if ($password == $r_password) {
            $password = md5($password);
            $connect->query("INSERT INTO users VALUES ('', '$username', '$login', '$password')") or die(mysqli_error());
        } else {
            die("password must match!");
        }
    }
 
    if (isset($_POST['enter'])) {
     $log = $_POST['e_login'];
     $pass = md5($_POST['e_password']);
     $result = $connect->query("SELECT * FROM users WHERE login='$log'");
     $row = $result->fetch_assoc();
     if ($row == 0) {
        echo "Not Ok";
     } else {
           if ($row["password"] == $pass) {
            echo "OK";
           } else {
            echo "Not Ok";
           }
     }
    }
?>
<form action="index.php" method="post">
    <input type="text" name="username" placeholder="- username" required /><br>
    <input type="text" name="login" placeholder="- login" required /><br>
    <input type="password" name="password" placeholder="- password" required /><br>
    <input type="password" name="r_password" placeholder="- repeat password" required /><br>
    <input type="submit" name="submit" value="register" />
</form>
<hr>
<form action="index.php" method="post">
    <input type="text" name="e_login" placeholder="- login" required /><br>
    <input type="password" name="e_password" placeholder="- password" required /><br>
    <input type="submit" name="enter" value="enter" />
</form>
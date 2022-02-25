<?php
    if(isset($_POST["login"])) 
    {
        $isSuccess = 0;
        $connect = new PDO("mysql:host=127.0.0.1:3306, dbname=test", "root", "");
        $login = $_POST['login'];
        $result = $connect->query("SELECT * FROM test.users WHERE login='$login'")->fetch();
        if (!empty($result)) {
            $hashedPassword = $result["password"];
            if (password_verify($_POST["password"], $hashedPassword)) {
                $isSuccess = 1;
            }
        }
        if ($isSuccess == 0) {
            echo "Error";
        } else {
            echo "Success";
        }
    }
?>
        
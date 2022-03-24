<?php
    function auth($login, $password) 
    {
        $isSuccess = 0;
        $connect = new PDO("mysql:host=127.0.0.1:3306, dbname=test", "root", "");
        $result = $connect->query("SELECT * FROM test.users WHERE login='$login'")->fetch();
        if (!empty($result)) {
            $hashedPassword = $result["password"];
            if (password_verify($password, $hashedPassword)) {
                $isSuccess = 1;
            }
        }
        if ($isSuccess == 0) {
            echo "Error";
        } else {
            setcookie('auth', json_encode(array('login' => $login, 'password' => $password)));
            echo "Success";
        }
    }

    if(isset($_POST["login"])) 
    {
        auth($_POST['login'], $_POST['password']);
    } else {
        if(isset($_COOKIE['auth'])) {
            $data = json_decode($_COOKIE['auth']);
            auth($data->login, $data->password);
        }
    }
?>
        
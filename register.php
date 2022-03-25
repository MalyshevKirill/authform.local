<?php
    $secret = '6LftzwofAAAAAE5uuiBWAu5g8U4UTciu6_uwQeTf';
    require_once (dirname(__FILE__).'/recaptcha/autoload.php');
    if (isset($_POST['g-recaptcha-response'])) {
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
        if ($resp->isSuccess()) {
            $connect = new PDO("mysql:host=127.0.0.1:3306, dbname=test", "root", "");
            $data = array(
                ':name' => $_POST["name"],
                ':surname' => $_POST["surname"],
                ':email' => $_POST["email"],
                ':login' => $_POST["login"],
                ':password' => password_hash($_POST["password"], PASSWORD_DEFAULT),
                ':gender' => $_POST["gender"],
                ':over18yo' => $_POST["over18yo"]
            );
            $query = "INSERT INTO test.users
            (name, surname, email, login, password, gender, over18yo) 
            VALUES (:name, :surname, :email, :login, :password, :gender, :over18yo)
            ";
            $statement = $connect->prepare($query);
            $status = $statement->execute($data);
            if($status == 1) {
                echo "Success";
            } else {
                echo "Error";
            }
        } else {
            echo "Captcha error";
        }
    }
?>
<?php
    if(isset($_POST["login"])) 
    {
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
        $statement->execute($data);
        echo "Data saved";
    }
?>
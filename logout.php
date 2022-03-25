<?php
    if(isset($_COOKIE['auth'])) {
        setcookie('auth', null, -1);
    }
?>
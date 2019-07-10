<?php

session_start();
include "../class/prodavac.php";


global $prodavac;
if (isset($_POST['username']) && isset($_POST['password'])) {
    $prodavac = new  prodavac();
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($prodavac->login($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        echo "1";

    }
}else{
    echo "0";
}
<?php

session_start();

include "../class/racun.php";

global $racun;

if(isset($_POST["stavke"]) & isset($_POST["total"]) & isset($_POST["payment_option"])) {
    $table = $_POST["stavke"];
    $stavke = array_chunk($table, 4);
    $total = $_POST["total"];
    $payment_option = $_POST["payment_option"];
    $employee = $_SESSION["username"];


$racun = new racun();
$status = $racun -> insert_bill($stavke,$total,$payment_option, $employee);

    print_r($status);
}

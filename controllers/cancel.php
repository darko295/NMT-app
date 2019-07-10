<?php
session_start();

include "../class/racun.php";

global $racun;

if(isset($_GET["bill_id"])) {
    $bill_id = $_GET["bill_id"];



    $racun = new racun();
    $status = $racun -> cancel_bill($bill_id);

    print_r($status);
}

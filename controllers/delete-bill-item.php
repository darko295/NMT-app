<?php
session_start();

include "../class/stavkaracuna.php";

global $stavkaracuna;

if(isset($_GET["bill_id"]) & isset($_GET["bill_item_id"])) {
    $bill_id = $_GET["bill_id"];
    $bill_item_id = $_GET["bill_item_id"];


    $stavkaracuna = new stavkaracuna();
    $status = $stavkaracuna -> delete_bill_item($bill_id,$bill_item_id);

    print_r($status);
}
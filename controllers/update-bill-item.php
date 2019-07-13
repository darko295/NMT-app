<?php
session_start();

include "../class/stavkaracuna.php";

global $stavkaracuna;

if(isset($_GET["bill_id"]) & isset($_GET["bill_item_id"]) & isset($_GET["kolicina"]) & isset($_GET["iznos"])) {
    $bill_id = $_GET["bill_id"];
    $bill_item_id = $_GET["bill_item_id"];
    $kolicina = $_GET["kolicina"];
    $iznos = $_GET["iznos"];


    $stavkaracuna = new stavkaracuna();
    $status = $stavkaracuna -> update_bill_item($bill_id,$bill_item_id,$kolicina,$iznos);

    print_r($status);
}
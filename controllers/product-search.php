<?php

session_start();

include "../class/proizvod.php";

global $proizvod;

if(isset($_GET["type"])) {


if(isset($_GET["term"])) {

    $term = $_GET["term"];
    $proizvod = new proizvod();

    $sug = $proizvod->get_suggestions($term);

    return $sug;

}else{
    $product_name = $_GET["product"];

    $proizvod = new proizvod();

    $product = $proizvod->get_product_by_name($product_name);
    if($product !== "0"){
        $row = $product -> fetch_object();
    echo json_encode(array("Naziv"=>$row->Naziv,"Cena"=>$row -> Cena));

    }else{

        echo "0";
    }

}

}

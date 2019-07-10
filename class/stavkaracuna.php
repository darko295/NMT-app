<?php

include(dirname(__FILE__) . "/../public/connection.php");
include(dirname(__FILE__) . "/../class/proizvod.php");
class stavkaracuna
{
    public  function add_bill_item($stavka, $bill_id,$bill_item_id){
        global $mysqli;
        global  $proizvod;
        $proizvod = new proizvod();


        $stmt = $mysqli->prepare("INSERT INTO stavkaracuna (RacunID, RBStavke, Kolicina, Iznos, ProizvodID) VALUES (?, ?, ?, ?, ?)");

        $product_name = $stavka[0]["value"];
        $product = $proizvod ->get_product_by_name($product_name);
        $product_id = $product ->fetch_object() -> ProizvodID;
        $amount =  $stavka[1]["value"];
        $value = $stavka[3]["value"];
        $stmt->bind_param("iiidi", $bill_id, $bill_item_id, $amount, $value, $product_id);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function get_items_by_bill_id($bill_id){
        global $mysqli;
        $sql = "SELECT sr.RBStavke, sr.Kolicina, sr.Iznos, p.Cena, p.Naziv FROM  stavkaracuna sr JOIN proizvod p ON sr.ProizvodID=p.ProizvodID  WHERE RacunID = '" . $bill_id . "'
         ORDER BY sr.RBStavke ASC";

        if ($result = $mysqli->query($sql)) {
            return $result;
        }
        return null;
    }

}
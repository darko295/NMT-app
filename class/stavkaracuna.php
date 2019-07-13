<?php

include_once(dirname(__FILE__) . "/../public/connection.php");
include_once(dirname(__FILE__) . "/../class/proizvod.php");
include_once(dirname(__FILE__) . "/../class/racun.php");

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
        $sql = "SELECT sr.RacunID, sr.RBStavke, sr.Kolicina, sr.Iznos, p.Cena, p.Naziv FROM  stavkaracuna sr JOIN proizvod p ON sr.ProizvodID=p.ProizvodID  WHERE sr.RacunID = '" . $bill_id . "'
         ORDER BY sr.RBStavke ASC";

        if ($result = $mysqli->query($sql)) {
            return $result;
        }
        return null;
    }

    public function get_total($bill_id){
        global $mysqli;
        $sql = "SELECT SUM(Iznos) as suma FROM stavkaracuna  WHERE RacunID = '" . $bill_id . "'";
        if ($result = $mysqli->query($sql)) {
            return $result -> fetch_object() -> suma;
        }
        return null;

    }

public function delete_bill_item($bill_id,$bill_item_id){
    global $mysqli;
    $sql = "DELETE FROM stavkaracuna WHERE RacunID ='". $bill_id."' AND RBStavke =".$bill_item_id;
    if ($q = $mysqli->query($sql)) {
        $suma = $this -> get_total($bill_id);
        global $racun;
        $racun = new racun();
        $status = $racun -> update_total($bill_id,$suma);
        if($status){
        echo "1";
            }else{
            echo "0";
        }

    } else {
        echo "0";
    }
}

public function update_bill_item($bill_id,$bill_item_id,$kolicina,$iznos){
    global $mysqli;
    $sql = "UPDATE stavkaracuna SET Kolicina = '".$kolicina."', Iznos = '".$iznos."' WHERE RacunID = '" . $bill_id . "' AND RBStavke =".$bill_item_id;
    if($mysqli->query($sql)){
            $suma = $this -> get_total($bill_id);
            global $racun;
            $racun = new racun();
            $status = $racun -> update_total($bill_id,$suma);
            if($status){
                echo "1";
            }else{
                echo "Greška prilikom ažuriranja totala.";
            }

    }else{
        echo "0";
    }
}

}
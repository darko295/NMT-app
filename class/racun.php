<?php

include_once(dirname(__FILE__) . "/../public/connection.php");
include_once(dirname(__FILE__) . "/../class/stavkaracuna.php");
include_once(dirname(__FILE__) . "/../class/prodavac.php");


class racun
{

    public  function insert_bill($stavke,$total,$payment_option,$employee){
        global $mysqli;
        global $stavkaracuna;
        global $prodavac;

        $prodavac = new prodavac();
        $employee = $prodavac -> get_user_id($employee);
        $employee_id = $employee -> fetch_object() -> ZaposleniID;
        $date = date("Y-m-d H:i:s");
        $storniran = 0;
        $stmt = $mysqli->prepare("INSERT INTO racun (UkupanIznos, DatumKreiranja, Storniran, ZaposleniID, NacinPlacanjaID) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isiii", $total, $date, $storniran , $employee_id, $payment_option);

        if ($stmt->execute()) {
            $bill_id = $stmt->insert_id;

            for ($i = 0; $i < sizeof($stavke); $i++) {
                $stavkaracuna = new stavkaracuna();
                $rb_stavke = $i + 1;
                $status = $stavkaracuna -> add_bill_item($stavke[$i], $bill_id, $rb_stavke);
                if($status === false){
                    return "Greška prilikom unosa računa";
                }
            }

            return "Uspešno dodat račun sa stavkama!";
        } else {
            echo "Greška prilikom unosa računa";
        }

    }

    public function  get_all_bills(){
        global $mysqli;
        $sql = "SELECT np.Naziv as NacinPlacanja, r.RacunID, r.UkupanIznos, r.DatumKreiranja,r.Storniran, r.PoslednjeAzuriranje
                FROM nacinplacanja np JOIN racun r ON np.NacinPlacanjaID=r.NacinPlacanjaID
                ORDER BY r.DatumKreiranja DESC";

        if ($result = $mysqli->query($sql)) {
            return $result;
        }
        return null;
    }

    public function delete_bill($bill_id){
        global $mysqli;
        $sql = "DELETE FROM racun WHERE RacunID =". $bill_id;
        if ($q = $mysqli->query($sql)) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function cancel_bill($bill_id){
        global $mysqli;
        $update_time = date("Y-m-d H:i:s");
        $sql = "UPDATE racun SET Storniran = 1,PoslednjeAzuriranje='".$update_time."'  WHERE RacunID = '" . $bill_id . "'";
        if($mysqli->query($sql)){
            if ($mysqli->affected_rows == 1) {
                echo "1";
            }else{
                echo "0";
            }
        }else{
        echo "0";
        }
    }



    public function update_total($bill_id, $suma){
        global $mysqli;
        $update_time = date("Y-m-d H:i:s");
        $sql = "UPDATE racun SET UkupanIznos ='".$suma."',PoslednjeAzuriranje='".$update_time."'  WHERE RacunID = '" . $bill_id . "'";
        if($mysqli->query($sql)){
            if ($mysqli->affected_rows == 1) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

}
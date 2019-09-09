<?php

include(dirname(__FILE__) . "/../public/connection.php");


class prodavnica
{
    function get_all_stores(){
        global $mysqli;
        $sql = "SELECT * FROM prodavnica";

        if ($result = $mysqli->query($sql)) {
            return $result;
        }
        return null;    
	}


	function get_store_name_by_id($id){
        global $mysqli;
        $sql = "SELECT * FROM prodavnica WHERE ProdavnicaID=".$id;

        if ($result = $mysqli->query($sql)) {
            return $result;
        }
        return null;    
	}

}
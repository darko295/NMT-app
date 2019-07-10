<?php

include(dirname(__FILE__) . "/../public/connection.php");


class proizvod
{
    function get_suggestions($term){
        global $mysqli;
        $term = "%".strtolower($term) ."%";
        $stmt = $mysqli->prepare("SELECT * FROM proizvod WHERE Naziv LIKE ?");
        $stmt->bind_param("s", $term);


        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                while($row = $result->fetch_array()){
                    echo "<p>" . $row["Naziv"] . "</p>";
                }
            }else{
                return "No matches";
            }
        }

    }

    function get_product_by_name($product_name){
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT * FROM proizvod WHERE Naziv = ?");
        $stmt->bind_param("s", $product_name);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) === 1) {
                return $result;
            }else{
                return "0";
            }
            }
    }

}
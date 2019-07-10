<?php
session_start();

include "../class/stavkaracuna.php";

global $stavkaracuna;

if(isset($_GET["bill_id"])) {
    $bill_id = $_GET["bill_id"];


    $stavkaracuna = new stavkaracuna();
    $result = $stavkaracuna->get_items_by_bill_id($bill_id);


    if ($result == null ) {
        echo '<div class="modal-header" style="position:relative">';
        echo '<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 10px; right:10px">&times;</button>';
        echo ' <h4 class="modal-title left">Pregled stavki računa</h4></div>';
        echo '<div class="modal-body">';
        echo '<p> Ovaj račun nema stavke. </p>';
        echo ' </div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
        echo '</div>';
    } else {
        echo '<div class="modal-header" style="position:relative">';
        echo '<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 10px; right:10px">&times;</button>';
        echo ' <h4 class="modal-title left">Račun ima ' . $result->num_rows . ' stavki</h4></div>';
        echo '<div class="modal-body">';
        echo '<div class="table-responsive">';
        echo '<table style="width: 100%;" class="table-bordered table-responsive table-striped">';
        echo '<tr>';
        echo '<th style="width: 8%;">#</th>';
        echo '<th style="width: 50%;">Naziv proizvoda</th>';
        echo '<th style="width: 15%;">Količina</th>';
        echo '<th style="width: 19%;">Cena</th>';
        echo '<th style="width: 25%;">Iznos</th>';
        echo '</tr>';
        $count = 1;
        while ($row = $result->fetch_object()) {
            echo '<tr>';
            echo '<td>' . $row ->RBStavke . '</td>';
            echo '<td>' . $row->Naziv . '</td>';
            echo '<td>' . $row->Kolicina . '</td>';
            echo '<td>' . $row->Cena . '</td>';
            echo '<td>' . $row->Iznos . '</td>';
            echo '</tr>';
            $count = $count + 1;
        }
        echo '</table >';
        echo '</div>';
        echo ' </div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
        echo '</div>';
    }

}
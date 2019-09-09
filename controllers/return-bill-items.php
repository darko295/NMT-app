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
        echo '<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 12px; right:15px">&times;</button>';
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
        echo ' <h4 class="modal-title left">Račun: '. $bill_id .', broj stavki: ' . $result->num_rows . '</h4></div>';
        echo '<div class="modal-body">';
        echo '<div class="table-responsive">';
        echo '<table id = "stavke-table" style="width: 100%;" class="table-bordered table-responsive table-hover">';
        echo '<tr>';
        echo '<th style="width: 8%;">#</th>';
        echo '<th style="width: 50%;">Naziv proizvoda</th>';
        echo '<th style="width: 15%;">Količina</th>';
        echo '<th style="width: 19%;">Cena</th>';
        echo '<th style="width: 25%;">Iznos</th>';
        echo '</tr>';

        while ($row = $result->fetch_object()) {
            echo '<tr id="'. $row -> RacunID .'-'.$row ->RBStavke .'">';
            echo '<td><div  id = "rb_stavke">' . $row ->RBStavke . '</div></td>';
            echo '<td><div  id = "naziv">' . $row->Naziv . '</div></td>';
            echo '<td><div class="row_data"  id = "kolicina">' . $row->Kolicina . '</div></td>';
            echo '<td><div  id = "cena">' . $row->Cena . '</div></td>';
            echo '<td><div  id = "iznos">' . $row->Iznos . '</div></td>';
            echo '<td><div><button class="btn btn-danger" onclick="obrisi_stavku(this.id)" id="'.'remove-'. $row -> RacunID .'-'.$row -> RBStavke .'">Obriši</button></div></td>';
            echo '</tr>';



        }
        echo '</table >';
        echo '</div>';
        echo ' </div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
        echo '</div>';
    }

}
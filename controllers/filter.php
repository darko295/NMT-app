<?php
session_start();

include "../class/racun.php";

global $racun;

if(isset($_GET["dt_from"]) & isset($_GET["dt_to"]) & isset($_GET["store"])) {
    $dt_from = $_GET["dt_from"];
    $dt_to = $_GET["dt_to"];
    $store = $_GET["store"];


    $racun = new racun();
    $result = $racun -> filter_bills($dt_from,$dt_to,$store);


    echo '<tr>';
    echo '<th>Račun ID</th>';
    echo '<th>Datum kreiranja</th>';
    echo '<th>Poslednje Ažuriranje</th>';
    echo '<th>Način plaćanja</th>';
    echo '<th>Ukupan iznos</th>';
    echo '</tr>';
                        
        while ($row = $result->fetch_object()) {       
                echo '<tr id="row-'. $row-> RacunID .'">';
                echo '<td>'. $row -> RacunID .'</td>';
                echo '<td>'. substr($row -> DatumKreiranja, 0, -3).'</td>';
                    
                if(is_null($row -> PoslednjeAzuriranje)){        
                    echo '<td> --- </td>';
                }else{ 
                    echo '<td>'. substr($row -> PoslednjeAzuriranje, 0, -3).'</td>';
                } 
                    echo "<td>".$row -> NacinPlacanja ."</td>";
                    echo "<td>". $row -> UkupanIznos. " din. </td>";

                    if($row -> Storniran == 1){

                    	echo "<td><button disabled id='storniraj-". $row-> RacunID ."' onclick='storniraj(this.id)' class='btn btn-warning'>Storniraj</button></td>";
                    	echo "<td><button id='obrisi-" . $row-> RacunID ."' onclick='obrisi(this.id)' class='btn btn-danger'>Obriši</button> </td>";

                    }else{ 

                    	echo "<td><button  id='storniraj-" . $row-> RacunID. "' onclick='storniraj(this.id)' class='btn btn-warning'>Storniraj</button></td>";
                   		echo "<td><button disabled id='obrisi-" . $row-> RacunID. "' onclick='obrisi(this.id)' class='btn btn-danger'>Obriši</button></td>";

                    } 
                    echo "<td><button type='button' id='prikazi-" . $row-> RacunID ."' onclick='prikazi_stavke(this.id)' class='btn btn-primary' data-toggle='modal'
                                data-target='#myModal'>Prikaži stavke</button>";
                    echo "</td>";
                    }
                   
                echo "</tr>";

    
}

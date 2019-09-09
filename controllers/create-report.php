<?php

session_start();

include "../class/racun.php";
global $racun;

include "../class/prodavnica.php";
global $prodavnica;

if(isset($_POST["dt_from"]) & isset($_POST["dt_to"]) & isset($_POST["store-filter"])) {
    $dt_from = $_POST["dt_from"];
    $dt_to = $_POST["dt_to"];
    $store = $_POST["store-filter"];


    $racun = new racun();
    
    $stats = $racun -> get_stats($dt_from,$dt_to,$store);


        require('../tfpdf.php');

        $pdf = new tFPDF();
        $pdf->AliasNbPages();
        $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $pdf->SetFont('DejaVu', '', 11);

        $pdf->AddPage();

        $pdf->SetFontSize(14);
        $pdf->Ln(5);
        $pdf->Cell(45,10,'',0,0,'C');
        $pdf->Cell(100,10,'Izveštaj o realizovanim transakcijama',1,0,'C');
        $pdf->Cell(45,10,'',0,0,'C');
        $pdf->Ln(25);
        $pdf->SetFontSize(11);

        if($store == 0){
            $store_name = "sve prodavnice";
        }else{
            $prodavnica = new prodavnica();
            $store_info = $prodavnica -> get_store_name_by_id($store);
            $store_name = "prodavnica ". $store_info -> fetch_object() -> Naziv;
        }

        $pdf->Cell(85,10,'Za period od '. str_replace("T", " ",$dt_from) .' do '. str_replace("T", " ",$dt_to) .'.',0,0,'L');
        
        $pdf->Ln(8);
        $pdf->Cell(85,10,'Posmatrani objekti: '. $store_name .'.',0,0,'L');
        $pdf->Ln(8);
        $pdf->Cell(85,10,'Izveštaj kreirao prodavac: '. $_SESSION["username"] .'.',0,0,'L');
        

        $pdf->SetFontSize(13);
        $pdf->Ln(25);
        $pdf->Cell(75,10,'',0,0,'C');
        $pdf->Cell(40,10,'Sumirani pregled',"B",0,'C');
        $pdf->Cell(75,10,'',0,0,'C');
        $pdf->SetFontSize(11);

        $pdf->Ln(15);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(30,8, '',0,0,'C');
        $pdf->Cell(3,8, '',"B",0,'C',true);
        $pdf->Cell(40,8, 'Način plaćanja',"RB",0,'L',true);
        $pdf->Cell(3,8, '',"B",0,'C',true);
        $pdf->Cell(3, 8, '', "B", 0, 'C',true);
        $pdf->Cell(35,8,'Transakcija', "B", 0, 'C',true);
        $pdf->Cell(8, 8, '', "RB", 0, 'C',true);
        $pdf->Cell(5, 8, '', "B", 0, 'C',true);
        $pdf->Cell(30, 8, 'Ukupan promet', "B", 0, 'C',true);
        $pdf->Cell(5, 8, '', "B", 0, 'C',true);
        $pdf->Ln(9);


        
        $brojac = 1;
        while ($row = $stats -> fetch_object()) {
            if ($brojac % 2 == 0) {
                $pdf->SetFillColor(230, 230, 230);
            } else {
                $pdf->SetFillColor(255, 255, 255);
            }
            $pdf->Cell(30,8, '',0,0,'R');
            $pdf->Cell(3,8, '',0,0,'C',true);
            $pdf->Cell(40,8, $row -> NacinPlacanja,"R",0,'L',true);
            $pdf->Cell(3,8, '',0,0,'C',true);
            $pdf->Cell(3, 8, '', 0, 0, 'C',true);
            $pdf->Cell(35,8,$row -> BrojTransakcija, 0, 0, 'C',true);
            $pdf->Cell(8, 8, '', "R", 0, 'C',true);
            $pdf->Cell(5, 8, '', 0, 0, 'C',true);
            $pdf->Cell(30, 8, $row -> Iznos.' din.', 0, 0, 'C',true);
            $pdf->Cell(5, 8, '', 0, 0, 'C',true);
            $pdf->Ln(9); 
            $brojac++;            
        }


        $category_stats = $racun -> get_best_selling_cat($dt_from,$dt_to,$store);

        $pdf->SetFontSize(13);
        $pdf->Ln(25);
        $pdf->Cell(55,10,'',0,0,'C');
        $pdf->Cell(80,10,'Pregled transakcija po kategorijama',"B",0,'C');
        $pdf->Cell(75,10,'',0,0,'C');
        $pdf->SetFontSize(11);

        $pdf->Ln(15);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(48,8, '',0,0,'C');
        $pdf->Cell(3,8, '',"B",0,'C',true);
        $pdf->Cell(40,8, 'Kategorija',"B",0,'L',true);
        $pdf->Cell(3,8, '',"B",0,'C',true);
        $pdf->Cell(3, 8, '', "B", 0, 'C',true);
        $pdf->Cell(35,8,'Prodata količina', "B", 0, 'C',true);
        $pdf->Cell(8, 8, '', "B", 0, 'C',true);
        $pdf->Ln(9);


        
        $brojac = 1;
        while ($row = $category_stats -> fetch_object()) {
            if ($brojac % 2 == 0) {
                $pdf->SetFillColor(230, 230, 230);
            } else {
                $pdf->SetFillColor(255, 255, 255);
            }
            $pdf->Cell(48,8, '',0,0,'R');
            $pdf->Cell(3,8, '',0,0,'C',true);
            $pdf->Cell(40,8, $row -> Kategorija,"R",0,'L',true);
            $pdf->Cell(3,8, '',0,0,'C',true);
            $pdf->Cell(3, 8, '', 0, 0, 'C',true);
            $pdf->Cell(35, 8, $row -> Kolicina, 0, 0, 'C',true);
            $pdf->Cell(8, 8, '', 0, 0, 'C',true);
            $pdf->Ln(9); 
            $brojac++;            
        }

        $pdf->AddPage();
        $pdf->SetFontSize(13);
        $pdf->Ln(10);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(70,10,'',0,0,'C');
        $pdf->Cell(50,10,'Pregled svih transakcija',"B",0,'C');
        $pdf->Cell(70,10,'',0,0,'C');
        $pdf->SetFontSize(11);


        $pdf->Ln(15);
        $pdf->Cell(5,8, '',"B",0,'C',true);
        $pdf->Cell(18,8, 'Račun ID',"B",0,'C',true);
        $pdf->Cell(3,8, '',"B",0,'C',true);
        $pdf->Cell(3, 8, '', "B", 0, 'C',true);
        $pdf->Cell(40,8,'Datum kreiranja', "B", 0, 'C',true);
        $pdf->Cell(8, 8, '', "B", 0, 'C',true);
        $pdf->Cell(30, 8, 'Način plaćanja', "B", 0, 'C',true);
        $pdf->Cell(12, 8, '', "B", 0, 'C', true);
        $pdf->Cell(20, 8, 'Iznos', "B", 0, 'C',true);
        $pdf->Cell(8, 8, '',"B", 0, 'C',true);
        $pdf->Cell(40,8,'Ažuriran', "B", 0, 'C',true);
        $pdf->Cell(3, 8, '', "B", 0, 'C', true);
        


        $result = $racun -> filter_bills($dt_from,$dt_to,$store);


        $pdf->Ln(9);
        $brojac = 1;
        while ($row = $result->fetch_object()) {
            if ($brojac % 2 == 0) {
                $pdf->SetFillColor(230, 230, 230);
            } else {
                $pdf->SetFillColor(255, 255, 255);
            }
            $pdf->Cell(5,10, '',0,0,'C', true);
            $pdf->Cell(18,10, $row-> RacunID,0,0,'C', true);
            $pdf->Cell(3,10, '',"R",0,'C',true);
            $pdf->Cell(3, 10, '', 0, 0, 'C', true);
            $pdf->Cell(40,10,substr($row-> DatumKreiranja, 0, -3), 0, 0, 'C', true);
            $pdf->Cell(8, 10, '', 0, 0, 'C', true);
            $pdf->Cell(30, 10, $row -> NacinPlacanja, 0, 0, 'C',true);
            $pdf->Cell(12, 10, '', 0, 0, 'C', true);
            $pdf->Cell(20, 10, $row-> UkupanIznos.' din.', 0, 0, 'C', true);
            $pdf->Cell(8, 10, '', 0, 0, 'C',true);
            if (is_null($row -> PoslednjeAzuriranje)) {
                $azuriran = "-";
            }else{
                $azuriran = substr($row -> PoslednjeAzuriranje, 0, -3);
            }
            $pdf->Cell(40,10,$azuriran, 0, 0, 'C',true);
             $pdf->Cell(3, 10, '', 0, 0, 'C', true);
            
            $pdf->Ln(10);

            $brojac++;
        }


        $pdf->Output('nmt-izvestaj-'.date("d-m-Y").'.pdf', 'I');
    }else{
        ?>
        <script> alert('Odaberite prodavnicu i željeni vremenski period!');
            window.location.href = "bill_preview.php";
        </script>

        <?php
    }

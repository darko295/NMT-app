<!DOCTYPE html>
<html lang="en">

<?php
session_start();

include "./class/racun.php";
$racun = new racun();

include "./class/prodavnica.php";
$prodavnica = new prodavnica();

if (isset($_SESSION['username'])) {
    $current = $_SESSION['username'];
}else{
    header("Location: login_page.php");
}
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Naša mala trgovina</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/css/style-bill-preview.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/js/bill_preview.js"></script>

    <script>
        function obrisi_stavku(btn_id)
        {
            var bill_id = btn_id.split("-")[1];
            var bill_item_id = btn_id.split("-")[2];
            var count = $('#stavke-table tr').length;
            count--;
            if(count === 1){
                $.ajax({
                    type: "GET",
                    url: "controllers/delete.php ",
                    data: {
                        bill_id: bill_id
                    },
                    success: function (data) {
                        if(data === "1"){
                            alert("Racun je uspesno obrisan!");
                            $("#row-"+bill_id).remove();
                            location.reload();
                        }else{
                            alert("Došlo je do greške prilikom brisanja računa!");
                        }
                    }
                });
            }else{
                $.ajax({
                    type: "GET",
                    url: "controllers/delete-bill-item.php ",
                    data: {
                        bill_id: bill_id,
                        bill_item_id:bill_item_id
                    },
                    success: function (data) {
                        if(data === "1"){
                            alert("Stavka "+bill_item_id+ " računa "+ bill_id +" je uspesno obrisana!");
                            $("#"+bill_id+"-"+bill_item_id).remove();

                        }else{
                            alert("Došlo je do greške prilikom brisanja računa!");
                        }
                    }
                });


            }


        }


        $(document).on('click', '.row_data', function(event)
        {
            event.preventDefault();

            //make div editable
            $(this).closest('div').attr('contenteditable', 'true');
            //add bg css
            $(this).addClass('bg-warning').css('padding','5px');

            $(this).focus();
        });

        $(document).on('focusout', '.row_data', function(event)
        {
            event.preventDefault();

            var row_id = $(this).closest('tr').attr('id');

            var row_div = $(this)
                .removeClass('bg-warning') //add bg css
                .css('padding','');

            var bill_id = row_id.split("-")[0];
            var bill_item_id = row_id.split("-")[1];
            var kolicina = $(this).closest('tr').find("td > #kolicina").html();
            var cena = $(this).closest('tr').find("td > #cena").html();
            var iznos = kolicina * cena;
            $(this).closest('tr').find("td > #iznos").html(iznos);

            $.ajax({
                type: "GET",
                url: "controllers/update-bill-item.php ",
                data: {
                    bill_id: bill_id,
                    bill_item_id:bill_item_id,
                    kolicina:kolicina,
                    iznos:iznos
                },
                success: function (data) {
                    if(data === "1"){
                        alert("Stavka "+bill_item_id+ " računa "+ bill_id +" je uspesno ažurirana!");

                    }else{
                        alert("Došlo je do greške prilikom ažuriranja računa!");
                    }
                }
            });


        });


    function filtriraj(){
        var store = $("#store-filter").val();
        var dt_from = $("#datetime-from").val();
        var dt_to = $("#datetime-to").val();
        dt_from = dt_from.replace("T", " ");
        dt_to = dt_to.replace("T", " ");
            
                 $.ajax({
                    type: "GET",
                    url: "controllers/filter.php ",
                    data: {
                        store: store,
                        dt_from: dt_from,
                        dt_to: dt_to
                    },
                    success: function (data) {
                        //if(data === "1"){
                            $("#pregled-racuna").html(data);
                            // $("#row-"+bill_id).remove();
                            // location.reload();
                        // }else{
                        //     alert("Došlo je do greške prilikom brisanja računa!");
                        // }
                    }
                });
    }

    function generisi_izvestaj(){
        var store = $("#store-filter").val();
        var dt_from = $("#datetime-from").val();
        var dt_to = $("#datetime-to").val();
        dt_from = dt_from.replace("T", " ");
        dt_to = dt_to.replace("T", " ");
            alert("tu sam");
                 $.ajax({
                    type: "GET",
                    url: "controllers/create-report.php ",
                    data: {
                        store: store,
                        dt_from: dt_from,
                        dt_to: dt_to
                    },
                    success: function (data) {
                        //if(data === "1"){
                            // $("#pregled-racuna").html(data);
                            // $("#row-"+bill_id).remove();
                            // location.reload();
                        // }else{
                        //     alert("Došlo je do greške prilikom brisanja računa!");
                        // }
                    }
                });
    }


    </script>


</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">Naša mala trgovina</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Novi račun
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Pregled računa</a>
                </li>

            </ul>
        </div>
        <?php
        if (isset($_SESSION['username'])) {
            ?>
            <ul class="nav navbar-nav navbar-right" style="padding-left: 10px">
                <li class="nav-item btn-group">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Zdravo <?php echo $current; ?>&nbsp;</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="controllers/logout.php"><span
                                class="glyphicon glyphicon-log-out"></span>&nbsp;Log
                            Out</a>
                    </div>
                </li>

            </ul>
        <?php } ?>
    </div>
</nav>



<div class="container">

    <div class="row">
        <div class="col-md-12 text-center">

            <h1 class="mt-5" style="padding-bottom: 10px;">Pregled računa:</h1>
<form id="center-window" action="controllers/create-report.php" method="post">
<div class="form-group row">

<?php
     $result = $prodavnica -> get_all_stores();
?>
<b><label for="store-filter" class="col-form-label filter-label">PRODAVNICA</label></b>
<select class="form-control" name="store-filter" id="store-filter">
    <option selected value="0">Sve radnje</option>
     <?php while ($row = $result -> fetch_object()){ ?>
          <option value="<?php echo $row-> ProdavnicaID; ?>"><?php echo $row-> Naziv; ?></option>
     <?php } ?>
</select>

    <?php
        error_reporting(0); 
        $min = $racun -> get_min_bill_date() -> fetch_object();
        $max = $racun -> get_max_bill_date() -> fetch_object();
        $min_formatted = substr(str_replace(" ", "T", $min -> min_dt), 0, -3);
        $max_formatted = substr(str_replace(" ", "T", $max -> max_dt), 0, -3);
        $max_selectable = date("Y-m-d H:i");
        $max_selectable = str_replace(" ", "T", $max_selectable);
    ?>

    <b><label for="datetime-local-input" class="col-form-label filter-label">OD</label></b>
    <input class="form-control filter-input" name="dt_from" type="datetime-local" value="<?php echo $min_formatted; ?>" id="datetime-from" min="<?php echo $min_formatted; ?>" >
    <b><label for="datetime-local-input" class="col-form-label filter-label">DO</label></b>
    <input class="form-control filter-input" name="dt_to" type="datetime-local" value="<?php echo $max_selectable; ?>" id="datetime-to" max ="<?php echo $max_selectable; ?>">
    <button type="button" class="btn btn-secondary filter-button" onclick="filtriraj()">Filtriraj</button>
    <button type="button" class="btn btn-danger filter-cancel"><i class="fas fa-times"></i></button>
    <button type="submit" class="btn btn-success report-button" >Generiši izveštaj</button>
</div>
</form>
            <?php
            $result = $racun -> get_all_bills();

            if ($result == null) {
                echo "<script> alert('Došlo je do greške prilikom komunikacije sa bazom, ponovo učitajte stranicu'); </script>";
            }
            if ($result->num_rows == 0) {
                echo "<script> alert('Lista računa je prazna.'); </script>";
            } else {

            ?>


            <table style="margin-top: 30px;" class="table table-striped" id="pregled-racuna">

                <tr>
                    <th>Račun ID</th>
                    <th>Datum kreiranja</th>
                    <th>Poslednje Ažuriranje</th>
                    <th>Način plaćanja</th>
                    <th>Ukupan iznos</th>

                </tr>
                        <?php
                            while ($row = $result->fetch_object()) {
                         ?>
                <tr id="<?php echo "row-" . $row->RacunID; ?>">

                    <td><?php echo $row -> RacunID; ?></td>
                    <td><?php echo substr($row -> DatumKreiranja, 0, -3); ?> </td>
                    <?php
                    if(is_null($row -> PoslednjeAzuriranje)){
                        ?>
                        <td><?php echo "---"; ?> </td>
                    <?php }else{ ?>
                        <td><?php echo substr($row -> PoslednjeAzuriranje, 0, -3); ?> </td>
                    <?php } ?>
                    <td><?php echo $row -> NacinPlacanja; ?></td>
                    <td><?php echo $row -> UkupanIznos. " din."; ?></td>

                    <?php
                    if($row -> Storniran == 1){
                    ?>

                    <td><button disabled id="<?php echo "storniraj-" . $row->RacunID; ?>" onclick="storniraj(this.id)" class="btn btn-warning">Storniraj</button></td>
                    <td><button id="<?php echo "obrisi-" . $row->RacunID; ?>" onclick="obrisi(this.id)" class="btn btn-danger">Obriši</button> </td>

                    <?php }else{ ?>

                    <td><button  id="<?php echo "storniraj-" . $row->RacunID; ?>" onclick="storniraj(this.id)" class="btn btn-warning">Storniraj</button></td>
                    <td><button disabled id="<?php echo "obrisi-" . $row->RacunID; ?>" onclick="obrisi(this.id)" class="btn btn-danger">Obriši</button></td>

                    <?php } ?>
                    <td><button type="button" id="<?php echo "prikazi-" . $row->RacunID; ?>" onclick="prikazi_stavke(this.id)" class="btn btn-primary" data-toggle="modal"
                                data-target="#myModal">Prikaži stavke</button>
                    </td>
                    <?php
                    }
                    ?>
                </tr>

            </table>
                <?php
            }
            ?>

        </div>
        
    </div>

<!--    MODAL    -->

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" id="table-div"></div>
            </div>
        </div>
    </div>


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
    $(function(){
    $("#myModal").on('hide.bs.modal', function () {
        var store = $("#store-filter").val();
        var dt_from = $("#datetime-from").val();
        var dt_to = $("#datetime-to").val();
        dt_from = dt_from.replace("T", " ");
        dt_to = dt_to.replace("T", " ");
            
                 $.ajax({
                    type: "GET",
                    url: "controllers/filter.php ",
                    data: {
                        store: store,
                        dt_from: dt_from,
                        dt_to: dt_to
                    },
                    success: function (data) {
                        //if(data === "1"){
                            $("#pregled-racuna").html(data);
                            // $("#row-"+bill_id).remove();
                            // location.reload();
                        // }else{
                        //     alert("Došlo je do greške prilikom brisanja računa!");
                        // }
                    }
                });
    });
    });

    $(".filter-cancel").on('click', function(){
        location.reload();
    });
</script>

</body>

</html>

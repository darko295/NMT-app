<!DOCTYPE html>
<html lang="en">

<?php
session_start();

include "./class/racun.php";
$racun = new racun();

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

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/js/bill_preview.js"></script>

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
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Pregled računa:</h1>
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
                    <th>Način plaćanja</th>
                    <th>Ukupan iznos</th>
                    <th>Storniraj</th>
                    <th>Obriši</th>
                    <th>Prikaži stavke</th>
                </tr>
                        <?php
                            while ($row = $result->fetch_object()) {
                         ?>
                <tr id="<?php echo "row-" . $row->RacunID; ?>">

                    <td><?php echo $row -> RacunID; ?></td>
                    <td><?php echo $row -> DatumKreiranja; ?> </td>
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
    <div class="container">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" id="table-div"></div>
            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

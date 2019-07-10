<!DOCTYPE html>
<html lang="en">

<?php
session_start();

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
    <link href="vendor/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .result p{
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }
        .result p:hover{
            background: #f2f2f2;
        }
    </style>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/js/index.js"></script>
<!--    <script type="text/javascript">-->
<!---->
<!--    </script>-->
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
          <li class="nav-item active">
            <a class="nav-link" href="#">Novi račun
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bill_preview.php">Pregled računa</a>
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

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Unos novog računa:</h1>
          <row  >
              <select style="margin-bottom: 20px; float: right; width: 20%;" class="form-control" name="nacin_placanja" id="nacin-placanja">
                  <option value="1" selected>Keš</option>
                  <option value="2">Kartica</option>
              </select>
          </row>
          <div class="form-group">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dynamic_field">
                          <tr id="row">
                              <td><input type="text" id="proizvod" name="pr" placeholder="Izaberi proizvod..." class="form-control name_list" /> <div class="result"></div></td>
                              <td><button type="button" name="add" id="add" class="btn btn-success">Nova stavka</button></td>
                          </tr>
                      </table>
                      <form name="bill-items" id="bill-items">
                      <table class="table table-bordered" id="dynamic_field_1"></table>
                      </form>
                      <button style="float: left; width: 63%;"  type="button" name="submit" id="submit" class="btn btn-info">Kreiraj račun</button>
                      <input disabled style="float: right; width: 36%;color: red; font-size: 20px" type="number" id="ukupan-iznos" name="ukupan-iznos" placeholder="Ukupan iznos" class="form-control name_list" />
                  </div>
          </div>



      </div>
    </div>
  </div>

<!--  <script>-->
<!---->
<!---->
<!---->
<!---->
<!--  </script>-->



  <!-- Bootstrap core JavaScript -->
<!--  <script src="vendor/jquery/jquery.min.js"></script>-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

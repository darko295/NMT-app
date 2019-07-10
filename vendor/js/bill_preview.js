function storniraj(btn_id) {
    var bill_id = btn_id.split("-");

    $.ajax({
        type: "GET",
        url: "controllers/cancel.php ",
        data: {
            bill_id: bill_id[1]
        },
        success: function (data) {
            if(data === "1"){
                alert("Racun je uspesno storniran!");
                $("#"+bill_id).attr('disabled', true);
                $("#obrisi-"+bill_id[1]).attr('disabled', false);
                location.reload();
            }else{
                alert("Racun je vec storniran!");
            }
        }
    });

}

function obrisi(btn_id) {
    var bill_id = btn_id.split("-");

    $.ajax({
        type: "GET",
        url: "controllers/delete.php ",
        data: {
            bill_id: bill_id[1]
        },
        success: function (data) {
            if(data === "1"){
                alert("Racun je uspesno obrisan!");
                $("#row-"+bill_id[1]).remove();
                location.reload();
            }else{
                alert("Došlo je do greške prilikom brisanja računa!");
            }
        }
    });

}

function prikazi_stavke(btn_id) {
    var bill_id = btn_id.split("-");

    $.ajax({
        type: "GET",
        url: "controllers/return-bill-items.php ",
        data: {
            bill_id: bill_id[1]
        },
        success: function (data) {
            if (data !== "0") {

                $("#table-div").show();
                $("#table-div").html(data);
            } else {
                alert(data);
            }
        }
    });


}
$(document).ready(function(){

    $('tr input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var term = $(this).val();

        // var resultDropdown = $(this).siblings(".result");


        $.ajax({
            type: "GET",
            url: "controllers/product-search.php ",
            data: {
                term: term,
                type:"name",
            },
            success: function (data) {

                $(".result").html(data);

            }
        });





    });

    // Set search input value on click of result item
    $(document).on("click", ".result > p", function(){
        var text = $(this).text();

        $("#proizvod").val($(this).text());
        $(this).parent(".result").empty();
    });
});



// drugi deo

$(document).ready(function(){
    var i=0;
    $('#add').click(function(){
        var product = $("#proizvod").val();
        if(product === "" || product == null){
            alert("Prethodno morate odabrati proizvod!");
            return;
        }//else{

        rb_stavke = i;
        rb_stavke++;
        if (rb_stavke === 6){
            alert("Maksimalno je moguce dodati 5 stavki po racunu!");
            return;
        }

        if (i > 0){
            for (j = 1; j <= i; j++){
                var proizvod = $("#proizvod"+j).val();
                var cena = $("#cena"+j).val();
                var kolicina = $("#kolicina"+j).val();
                var iznos = $("#iznos"+j).val();
                if(proizvod === "" || cena === "" || kolicina === "" || iznos === ""){
                    alert("Sva polja za prethodnu stavku moraju biti popunjena!");
                    return;
                }
            }
        }




        $.ajax({
            type: "GET",
            url: "controllers/product-search.php ",
            data: {
                type:"name",
                product: product
            },
            success: function (data) {
                if(data === "0"){
                    alert("Prethodno morate odabrati proizvod!");
                }else{

                    var vals = JSON.parse(data);

                    i++;
                    $('#dynamic_field_1').append('<tr id="row'+i+'">' +
                        '<td><input type="text" id="proizvod'+i+'" name="proizvod'+i+'" placeholder="Proizvod" class="form-control name_list" /></td>' +
                        '<td><input type="number" min="0" id="kolicina'+i+'" name="kolicina'+i+'" placeholder="Kolicina" class="form-control name_list" /></td>' +
                        '<td><input id="cena'+i+'" readonly  type="number" name="cena'+i+'" placeholder="Cena" class="form-control name_list" /></td>' +
                        '<td><input  type="number" readonly id="iznos'+i+'" name="iznos'+i+'" placeholder="Iznos" class="form-control name_list" /></td>' +
                        '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
                    $("#proizvod"+i).val(vals.Naziv);
                    $("#cena"+i).val(vals.Cena);
                    $("#proizvod").val("");
                    $("#proizvod"+i).attr('readonly', true);
                }
            }
        });


    });

    $(document).on('change', '#kolicina1', function(){
        var cena = $("#cena1").val();
        var kolicina = $(this).val();
        var iznos = cena * kolicina;

        $('#iznos1').val(iznos);

        if (i > 0){
            var ukupan_iznos = 0;
            for (j = 1; j <= i; j++){
                var iznos_stavke = $("#iznos"+j).val();
                iznos_stavke = parseInt(iznos_stavke);
                ukupan_iznos = ukupan_iznos + iznos_stavke;
            }
            $("#ukupan-iznos").val(ukupan_iznos);
        }



    });
    $(document).on('change', '#kolicina2', function(){
        var cena = $("#cena2").val();
        var kolicina = $(this).val();
        var iznos = cena * kolicina;

        $('#iznos2').val(iznos);

        if (i > 0){
            var ukupan_iznos = 0;
            for (j = 1; j <= i; j++){
                var iznos_stavke = $("#iznos"+j).val();
                iznos_stavke = parseInt(iznos_stavke);
                ukupan_iznos = ukupan_iznos + iznos_stavke;
            }
            $("#ukupan-iznos").val(ukupan_iznos);
        }

    });
    $(document).on('change', '#kolicina3', function(){
        var cena = $("#cena3").val();
        var kolicina = $(this).val();
        var iznos = cena * kolicina;

        $('#iznos3').val(iznos);

        if (i > 0){
            var ukupan_iznos = 0;
            for (j = 1; j <= i; j++){
                var iznos_stavke = $("#iznos"+j).val();
                iznos_stavke = parseInt(iznos_stavke);
                ukupan_iznos = ukupan_iznos + iznos_stavke;
            }
            $("#ukupan-iznos").val(ukupan_iznos);
        }

    });
    $(document).on('change', '#kolicina4', function(){
        var cena = $("#cena4").val();
        var kolicina = $(this).val();
        var iznos = cena * kolicina;

        $('#iznos4').val(iznos);

        if (i > 0){
            var ukupan_iznos = 0;
            for (j = 1; j <= i; j++){
                var iznos_stavke = $("#iznos"+j).val();
                iznos_stavke = parseInt(iznos_stavke);
                ukupan_iznos = ukupan_iznos + iznos_stavke;
            }
            $("#ukupan-iznos").val(ukupan_iznos);
        }

    });
    $(document).on('change', '#kolicina5', function(){
        var cena = $("#cena5").val();
        var kolicina = $(this).val();
        var iznos = cena * kolicina;

        $('#iznos5').val(iznos);

        if (i > 0){
            var ukupan_iznos = 0;
            for (j = 1; j <= i; j++){
                var iznos_stavke = $("#iznos"+j).val();
                iznos_stavke = parseInt(iznos_stavke);
                ukupan_iznos = ukupan_iznos + iznos_stavke;
            }
            $("#ukupan-iznos").val(ukupan_iznos);
        }

    });


    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
        var iznos = $('#iznos'+i).val();
        var uk_iznos = $('#ukupan-iznos').val();
        uk_iznos = uk_iznos - iznos;
        $('#ukupan-iznos').val(uk_iznos);
        i--;
    });

    $('#submit').click(function(){
        var total = $("#ukupan-iznos").val();
        if(total === ""){
            alert("Morate dodati barem jednu stavku!");
            return;
        }
        var payment_option = $("#nacin-placanja").val();
        console.log($("#bill-items").serializeArray());
        $.ajax({
            url:"controllers/insert-bill.php",
            method:"POST",
            data:{
                stavke :$('#bill-items').serializeArray(),
                total: total,
                payment_option:payment_option
            },
            success:function(data)
            {
                alert(data);
                $('#bill-items').trigger("reset");
                $('#1').trigger('click');
                $('#2').trigger('click');
                $('#3').trigger('click');
                $('#4').trigger('click');
                $('#5').trigger('click');
                $('#ukupan-iznos').val("");
            }
        });
    });

});
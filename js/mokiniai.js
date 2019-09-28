// window.addEventListener("click", event => {
//     zymetiTintiMygtuka();
// });
//
// function zymetiTintiMygtuka() {
//     data = $('#klases').serializeArray();
//     if (data.length > 0) {
//         let reiksme = data[0];
//         $('#trinti').prop('disabled', false);
//         $('#prideti').prop('disabled', true);
//         if (reiksme['name'] === 'newclass') {
//             $('#trinti').prop('disabled', true);
//             $('#prideti').prop('disabled', true);
//         }
//     } else {
//         $('#trinti').prop('disabled', true);
//         $('#prideti').prop('disabled', false);
//     }
// }

$(document).ready(function () {
    let name_by_id = $('#saugotimokini').attr('data-klase');
    $.get('index.php?action=visimokiniai&name='+name_by_id, function (data) {
        console.log(data);
        let as = JSON.parse(data);
        let i;
        for (i = 0; i < as.length; i++) {
            let masyvas = as[i];
            $('#appending').append('<div class="eilute K' + masyvas['id'] + '"><div class="turinys turinioplotis"><input type="checkbox"  name="' + masyvas['id'] + '" id="' + masyvas['mokinio_aprasymas'] +
                '" value="' + masyvas['mokinys'] + ' ">' + '<a href="index.php?action=mokiniopasirinkimas&name=' + masyvas['id'] + '" id="' + masyvas['id'] +
                '">' + masyvas['mokinys'] + '</a></div><div class="turinys"><span class="trinimui"><a href="index.php?action=trintiklase&name=' + masyvas['id'] +
                '">Trinti</a></span></div></div>');
            $('#saugoti').prop('disabled', true);
            $('#trinti').prop('disabled', true);
        }
    });
});

// $('#trinti').click(function () {
// let data;
//     data = $('#klases').serializeArray();
//     let visi_id = [];
//     let i, vardas;
//     for (i = 0; i < data.length; i++) {
//         let masyvas = data[i];
//         visi_id.push({'id': masyvas['name']});
//         vardas = '.K' + masyvas['name'];
//         $(vardas).remove();
//     }
//     visi_id = JSON.stringify(visi_id);
//     $.post('index.php?action=trintiklases', visi_id);
// });



/////////////////////////////////
function setJson() {
    let name_by_id = $('#saugotimokini').attr('data-klase');
    $.post('index.php?action=enteringmokiniai&name='+name_by_id, jsonData, function (data) {
        data = JSON.parse(data);
            if (c_name.length < 50) {
            if (data.zinute === 'OK') {
                $('.eilute:last-child').replaceWith('<div class="eilute K' + data.id + '"><div class="turinys turinioplotis"><input type="checkbox"  name="'
                    + data.id + '" id="' + c_text + ' " value="' + c_name + ' " >' + '<a href="index.php?action=mp_sarasas&name=' + data.id + '" id="' + data.id +
                    '">' + c_name + '</a></div><div class="turinys"><span class="trinimui" ><a href="index.php?action=trintiklase&name=' + data.id +
                    '" class="trinimo">Trinti</a></span></div></div>');
                $('#saugotimokini').prop('disabled', true);
                $('#pridetimokini').prop('disabled', false);
            } else {
                Alert.render(data.zinute);
            }
        } else {
            Alert.render('Per didelis simbolių kiekis įvedimo lauke!');
            $('#addnewclass').val('');
        }
    })
}

$('#pridetimokini').click(function () {
    $('#appending').append('<div class="eilute "><div class="turinys turinioplotis"><input type="checkbox" name="checkclass" value="unnamed">' +
        '<input type="text" name="newclass" id="addnewclass" size="29em"></div></div>');
    $('#pridetimokini').prop('disabled', true);
    $('#saugotimokini').prop('disabled', false);
});

$('#saugotimokini').click(function () {
    setData();
    createJson();
    setJson();
});
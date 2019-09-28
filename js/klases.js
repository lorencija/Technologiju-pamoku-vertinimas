window.addEventListener("click", event => {
    zymetiTintiMygtuka();
});

function zymetiTintiMygtuka() {
    let data;
    data = $('#klases').serializeArray();
    if (data.length > 0) {
        let reiksme = data[0];
        $('#trinti').prop('disabled', false);
        $('#prideti').prop('disabled', true);
        if (reiksme['name'] === 'newclass') {
            $('#trinti').prop('disabled', true);
            $('#prideti').prop('disabled', true);
        }
    } else {
        $('#trinti').prop('disabled', true);
        $('#prideti').prop('disabled', false);
    }
}

$(document).ready(function () {
    $.get('index.php?action=visosklases', function (data) {
        let as = JSON.parse(data);
        let i;
        for (i = 0; i < as.length; i++) {
            let masyvas = as[i];
            $('#appending').append('<div class="eilute K' + masyvas['id'] + '"><div class="turinys turinioplotis"><input type="checkbox"  name="' + masyvas['id'] + '" id="' + masyvas['klases_aprasymas'] +
                '" value="' + masyvas['klase'] + ' ">' + '<a href="index.php?action=mp_sarasas&name=' + masyvas['id'] + '" id="' + masyvas['id'] +
                '">' + masyvas['klase'] + '</a></div><div class="turinys"><span class="trinimui"><a href="index.php?action=trintiklase&name=' + masyvas['id'] +
                '">Trinti</a></span></div></div>');
            $('#saugoti').prop('disabled', true);
            $('#trinti').prop('disabled', true);
        }
    });
});

function setJson() {
    $.post('index.php?action=entering', jsonData, function (data) {
        data = JSON.parse(data);
        if (c_name.length < 50) {
            if (data.zinute === 'OK') {
                $('.eilute:last-child').replaceWith('<div class="eilute K' + data.id + '"><div class="turinys turinioplotis"><input type="checkbox"  name="'
                    + data.id + '" id="' + c_text + ' " value="' + c_name + ' " >' + '<a href="index.php?action=mp_sarasas&name=' + data.id + '" id="' + data.id +
                    '">' + c_name + '</a></div><div class="turinys"><span class="trinimui" ><a href="index.php?action=trintiklase&name=' + data.id +
                    '" class="trinimo">Trinti</a></span></div></div>');
                $('#saugoti').prop('disabled', true);
                $('#prideti').prop('disabled', false);
            } else {
                Alert.render(data.zinute);
            }
        } else {
            Alert.render('Per didelis simbolių kiekis įvedimo lauke!');
            $('#addnewclass').val('');
        }
    })
}

$('#trinti').click(function () {
    data = $('#klases').serializeArray();
    let visi_id = [];
    let i, vardas;
    for (i = 0; i < data.length; i++) {
        let masyvas = data[i];
        visi_id.push({'id': masyvas['name']});
        vardas = '.K' + masyvas['name'];
        $(vardas).remove();
    }
    visi_id = JSON.stringify(visi_id);
    $.post('index.php?action=trintiklases', visi_id);
});

$('#prideti').click(function () {
    $('#appending').append('<div class="eilute "><div class="turinys turinioplotis"><input type="checkbox" name="checkclass" value="unnamed">' +
        '<input type="text" name="newclass" id="addnewclass" size="29em"></div></div>');
    $('#prideti').prop('disabled', true);
    $('#saugoti').prop('disabled', false);
});

$('#saugoti').click(function () {
    setData();
    createJson();
    setJson();
});

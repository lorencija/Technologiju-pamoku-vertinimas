window.addEventListener("click", event => {
    zymetiTintiMygtuka();
});

function zymetiTintiMygtuka() {
    data = $('#klases').serializeArray();
    console.log(data);
    if (data.length > 0) {
        let reiksme = data[0];
        $('#trintimokini').prop('disabled', false);
        $('#pridetimokini').prop('disabled', true);
        $('#redaguotimokini').prop('disabled', true);
        if (reiksme['name'] === 'newclass') {
            $('#trintimokini').prop('disabled', true);
            $('#pridetimokini').prop('disabled', true);
        }
        if (data.length === 1) {
            if (reiksme['name'] === 'newclass') {
                $('#redaguotimokini').prop('disabled', true);
            } else {
                $('#redaguotimokini').prop('disabled', false);
            }
        }
    } else {
        $('#trintimokini').prop('disabled', true);
        $('#pridetimokini').prop('disabled', false);
        $('#redaguotimokini').prop('disabled', true);
    }
}

$(document).ready(function () {
    let name_by_id = $('#saugotimokini').attr('data-klase');
    $.get('index.php?action=visimokiniai&name=' + name_by_id, function (data) {

        let as = JSON.parse(data);
        let i;
        for (i = 0; i < as.length; i++) {
            let masyvas = as[i];
            $('#appending').append('<div class="eilute K' + masyvas['id'] + '"><div class="turinys turinioplotis"><input type="checkbox"  name="' + masyvas['id'] + '" id="' + masyvas['mokinio_aprasymas'] +
                '" value="' + masyvas['mokinys'] + ' ">' + '<a href="index.php?action=mokiniopasirinkimas&name=' + masyvas['id'] + '&klase='+name_by_id+'" id="' + masyvas['id'] +
                '">' + masyvas['mokinys'] + '</a></div><div class="turinys">' +
               '<span class="trinimui"><a href="index.php?action=trintimokini&name='+ masyvas['id'] + '&klase='+name_by_id+'">Trinti</a></span></div></div>');
            $('#saugotimokini').prop('disabled', true);
            $('#trintimokini').prop('disabled', true);
            $('#redaguotimokini').prop('disabled', true);
        }
    });
});
// '<span class="trinimui"><a href="index.php?action=redaguotimokini1&name=' +name_by_id+'&id'+ masyvas['id'] +
// '&value'+ masyvas['mokinys'] +'&value1'+ masyvas['mokinio_aprasymas'] +'">Redaguoti</a></span>'+
// '<span class="trinimui"><a href="index.php?action=redaguotimokini&name=' +name_by_id+'&id'+ masyvas['id'] + '">Redaguoti</a></span>'

$('#trintimokini').click(function () {
    let data;
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
    $.post('index.php?action=trintimokinius', visi_id);
});

$('#redaguotimokini').click(function () {
    let data;
    data = $('#klases').serializeArray();
    let editt_id = data[0];
    select = '.K' + editt_id['name'];
    $(select).replaceWith('<div class="eilute redaguoti" data-value="' + editt_id['name'] + '"><div class="turinys turinioplotis"><input type="checkbox" name="checkclass" value="unnamed">' +
        '<input type="text" name="newclass" id="addnewclass" size="28em"></div></div>');
    $('#addnewclass').val(editt_id['value']);
    $('#pridetimokini').prop('disabled', true);
    $('#saugotimokini').prop('disabled', false);
    $('#redaguotimokini').prop('disabled', true);
});

function isvestiSaugomaReiksme(data,select) {
    data = JSON.parse(data);
    if (c_name.length < 50) {
        if (data.zinute === 'OK') {
            $(select).replaceWith('<div class="eilute K' + data.id + '"><div class="turinys turinioplotis"><input type="checkbox"  name="'
                + data.id + '" id="' + c_text + ' " value="' + c_name + ' " >' + '<a href="index.php?action=mokiniopasirinkimas&name=' + data.id + '" id="' + data.id +
                '">' + c_name + '</a></div><div class="turinys"><span class="trinimui" ><a href="index.php?action=trintimokini&name=' + data.id +
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
}
function setJson() {
    let name_by_id = $('#saugotimokini').attr('data-klase');
    let eddit_id = $('.redaguoti').attr('data-value');
    if (eddit_id > 0) {
        $.post('index.php?action=redaguotimokini&name=' + name_by_id + '&id=' + eddit_id, jsonData, function (data) {
            isvestiSaugomaReiksme(data,'.redaguoti');
        })
    } else {
        $.post('index.php?action=enteringmokiniai&name=' + name_by_id, jsonData, function (data) {
            isvestiSaugomaReiksme(data,'.eilute:last-child');
        })
    }

}

$('#pridetimokini').click(function () {
    $('#appending').append('<div class="eilute "><div class="turinys turinioplotis"><input type="checkbox" name="checkclass" value="unnamed">' +
        '<input type="text" name="newclass" id="addnewclass" size="28em"></div></div>');
    $('#pridetimokini').prop('disabled', true);
    $('#saugotimokini').prop('disabled', false);
});

$('#saugotimokini').click(function () {
    setData();
    createJson();
    setJson();
});

http://projektas/index.php?action=mp_sarasas&name=4

    $('#atgal').click(function () {
        let name_by_id = $('#atgal').attr('data-klase');
           window.open('index.php?action=mp_sarasas&name=' + name_by_id, '_self');
    });
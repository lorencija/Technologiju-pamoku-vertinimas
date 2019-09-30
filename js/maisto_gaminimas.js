window.addEventListener("click", event => {
    zymetiTintiMygtuka();
});

function zymetiTintiMygtuka() {
    data = $('#klases').serializeArray();
    if (data.length > 0) {
        let reiksme = data[0];
        $('#trintipamoka').prop('disabled', false);
        $('#pridetipamoka').prop('disabled', true);
        $('#redaguotipamoka').prop('disabled', true);
        if (reiksme['name'] === 'newclass') {
            $('#trintipamoka').prop('disabled', true);
            $('#pridetipamoka').prop('disabled', true);
        }
        if (data.length === 1) {
            if (reiksme['name'] === 'newclass') {
                $('#redaguotipamoka').prop('disabled', true);
            } else {
                $('#redaguotipamoka').prop('disabled', false);
            }
        }
    } else {
        $('#trintipamoka').prop('disabled', true);
        $('#pridetipamoka').prop('disabled', false);
        $('#redaguotipamoka').prop('disabled', true);
    }
}

$(document).ready(function () {
    let name_by_id = $('#saugotipamoka').attr('data-klase');
    $.get('index.php?action=visosgaminimopamokos&name=' + name_by_id, function (data) {
        let as = JSON.parse(data);
        let i;
        for (i = 0; i < as.length; i++) {
            let masyvas = as[i];
                       $('#appending').append('<div class="eilute K' + masyvas['id'] + '"><div class="turinys turinioplotis"><input type="checkbox"  name="' + masyvas['id'] + '" id="' + masyvas['pamoka'] +
                '" value="' + masyvas['pamoka'] + ' ">' + '<a href="index.php?action=maistopasirinkimas&pamoka='+masyvas['id']+'&name=' + name_by_id + '" id="' + masyvas['id'] +
                '">' + masyvas['pamoka'] + '</a></div><div class="turinys">' +
                '<span class="trinimui"><a href="index.php?action=trintiMaistoPamoka&pamoka='+masyvas['id']+'&name=' + name_by_id+ '">Trinti</a></span></div></div>');
            $('#saugotipamoka').prop('disabled', true);
            $('#trintipamoka').prop('disabled', true);
            $('#redaguotipamoka').prop('disabled', true);
        }
    });
});

$('#trintipamoka').click(function () {
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
    $.post('index.php?action=trintiMaistoPamokas', visi_id);
});

$('#redaguotipamoka').click(function () {
    let data;
    data = $('#klases').serializeArray();
    let editt_id = data[0];
    select = '.K' + editt_id['name'];
    $(select).replaceWith('<div class="eilute redaguoti" data-value="' + editt_id['name'] + '"><div class="turinys turinioplotis"><input type="checkbox" name="checkclass" value="unnamed">' +
        '<input type="text" name="newclass" id="addnewclass" size="28em"></div></div>');
    $('#addnewclass').val(editt_id['value']);
    $('#pridetipamoka').prop('disabled', true);
    $('#saugotipamoka').prop('disabled', false);
    $('#redaguotipamoka').prop('disabled', true);
});

function isvestiSaugomaReiksme(data, select) {
    let name_by_id = $('#saugotipamoka').attr('data-klase');
     data = JSON.parse(data);
    if (c_name.length < 50) {
        if (data.zinute === 'OK') {
            $(select).replaceWith('<div class="eilute K' + data.id + '"><div class="turinys turinioplotis"><input type="checkbox"  name="'
                + data.id + '" id="' + c_text + ' " value="' + c_name + ' " >' + '<a href="index.php?action=maistopasirinkimas&pamoka='+data.id+'&name=' + name_by_id +  '" id="' + data.id +
                '">' + c_name + '</a></div><div class="turinys"><span class="trinimui" ><a href="index.php?action=trintiMaistoPamoka&name=' + data.id +
                '" class="trinimo">Trinti</a></span></div></div>');
            $('#saugotipamoka').prop('disabled', true);
            $('#pridetipamoka').prop('disabled', false);
        } else {
            Alert.render(data.zinute);
        }
    } else {
        Alert.render('Per didelis simbolių kiekis įvedimo lauke!');
        $('#addnewclass').val('');
    }
}

function setJson() {
    let name_by_id = $('#saugotipamoka').attr('data-klase');
    let eddit_id = $('.redaguoti').attr('data-value');
    if (eddit_id > 0) {
        $.post('index.php?action=redaguotiMaistoPamoka&name=' +name_by_id+ '&id=' + eddit_id, jsonData, function (data) {
            isvestiSaugomaReiksme(data, '.redaguoti');
        })
    } else {
        $.post('index.php?action=enteringMaistoPamokos&name=' + name_by_id, jsonData, function (data) {
            isvestiSaugomaReiksme(data, '.eilute:last-child');
        })
    }

}

$('#pridetipamoka').click(function () {
    $('#appending').append('<div class="eilute "><div class="turinys turinioplotis"><input type="checkbox" name="checkclass" value="unnamed">' +
        '<input type="text" name="newclass" id="addnewclass" size="28em"></div></div>');
    $('#pridetipamoka').prop('disabled', true);
    $('#saugotipamoka').prop('disabled', false);
});

$('#saugotipamoka').click(function () {
    setData();
    createJson();
    setJson();
});

$('#atgal').click(function () {
    let name_by_id = $('#atgal').attr('data-klase');
    window.open('index.php?action=pamokos&name=' + name_by_id, '_self');
});
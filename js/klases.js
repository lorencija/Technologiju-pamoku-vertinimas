let c_name, c_text, jsonData;

$(document).ready(function () {
    $.get('index.php?action=visosklases', function (data) {
        let as = JSON.parse(data);
        let i;
        for (i = 0; i < as.length; i++) {
            let masyvas = as[i];
            $('#appending').append('<p><input type="checkbox"  name="' + masyvas['id'] + '" id="' + masyvas['klases_aprasymas'] +
                '" value="' + masyvas['klases_aprasymas'] +
               ' " >'+
                 '<a href="index.php?action=mp_sarasas&name=' + masyvas['klases_aprasymas'] + '" id="' + masyvas['klases_aprasymas'] +
                '">' + masyvas['klase'] + '</a><button><a href="index.php?action=trintiklase&name=' + masyvas['id'] +
                '">Trinti</a></button></p>');
            $('#saugoti').prop('disabled', true);
        }
    });
});

// '" onclick="perduotiparametra()" >'+


$('#trinti').click(function () {
    data = $('#klases').serializeArray();
    visi_id=[];
    let i;
    for (i = 0; i <data.length; i++){
        let masyvas = data[i];
        visi_id.push({'id': masyvas['name']});
}
    visi_id=JSON.stringify(visi_id);
    console.log(visi_id);
    $.post('index.php?action=trintiklases',visi_id);
});

$('#prideti').click(function () {
    $('#appending').append('<p><input type="checkbox" name="checkclass" value="unnamed">' +
        '<input type="text" name="newclass" id="addnewclass" size="38em"></p>');
    $('#prideti').prop('disabled', true);
    $('#saugoti').prop('disabled', false);
});

function setData() {
    c_name = $('#addnewclass').val();
    c_text = nameFromEntering(c_name);
}

function createJson() {
    jsonData = {
        classname: c_name,
        classtext: c_text
    };
}

function nameFromEntering(class_name) {
    return class_name.replace(' ', '');
}

function setJson() {
    $.post('index.php?action=entering', jsonData, function () {
        $('p:last-child').html('<input type="checkbox" name="checkclass" value="' + c_text + '">' +
            '<a href="index.php?action=mp_sarasas&name=' + c_text + '" id="' + c_text + '">' + c_name + '</a>');
    })
}

$('#saugoti').click(function () {
    setData();
    createJson();
    setJson();
    $('#prideti').prop('disabled', false);
    $('#saugoti').prop('disabled', true);

});


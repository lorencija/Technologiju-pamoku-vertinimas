$('#pridetimokini').click(function () {
    $('#appending').append('<p><input type="checkbox" name="checkclass" value="unnamed">' +
        '<input type="text" name="newclass" id="addnewclass" size="38em"></p>');
    $('#pridetimokini').prop('disabled', true);
    $('#saugotimokini').prop('disabled', false);
});

function setData() {
    c_name = $('#addnewclass').val();
    c_text = nameFromEntering(c_name);
}
function nameFromEntering(class_name) {
    return class_name.replace(' ', '');
}

function createJson() {
    jsonData = {
        studentname: c_name,
        studenttext: c_text
    };
}
function setJson() {
    let name_by_id = $('#saugotimokini').attr('data-klase');
    $.post('index.php?action=enteringmokiniai&name='+name_by_id, jsonData, function () {
        $('p:last-child').html('<input type="checkbox" name="checkclass" value="' + c_text + '">' + c_name );
    })
}

$('#saugotimokini').click(function () {
    setData();
    createJson();
    setJson();

});
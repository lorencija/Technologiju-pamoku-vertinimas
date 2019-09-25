let c_name, c_text, jsonData, id_by_class;

$(document).ready(function () {
    $.get('index.php?action=skaityti', function (data) {
       let as = JSON.parse(data);
       let i;
     for (i=0;i<as.length;i++){
         let masyvas=as[i];
         $('#appending').append('<p><input type="checkbox" name="'+masyvas['ID']+'" value="'+masyvas['klases_aprasymas']+'">' +
             '<a href="index.php?action=skaityti&name=' + masyvas['klase'] + '" id="' + masyvas['klases_aprasymas'] +
             '">' + masyvas['klase'] + '</a></p>' );
     }

    });
});


$('#prideti').click(function () {
    $('#appending').append('<p><input type="checkbox" name="checkclass" value="unnamed">' +
        '<input type="text" name="newclass" id="addnewclass" size="38em"></p>');
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
        // $('p:last-child').html('<input type="checkbox" name="checkclass" value="'+c_text+'">' +
        //     '<span id="' + c_text +
        //     '" class="rastiklasesID">' + c_name + '</span>');

        $('p:last-child').html('<input type="checkbox" name="checkclass" value="u' + c_text + '">'+
            '<a href="index.php?action=skaityti&name=' + c_name + '" id="' + c_text + '">' + c_name + '</a>');
    })

}

$('#saugoti').click(function () {
    setData();
    createJson();
    setJson();
});


$(document).ready(function () {
    $('p').click(function(){
       // alert($(this).index());
    });
});






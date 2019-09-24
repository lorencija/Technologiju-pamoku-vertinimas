// $(document).ready(function(){
//
// });

let c_name, c_text, jsonData;

$('#prideti').click(function(){
    $('#appending').append('<p><input type="checkbox" name="checkclass" value="unnamed"> ' +
        '<input type="text" name="newclass" id="addnewclass" size="38em"></p>');
});

function setData() {
    c_name = $('#addnewclass').val();
    c_text=nameFromEntering(c_name);
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
    $.post('entering.php', jsonData, function (data) {

       // $('p:last-child').html(data);
        $('p:last-child').html('<a href="entering.php" id="'+c_text+'">'+c_name+'</a>');
            })

}


// function setJsonData() {
//     $.ajax({
//         url: 'entering.php',
//         dataType: 'json',
//         type: 'POST',
//         data: jsonData,
//         success: function (data) {
//                          alert('duomenys gauti  '+data.classname);
//            }
//         // failure:function (data) {
//         //     if (!data.success){
//         //         alert('negerai');
//         //     }
//         // }
//     });
// }

$('#saugoti').click(function(){
    setData();
    createJson();
    setJson();
    // $('p:last-child').html('<a href="types.php" id="'+c_text+'">'+c_name+'</a>');
});


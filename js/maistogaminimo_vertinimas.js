let p1, p2, p3, p4, p5, p6, p1_val, p2_val, p3_val, p4_val, p5_val, p6_val, jsonData1, zinute, vykdyti;
let pamokos_id = $('#saugotipamoka').attr('data-pamoka');
let klases_id = $('#saugotipamoka').attr('data-klase');

function showhid(containerName) {
    select = '#' + containerName;
    $(select).toggle();
}

$('#atgal').click(function () {
    let name_by_id = $('#atgal').attr('data-klase');
    window.open('index.php?action=maisto_gaminimas&name=' + name_by_id, '_self');
});

$(document).ready(function () {
    $.get('index.php?action=gautimokinius&klase=' + klases_id, function (data) {
        let as = JSON.parse(data);
        let i;
        for (i = 0; i < as.length; i++) {
            let mas = as[i];

            $('#appending').append(
                '<div id="M'+ mas['id']+'" class="eilute"><div class="column"  onclick="showhid('+ mas['id']+');">'
            + mas['mokinys']+'</div><div id="'+ mas['id']+'" class="containerTab"><div class="containerElement"><div class="myselect">'+
                '<label for="M'+ mas['id']+'p1" class="headerselection">Pasiruošimas pamokai</label>'+
            '<select id="M'+ mas['id']+'p1" size="2"><option class="elem" value="nera">N</option><option class="elem" value="nulis">0</option><option class="elem" value="vienas">1</option><option class="elem" value="puse">0.5</option></select></div>'+
                '<div class="myselect"><label for="M'+ mas['id']+'p2" class="headerselection">Technologiniai procecai</label>'+
            '<select id="M'+ mas['id']+'p2" size="2"><option class="elem" value="nera">N</option><option class="elem" value="nulis">0</option><option class="elem" value="vienas">1</option><option class="elem" value="puse">0.5</option></select></div>'+
            '<div class="myselect"><label for="M'+ mas['id']+'p3" class="headerselection">Produktų ruošimas</label>'+
            '<select id="M'+ mas['id']+'p3" size="2"><option class="elem" value="nera">N</option><option class="elem" value="nulis">0</option><option class="elem" value="vienas">1</option><option class="elem" value="puse">0.5</option></select></div>'+
            '<div class="myselect"><label for="M'+ mas['id']+'p4" class="headerselection">Darbo vietos sutvarkymas</label>'+
                '<select id="M'+ mas['id']+'p4" size="2"><option class="elem" value="nera">N</option><option class="elem" value="nulis">0</option><option class="elem" value="vienas">1</option><option class="elem" value="puse">0.5</option></select></div>'+
            '<div class="myselect"><label for="M'+ mas['id']+'p5" class="headerselection">Saugaus darbo taisyklės</label>'+
            '<select id="M'+ mas['id']+'p5" size="2"><option class="elem" value="nera">N</option><option class="elem" value="nulis">0</option><option class="elem" value="vienas">1</option><option class="elem" value="puse">0.5</option></select></div>'+
            '<div class="myselect"><label for="M'+ mas['id']+'p6" class="headerselection">Etiketas prie stalo</label>'+
                '<select id="M'+ mas['id']+'p6" size="2"><option class="elem" value="nera">N</option><option class="elem" value="nulis">0</option><option class="elem" value="vienas">1</option><option class="elem" value="puse">0.5</option></select></div></div></div></div>');

            $.post('index.php?action=gautivertinimus&pamoka=' + pamokos_id + '&klase=' + klases_id +
                '&mokinys=' + mas['id'], jsonData1, function (data) {
                let vert = JSON.parse(data);
                console.log(vert);
            });
        }
    });
});


function setData(mas) {
    let select1 = '#M' + mas['id'] + 'p1 :selected';
    let select2 = '#M' + mas['id'] + 'p2 :selected';
    let select3 = '#M' + mas['id'] + 'p3 :selected';
    let select4 = '#M' + mas['id'] + 'p4 :selected';
    let select5 = '#M' + mas['id'] + 'p5 :selected';
    let select6 = '#M' + mas['id'] + 'p6 :selected';
    p1_val = $(select1).val();
    p2_val = $(select2).val();
    p3_val = $(select3).val();
    p4_val = $(select4).val();
    p5_val = $(select5).val();
    p6_val = $(select6).val();
}

function createJson() {
    jsonData1 = {
        p1: p1_val,
        p2: p2_val,
        p3: p3_val,
        p4: p4_val,
        p5: p5_val,
        p6: p6_val
    };
}

$('#saugotipamoka').click(function () {
    // let pamokos_id = $('#saugotipamoka').attr('data-pamoka');
    // let klases_id = $('#saugotipamoka').attr('data-klase');
    $.get('index.php?action=gautimokinius&klase=' + klases_id, function (data) {
        let as = JSON.parse(data);
        let i;
        for (i = 0; i < as.length; i++) {
            setData(as[i]);
            createJson();

            let mas = as[i];
            $.post('index.php?action=saugotipamokosvertinima&pamoka=' + pamokos_id + '&klase=' + klases_id +
                '&mokinys=' + mas['id'], jsonData1, function () {
            });

        }
    })
});

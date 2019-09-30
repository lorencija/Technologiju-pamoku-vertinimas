function showhid(containerName){
    select='#'+containerName;
        $(select).toggle();
}
$('#atgal').click(function () {
    let name_by_id = $('#atgal').attr('data-klase');
    window.open('index.php?action=maisto_gaminimas&name=' + name_by_id, '_self');
});
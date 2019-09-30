$('#atgal').click(function () {
    let name_by_id = $('#atgal').attr('data-klase');
    window.open('index.php?action=mp_sarasas&name=' + name_by_id, '_self');
});
$('#maistogaminimas').click(function () {
    let name_by_id = $('#maistogaminimas').attr('data-klase');
    window.open('index.php?action=maisto_gaminimas&name=' + name_by_id, '_self');
});
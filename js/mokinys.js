$('#atgal').click(function () {
    let name_by_id = $('#atgal').attr('data-klase');
    window.open('index.php?action=mokiniu_sarasas&name=' + name_by_id, '_self');
});
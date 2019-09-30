$('#mokiniusarasas').click(function () {
    let name_by_id = $('#mokiniusarasas').attr('data-klase');
    window.open('index.php?action=mokiniu_sarasas&name=' + name_by_id, '_self');
});
$('#pamokos').click(function () {
    let name_by_id = $('#pamokos').attr('data-klase');
    window.open('index.php?action=pamokos&name=' + name_by_id, '_self');
});
$('#atgal').click(function () {
    window.open('index.html', '_self');
});
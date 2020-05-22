$(document).ready(function(){

    $(document).ready( function () {
        $('#table-tipo-usuario').DataTable();
    } );

    var url = "../modelo/select-hospital.php"

    $('#table-tipo-usuario').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": [
        {
            "data": 'idHospital',
            "className": 'text-center'
        },
        {
            "data": 'nomeHospital',
            "className": 'text-center'
        },
        {
            "data": 'ruaHospital',
            "className": 'text-center'
        },
        {
            "data": 'bairroHospital',
            "className": 'text-center'
        },
        {
            "data": 'cepHospital',
            "className": 'text-center'
        },
        {
            "data": 'telefoneHospital',
            "className": 'text-center'
        }]
    });
})
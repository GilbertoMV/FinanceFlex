$(document).ready( function () {
    var table = $('#tabla').DataTable(
        {
            paging: false,
            info:false,
            language: { search: "" }

        });
        $('#buscador').on( 'keyup', function () {
            table.search( this.value ).draw();
        } );
} );
// ALERTA DE ELIMINACIÓN DE PERSONA
$('.eliminar').click(function() {
  const swalWithBootstrapButtons = Swal.mixin({
    color:'#fff',
    background: '#2f2f2f'
  })  
  swalWithBootstrapButtons.fire({
    title: '¿Está seguro?',
    text: "¡Esta acción no se podrá revertir!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, dar de baja.',
    confirmButtonColor:'#28a745',
    background: '#2f2f2f',
    color:'#fff',
    cancelButtonText: 'No, cancelar.',
    cancelButtonColor:'#d8514b',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      swalWithBootstrapButtons.fire(
          '¡Dado de Baja!',
        'El cliente ha sido dado de baja con exito',
        'success'
      )
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        '¡Cancelado!',
        'Los datos están a salvo :)',
        'error',        
      )
    }
  })
})

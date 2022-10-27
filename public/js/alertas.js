// MODAL DE ELIMINACIÓN DE PERSONA
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
      swalWithBootstrapButtons.fire({
        title:'¡Dado de Baja!',
        text:'El cliente ha sido dado de baja con exito',
        icon:'success',
        showConfirmButton:false,
        timerProgressBar:true,
        timer:2000,
        allowOutsideClick: false,
        allowEscapeKey: false,
      })
    } else if (
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire({
        title:'¡Cancelado!',
        text:'Los datos están a salvo :)',
        icon:'error',
        showConfirmButton:false,
        timerProgressBar:true,
        timer:2000,
        allowOutsideClick: false,
        allowEscapeKey: false,       
      })
    }
  })
});

// MODAL DE MODIFICACIÓN DE PERSONA
$('.editar').click(function() {
  Swal.fire({
      showClass: {
        popup: 'animate__animated animate__fadeInDownBig'
      },
      title: 'Modificar Datos',
      background: '#2f2f2f',
      color:'#fff',
      allowOutsideClick: false,
      allowEscapeKey: false,
      confirmButtonText:'Guardar',
      confirmButtonColor:'#28a745',
      showCancelButton: true,
      cancelButtonText: 'No, cancelar.',
      cancelButtonColor:'#d8514b',
      width:'70%',
      html:
        '<div class="formulario-modal">' +
        '<div> <label for="nombre" class="labels">Nombre:</label>' +
        '<input id="nombre" class="inputs center"></div>' +

        '<div><label for="apellidoP" class="labels">Apellido Paterno</label>' +
        '<input id="apellidoP" class=" inputs center"></div>' +

        '<div><label for="apellidoM" class="labels">Apellido Materno</label>' +
        '<input id="apellidoM" class=" inputs center"></div>' +

        '<div><label for="telefono" class="labels">Teléfono</label>' +
        '<input id="telefono" class="inputs center"></div>' +

        '<div><label for="rfc" class="labels">RFC</label>' +
        '<input id="rfc" class="inputs center"></div>' +

        '<div><label for="curp" class="labels">CURP</label>' +
        '<input id="curp" class="inputs center"></div>' +

        '<div><label for="email" class="labels">Email</label>' +
        '<input id="email" class="inputs center"></div>' +

        '<div><label for="fechaN" class="labels">Fecha de Nacimiento</label>' +
        '<input id="fechaN" class="inputs center"></div>' +
        '</div>',

      focusConfirm: true,
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          icon: 'success',
          title: '¡Actualzado!',
          text: 'Los datos han sido actualizado con exito.',
          color:'#fff',
          background:'#2f2f2f',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:true,
          allowOutsideClick: false,
          allowEscapeKey: false,
        })
      }else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          icon: 'error',
          title: '¡Cancelado!',
          text: 'La operación ha sido cancelada con exito.',
          color:'#fff',
          background:'#2f2f2f',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:true,
          allowOutsideClick: false,
          allowEscapeKey: false,
        })
      }
    })
})

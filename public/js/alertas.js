// MODAL DE ELIMINACIÓN DE PERSONA
function delet(id) {
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
    if (result.value) {
      fetch('../controllers/delcliente.php?num_cliente='+id,{
        method: 'POST'
      })
      .then(res=>res.json())
      .then(data =>{
        if(data == 'success'){
          swalWithBootstrapButtons.fire({
            title:'¡Dado de Baja!',
            text:'El cliente ha sido dado de baja con exito',
            icon:'success',
            showConfirmButton:false,
            timerProgressBar:true,
            timer:2000,
            allowOutsideClick: false,
            allowEscapeKey: false,
          }).then(function() {
            location.reload();
          });
        }
        else if (result.dismiss === Swal.DismissReason.cancel) 
        {
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
    }
  })
}
// MODAL DE MODIFICACIÓN DE PERSONA
function edit(id) {
  console.log(id);
  fetch('../controllers/infocliente.php?num_cliente='+id,{
    method: 'POST'
    })
  .then(res=>res.json())
  .then(data =>{
    console.log(data)
    
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
        `<form id="editarinfo">
          <div class="formulario-modal">
          <div> <label for="nombre" class="labels">Nombre:</label>
          <input type="hidden" value="${id}" name="id">
          <input id="nombre" name="nom" class="inputs center" value="${data[0].nom}"></div>
          <div><label for="apellidoP" class="labels">Apellido Paterno</label>
          <input id="apellidoP" name="apellido_p" class=" inputs center" value="${data[0].apellidoP}"></div>
          <div><label for="apellidoM" class="labels">Apellido Materno</label>
          <input id="apellidoM" name="apellido_m" class=" inputs center" value="${data[0].apellidoM}"></div>
          <div><label for="telefono" class="labels">Teléfono</label>
          <input id="telefono" name="tel" class="inputs center" value="${data[0].telefono}"></div>
          <div><label for="rfc" class="labels">RFC</label>
          <input id="rfc" name="rfc" class="inputs center" value="${data[0].rfc}"></div>
          <div><label for="curp" class="labels">CURP</label>
          <input id="curp" name="curp" class="inputs center" value="${data[0].curp}"></div>
          <div><label for="email" class="labels">Email</label>
          <input type="email" id="email" name="email" class="inputs center" value="${data[0].email}"></div> 
          <div><label for="fechaN" class="labels">Fecha de Nacimiento</label>
          <input id="fechaN" name="fena" type="date" class="inputs center" value="${data[0].fechaNac}"></div>
          </div>
          </form>`,
        preConfirm: () => {
          const email= document.getElementById('email'); 
          var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

          if (document.getElementById('nombre').value) {
          }
          else{
            Swal.showValidationMessage('Campos vacios')

          }
          if(document.getElementById('apellidoP').value){

          }
          else {
            Swal.showValidationMessage('Campos vacios')   
          }
          if (document.getElementById('apellidoM').value) {
          }
          else{
            Swal.showValidationMessage('Campos vacios')

          }
          if(document.getElementById('telefono').value){

          }
          else {
            Swal.showValidationMessage('Campos vacios')   
          }
          if (document.getElementById('rfc').value) {
          }
          else{
            Swal.showValidationMessage('Campos vacios')

          }
          if(document.getElementById('curp').value){

          }
          else {
            Swal.showValidationMessage('Campos vacios')   
          }
          if (email.value.match(validRegex)) {
        
          } else {
            Swal.showValidationMessage('Email con formato incorrecto') 
        
          }
          if(document.getElementById('fechaN').value){

          }
          else {
            Swal.showValidationMessage('Campos vacios')   
          }
                    
        },
        focusConfirm: true,
      }).then((result) => {
        if (result.value) {
          const datos = document.querySelector("#editarinfo");
          const datos_actualizar = new FormData(datos);
          var url = "../controllers/edit.php";
          fetch(url, {
              method: 'post',
              body: datos_actualizar
          })
          .then(data => data.json())
          .then(data =>{
            console.log(data);
            Swal.fire({
              icon: 'success',
              title: '¡Actualización exitosa!',
              text: 'Los datos han sido actualizado con exito.',
              color:'#fff',
              background:'#2f2f2f',
              showConfirmButton:false,
              timer:1500,
              timerProgressBar:true,
              allowOutsideClick: false,
              allowEscapeKey: false,
            }).then(function() {
              location.reload();
            });
          })
          .catch(function(error) {
            Swal.fire({
              icon: 'error',
              title: '¡Cancelado!',
              text: 'Ha ocurrido un error.',
              color:'#fff',
              background:'#2f2f2f',
              showConfirmButton:false,
              timer:1500,
              timerProgressBar:true,
              allowOutsideClick: false,
              allowEscapeKey: false,
            })
            console.error('error: ',error);
          });
        }else if (Swal.DismissReason.cancel) {
          Swal.fire({
            icon: 'error',
            title: '¡Cancelado!',
            text: 'La operación ha sido cancelada con exito.',
            color:'#fff',
            background:'#2f2f2f',
            showConfirmButton:false,
            timer:1500,
            timerProgressBar:true,
            allowOutsideClick: false,
            allowEscapeKey: false,
          })
        }
      })
  })
}
// MAS FUNCIONES
function options(id) {
  console.log(id);
  Swal.fire({
    background:'#2f2f2f',
    color:'#fff',
    allowOutsideClick: false,
    allowEscapeKey: false,
    width:'60%',
    
    icon: 'info',
    title:'Más Acciones:',
    html: `
    <form id="op1" action="GenerarDepositosRetiros.php" method="post">
      <div class="bloque_másInfo">      
        <div class="L"><a onclick="document.getElementById('op1').submit(); "class="info_modal"> Generar Deposito y/o Retiro </a></div>
        <input type="hidden" name="id" value="${id}"/>
    </form>
    <form id="op2" action="infoPrestamos.php" method="post">
        <div><a onclick="document.getElementById('op2').submit(); "class="info_modal"> Información de Prestamos</a></div>
        <input type="hidden" name="id" value="${id}"/>
    </form>
    <form id="op3" action="infoPagos.php" method="post">
        <div><a onclick="document.getElementById('op3').submit(); "class="info_modal"> Información de Pagos </a></div>
        <input type="hidden" name="id" value="${id}"/>
    </form>
    </div>
    `
    
  })
}
// DEPOSITAR
$("#depositar").click(function() {
  const monto = document.getElementById("montoDeposito").value;
  const numcta = document.getElementById("numeroCuenta").value;
  console.log(monto);
  Swal.fire({
    title: '¿Estas Seguro?',
    text: `El monto a Depositar es: ${monto}`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#d8514b',
    confirmButtonText: 'Sí, Depositar',
    background:'#2f2f2f',
    color:'#fff'
  }).then((result) => {
    const datos = document.querySelector("#datos_Deposito");
    console.log(datos);
    const datos_actualizar = new FormData(datos);
    var url = "../controllers/deposito.php";
    fetch(url, {
        method: 'post',
        body: datos_actualizar
    })
    .then(data => data.json())
    .then(data =>{
      console.log(data);
      if (data == 'ok') {
        Swal.fire({
          title:'¡El deposito se realizó con exito!',
          icon:'success',
          background:"#2f2f2f",
          color:"#fff",
          timer:1500,
          showConfirmButton:false,
          timerProgressBar:true
        })
     }else if(data == 'not_exist'){
      Swal.fire({
        title:'¡Numero de cuenta no existe!',
        icon:'error',
        background:"#2f2f2f",
        color:"#fff",
        timer:1500,
        showConfirmButton:false,
        timerProgressBar:true
      })
     }else{
      Swal.fire({
        title:'¡Ha ocurrido un error!',
        icon:'error',
        background:"#2f2f2f",
        color:"#fff",
        timer:1500,
        showConfirmButton:false,
        timerProgressBar:true
      })
     }
    })
  })
});
// RETIRAR
$("#retirar").click(function() {
  const monto = document.getElementById("montoRetiro").value;
  const numcta = document.getElementById("numeroCuenta_Retiro").value;
  console.log(monto);
  Swal.fire({
    title: '¿Estas Seguro?',
    text: `El monto a retirar es: ${monto}`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#d8514b',
    confirmButtonText: 'Sí, Retirar',
    background:'#2f2f2f',
    color:'#fff'
  }).then((result) => {
    const datos = document.querySelector("#datos_Retiro");
    console.log(datos);
    const datos_actualizar = new FormData(datos);
    var url = "../controllers/retiro.php";
    fetch(url, {
        method: 'post',
        body: datos_actualizar
    })
    .then(data => data.json())
    .then(data =>{
      console.log(data);
      if (data == 'ok') {
        Swal.fire({
          title:'¡El deposito se realizó con exito!',
          icon:'success',
          background:"#2f2f2f",
          color:"#fff",
          timer:1500,
          showConfirmButton:false,
          timerProgressBar:true
        })
     }else if(data == 'not_exist'){
      Swal.fire({
        title:'¡Numero de cuenta no existe!',
        icon:'error',
        background:"#2f2f2f",
        color:"#fff",
        timer:1500,
        showConfirmButton:false,
        timerProgressBar:true
      })
    }else if(data == 'not_money'){
      Swal.fire({
        title:'¡Fondos insuficientes!',
        icon:'error',
        background:"#2f2f2f",
        color:"#fff",
        timer:1500,
        showConfirmButton:false,
        timerProgressBar:true
      })
     }else{
      Swal.fire({
        title:'¡Ha ocurrido un error!',
        icon:'error',
        background:"#2f2f2f",
        color:"#fff",
        timer:1500,
        showConfirmButton:false,
        timerProgressBar:true
      })
     }
    })
  })
});

//ALERTAS DEL INDEX MAIN
//ALERTA DE REGISTRO
$("#registro").click(function() {
  Swal.fire({
    icon:'question',
    title:'¿Deseas Registrarte en FinanceFlex?',
    text:'Para registrarte en FinanceFlex es necesario acudir con un ejecutivo.'
  })
})
$("#nosotros").click(function() {
  Swal.fire({
    // title: '¡Desarrolladores FinanceFlex!',
    width:'70%',
    html:`
    <section class="hacer">
      <div class="bloque">
          <div class="item">
              <img class="bloque__imagen" src="public/img/backend.png" alt="backend">
              <h1>Juan Pablo Chipres</h1>
              <p>Desarrollador principal del back-end</p>
          </div>
      </div>
      <div class="col-1-item">
          <div class="item">
              <img class="bloque__imagen" src="public/img/frontend.png" alt="frontend">
              <h1>Gilberto Valenzuela</h1>
              <p>Desarrollador principal de front-end</p>
          </div>
      </div>
      <div class="col-1-item">
          <div class="item">
              <img class="bloque__imagen" src="public/img/documentador.png" alt="documentador">
              <h1>Laura Adaia Castillo</h1>
              <p>Documentadora y auxiliar de front-end</p>
          </div>
      </div>
      <div class="col-1-item">
          <div class="item">
              <img class="bloque__imagen" src="public/img/documentador.png" alt="documentador">
              <h1>Maximiliano Martínez</h1>
              <p>Documentadora y auxiliar de front-end</p>
          </div>
      </div>
    </section>`,
    imageUrl: 'public/img/logo_transparent-white.png',
    imageWidth: 200,
    imageHeight: 200,
    imageAlt: 'logo',
    confirmButtonText:'Okey'
  })
})
$("#politica").click(function() {
  Swal.fire({
    imageUrl: 'public/img/Politica.jpg',
    imageAlt: 'Política de Privacidad',
    width:'70%',
    confirmButtonColor:'Entendido',
  })
})

// MODAL DE INHABILITACIÓN CLIENTE
function delet(id) {
  const swalWithBootstrapButtons = Swal.mixin({
    color:'#fff',
    background: '#2f2f2f'
  })  
  swalWithBootstrapButtons.fire({
    title: '¿Desea inhabilitar al cliente?',
    text: "¡Asegurate de que el cliente sea el correcto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, Inhabilitar',
    confirmButtonColor:'#28a745',
    background: '#2f2f2f',
    color:'#fff',
    cancelButtonText: 'No, Cancelar.',
    cancelButtonColor:'#d8514b',
    focusConfirm:false,
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
            title:'¡Inhabilitación éxitosa!',
            text:'El cliente ha sido dado de baja con éxito',
            icon:'success',
            showConfirmButton:false,
            timerProgressBar:false,
            timer:2500,
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
            text:'Los datos están a salvo, buen día.',
            icon:'error',
            showConfirmButton:false,
            timerProgressBar:false,
            timer:2500,
            allowOutsideClick: false,
            allowEscapeKey: false,     
          })
        }
      })
    }
  })
}
// MODAL DE HABILITACIÓN CLIENTE
function reactivar(id) {
  const swalWithBootstrapButtons = Swal.mixin({
    color:'#fff',
    background: '#2f2f2f'
  })  
  swalWithBootstrapButtons.fire({
    title: '¿Desea habilitar al cliente?',
    text: "¡Asegurate de que el cliente sea el correcto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, Habilitar.',
    confirmButtonColor:'#28a745',
    background: '#2f2f2f',
    color:'#fff',
    cancelButtonText: 'No, Cancelar.',
    cancelButtonColor:'#d8514b',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      fetch('../controllers/reacliente.php?num_cliente='+id,{
        method: 'POST'
      })
      .then(res=>res.json())
      .then(data =>{
        if(data == 'success'){
          swalWithBootstrapButtons.fire({
            title:'¡Habilitado!',
            text:'El cliente ha sido habilitado con éxito',
            icon:'success',
            showConfirmButton:false,
            timerProgressBar:false,
            timer:2500,
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
            text:'Operacion cancelada :)',
            icon:'error',
            showConfirmButton:false,
            timerProgressBar:false,
            timer:2500,
            allowOutsideClick: false,
            allowEscapeKey: false,     
          })
        }
      })
    }
  })
}
// MODAL DE MODIFICACIÓN CLIENTE
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
        confirmButtonText:'Actualizar',
        confirmButtonColor:'#28a745',
        showCancelButton: true,
        cancelButtonText: 'No, Cancelar.',
        cancelButtonColor:'#d8514b',
        width:'70%',
        html:
        `<form id="editarinfo">
          <div class="formulario-modal">
          <div><label for="nombre" class="labels">Nombre:</label>
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
          <input id="fechaN" name="fena" type="date" class="inputs center" value="${data[0].fechaNac}" min="1951-01-01" max="2003-01-01"></div>
          </div>
          </form>`,
        preConfirm: () => {
          const email= document.getElementById('email'); 
          const nombres= document.getElementById('nombre');
          const apellidoP= document.getElementById('apellidoP');
          const apellidoM= document.getElementById('apellidoM');
          const telefono= document.getElementById('telefono');
          const rfc= document.getElementById('rfc');
          const curp= document.getElementById('curp');
          var validRegexEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
          var validRegexName = /^[a-zA-Z ]+$/;
          var validRegexapeP = /^[a-zA-Z ]+$/;
          var validRegexapeM = /^[a-zA-Z ]+$/;
          var validRegexTel = /^[0-9]{10}$/;
          var validRegexRFC = /^[A-Za-z0-9]{12,13}$/;
          var validRegexCURP = /^[A-Za-z0-9]{18}$/;



          if (nombres.value.match(validRegexName)) {
          }
          else{
            Swal.showValidationMessage('Solo se permiten letras en el campo nombre.')

          }
          if(apellidoP.value.match(validRegexapeP)){

          }
          else {
            Swal.showValidationMessage('Solo se permiten letras en el campo apellido paterno.')   
          }
          if (apellidoM.value.match(validRegexapeM)) {
          }
          else{
            Swal.showValidationMessage('Solo se permiten letras en el campo apellido materno.')

          }
          if(telefono.value.match(validRegexTel)){

          }
          else {
            Swal.showValidationMessage('Solo se permiten números. Verifíca tu número a 10 dígitos.')   
          }
          if (rfc.value.match(validRegexRFC)) {
          }
          else{
            Swal.showValidationMessage('Verifica que tu RFC este escrito correctamente.')

          }
          if(curp.value.match(validRegexCURP)){

          }
          else {
            Swal.showValidationMessage('Verifica que tu CURP este escrita correctamente.')   
          }
          if (email.value.match(validRegexEmail)) {
        
          } else {
            Swal.showValidationMessage('Email con formato incorrecto') 
        
          }
          if(document.getElementById('fechaN').value){

          }
          else {
            Swal.showValidationMessage('Campos vacíos')   
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
              text: 'Los datos han sido actualizados con éxito.',
              color:'#fff',
              background:'#2f2f2f',
              showConfirmButton:false,
              timer:2500,
              timerProgressBar:false,
              allowOutsideClick: false,
              allowEscapeKey: false,
            }).then(function() {
              location.reload();
            });
          })
          .catch(function(error) {
            Swal.fire({
              icon: 'error',
              title: '¡Algo salió mal!',
              text: 'Ha ocurrido un error :/',
              color:'#fff',
              background:'#2f2f2f',
              showConfirmButton:false,
              timer:2500,
              timerProgressBar:false,
              allowOutsideClick: false,
              allowEscapeKey: false,
            })
            console.error('error: ',error);
          });
        }else if (Swal.DismissReason.cancel) {
          Swal.fire({
            icon: 'error',
            title: '¡Cancelado!',
            text: 'La operación ha sido cancelada con éxito.',
            color:'#fff',
            background:'#2f2f2f',
            showConfirmButton:false,
            timer:2500,
            timerProgressBar:false,
            allowOutsideClick: false,
            allowEscapeKey: false,
          })
        }
      })
  })
}
// MODAL DE MÁS FUNCIONES
function options(id) {
  console.log(id);
  Swal.fire({
    background:'#2f2f2f',
    color:'#fff',
    showConfirmButton:false,
    width:'50%',
    
    icon: 'info',
    title:'Más Acciones:',
    html: `
    <form id="op1" action="GenerarDepositosRetiros.php" method="post">
      <div class="bloque_másInfo">      
        <div class="L"><a onclick="document.getElementById('op1').submit(); "class="info_modal"> Generar Depósito y/o Retiro </a></div>
        <input type="hidden" name="id" value="${id}"/>
    </form>
    <form id="op2" action="infoPrestamos.php" method="post">
        <div><a onclick="document.getElementById('op2').submit(); "class="info_modal"> Información de Préstamos</a></div>
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
// MODAL DE DEPÓSITAR A CUENTA
$("#depositar").click(function() {
  const monto = document.getElementById("montoDeposito").value;
  const numcta = document.getElementById("numeroCuenta").value;
  console.log(monto);
  if(monto == '' || monto == '0'){
    Swal.fire({
      title:'¡Ha ocurrido un error!',
      text:'¡Ingresa un monto válido!',
      icon:'error',
      background:"#2f2f2f",
      color:"#fff",
      timer:2500,
      showConfirmButton:false,
      timerProgressBar:false
    })
  }else{
  Swal.fire({
    title: '¿Estás Seguro?',
    text: `El monto a Depositar es: $${monto}.00`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#d8514b',
    confirmButtonText: 'Sí, Depositar',
    cancelButtonText: 'Cancelar',
    background:'#2f2f2f',
    color:'#fff'
  }).then((result) => {
    if(result.isConfirmed){
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
            title:'¡El depósito fue realizado con éxito!',
            icon:'success',
            background:"#2f2f2f",
            color:"#fff",
            timer:2500,
            showConfirmButton:false,
            timerProgressBar:false
          }).then(function() {
            location.reload();
          });
       }else if(data == 'not_exist'){
        Swal.fire({
          title:'¡Número de cuenta no existe!',
          icon:'error',
          background:"#2f2f2f",
          color:"#fff",
          timer:2500,
          showConfirmButton:false,
          timerProgressBar:false
        })
       }else{
        Swal.fire({
          title:'¡Ha ocurrido un error!',
          icon:'error',
          background:"#2f2f2f",
          color:"#fff",
          timer:2500,
          showConfirmButton:false,
          timerProgressBar:false
        })
       }
      })
    }else if(result.dismiss === Swal.DismissReason.cancel){
      Swal.fire({
        icon:'error',
        title:'¡Cancelado!',
        text:'La operación fue cancelada con éxito.',
        showConfirmButton: false,
        timer:2500,
        background:'#2f2f2f',
        color:'#fff',
        timerProgressBar:false
      })
    }
  })
  }
});
// MODAL DE RETIRAR A CUENTA
$("#retirar").click(function() {
  const monto = document.getElementById("montoRetiro").value;
  const numcta = document.getElementById("numeroCuenta_Retiro").value;
  console.log(monto);
  if(monto == '' || monto <= '0'){
    Swal.fire({
      title:'¡Ha ocurrido un error!',
      text:'¡Ingresa un monto válido!',
      icon:'error',
      background:"#2f2f2f",
      color:"#fff",
      timer:2500,
      showConfirmButton:false,
      timerProgressBar:false
    })
  }else{
  Swal.fire({
    title: '¿Estás Seguro?',
    text: `El monto a retirar es: $${monto}.00`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#d8514b',
    confirmButtonText: 'Sí, Retirar',
    cancelButtonText: 'Cancelar',
    background:'#2f2f2f',
    color:'#fff'
  }).then((result) => {
    if(result.isConfirmed) {
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
            title:'¡El retiro se realizó con éxito!',
            icon:'success',
            background:"#2f2f2f",
            color:"#fff",
            timer:2500,
            showConfirmButton:false,
            timerProgressBar:false
          }).then(function() {
            location.reload();
          });
       }else if(data == 'not_exist'){
        Swal.fire({
          title:'¡Número de cuenta no existe!',
          icon:'error',
          background:"#2f2f2f",
          color:"#fff",
          timer:2500,
          showConfirmButton:false,
          timerProgressBar:false
        })
      }else if(data == 'not_money'){
        Swal.fire({
          title:'¡Fondos insuficientes!',
          icon:'error',
          background:"#2f2f2f",
          color:"#fff",
          timer:2500,
          showConfirmButton:false,
          timerProgressBar:false
        })
       }else{
        Swal.fire({
          title:'¡Ha ocurrido un error!',
          icon:'error',
          background:"#2f2f2f",
          color:"#fff",
          timer:2500,
          showConfirmButton:false,
          timerProgressBar:false
        })
       }
      })
    }else if(result.dismiss === Swal.DismissReason.cancel){
      Swal.fire({
        icon:'error',
        title:'¡Cancelado!',
        text:'La operación fue cancelada con éxito.',
        showConfirmButton: false,
        timer:2500,
        background:'#2f2f2f',
        color:'#fff',
        timerProgressBar:false
      })
    }
  })
}
});

// ALERTAS DEL USUARIO

// ALERTA DE INFORMACIÓN SALDO A PAGAR
$("#infoPago").click(function() {
  Swal.fire({
    icon:'question',
    title:'¿Qué es este apartado?',
    text:'Desde este apartado podrás ver su próximo pago a vencer y encontrarás la opción de realizar el pago inmediatamente!!!',
    showCancelButton: false,
    showConfirmButton:false,
    showCloseButton:true,
    allowEscapeKey:false,
    allowOutsideClick:false,
  })
})
// ALERTA DE INFORMACION SOLICITAR PRESTAMO
$("#infoSolicitar").click(function() {
  Swal.fire({
    icon:'question',
    title:'¿Qué es este apartado?',
    text:'En este apartado podrás simular tu próximo préstamo, puedes ingresar el mónto y el número de plazos en lo que deseas pagarlo y verás inmediatamente la tabla de amortización con los detalles de plazos, pagos y fechas de pago, si así lo decides puedes solicitar desde este apartado, la validación de tu préstamo!!!',
    // background:'#d9d9d9',
    showCancelButton: false,
    showConfirmButton:false,
    showCloseButton:true,
    allowEscapeKey:false,
    allowOutsideClick:false,
  })
})

function pagar(mensualidad, saldo, id, numcta, correo) {
  console.log(mensualidad);
  console.log(saldo);
  console.log(id);
  console.log(numcta);
  console.log(correo);
  pago = parseFloat(mensualidad).toFixed(2);
  Swal.fire({
    title: 'Ingresa tu Contraseña',
    input: 'password',
    inputPlaceholder: 'Ingresa tu Contraseña...',
    inputAttributes: {
      autocapitalize: 'off',
      autocorrect: 'off'
    },
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#d8514b',
    confirmButtonText: 'Confirmar.',
    cancelButtonText: 'No, Cancelar.',
    showCancelButton: true,
    allowEscapeKey:false,
    allowOutsideClick:false,

  }).then((result) => {
    if(result.isConfirmed) {
      const email= correo
      const form = new FormData();
      form.append("email", email);
      form.append("password", result.value);
      var url = "../controllers/loginclient.php";
      fetch(url, {
        method: 'post',
        body: form
      })
      .then(data => data.json())
      .then(data =>{
        console.log(data);
        if (data === 'ok'){
          Swal.fire ({
            icon:'question',
            title:'¿Desea Pagar la Mensualidad?',
            text:'Mensualidad: $'+ pago,
            inputLabel:'Saldo de la cuenta: '+ saldo,
            input:'text',
            inputValue:pago,
            inputPlaceholder:'${Monto a Pagar}',
            inputAttributes:{
              value:'10000',
              autocapitalize: 'off',
              autocorrect: 'off',
              disabled:'on',
            },
            showCancelButton: true,
            showConfirmButton: true,
            showCloseButton:true,
            allowEscapeKey:false,
            allowOutsideClick:false,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d8514b',
            confirmButtonText: 'Sí, Pagar.',
            cancelButtonText: 'No, Cancelar.',
          }).then((result)=>{
            if(result.isConfirmed){
              const form = new FormData();
              form.append("id",id);
              form.append("mensualidad", mensualidad);
              form.append("numCta", numcta);
              var url = "../controllers/pagar.php";
              fetch(url, {
                method: 'post',
                body: form
              })
              .then(data => data.json())
              .then(data =>{
                console.log(data);
                if(data === 'ok'){
                  Swal.fire({
                    title:'¡Pago Autorizado y Realizado!',
                    text:'Gracias por mantenerte al día en tus mensualidades.',
                    icon:'success',
                    showConfirmButton: false,
                    timer:2500
                  }).then(function() {
                    location.reload();
                  });
                }else if(data === 'not_money'){
                  Swal.fire({
                    icon:'error',
                    title:'¡Cancelado!',
                    text:'Tu cuenta no cuenta con el saldo suficiente.',
                    showConfirmButton: false,
                    timer:2500
                  })
                }else{
                  Swal.fire({
                    icon:'error',
                    title:'¡Cancelado!',
                    text:'Ha ocurrido un error.',
                    showConfirmButton: false,
                    timer:2500
                  })

                }
              
              })


            }else if(result.dismiss === Swal.DismissReason.cancel){
              Swal.fire({
                icon:'error',
                title:'¡Cancelado!',
                text:'La operación fue cancelada con exito.',
                showConfirmButton: false,
                timer:2500
              })
            }
          })
        }else{
          Swal.fire({
            title:'¡Contraseña Incorrecta!',
            text:'Su contraseña no coincide, intentelo de nuevo.',
            icon:'error',
            showConfirmButton: false,
            timer:2500
          })
        }
      })
    }else if(result.dismiss === Swal.DismissReason.cancel){
      Swal.fire({
        icon:'error',
        title:'¡Cancelado!',
        text:'La operación fue cancelada con exito.',
        showConfirmButton: false,
        timer:2500
      })
    }
  })
}
$("#solicitarPrestamo").click(function() {
    Swal.fire({
      title: 'Ingresa tu Contraseña',
      input: 'password',
      inputPlaceholder: 'Ingresa tu Contraseña...',
      inputAttributes: {
        autocapitalize: 'off',
        autocorrect: 'off'
      },
      showCancelButton: true,
      confirmButtonColor: '#198754',
      cancelButtonColor: '#dc3545',
      confirmButtonText: 'Si, Confirmar.',
      cancelButtonText: 'Cancelar.'
    }).then((result)=>{ 
      if(result.isConfirmed) {
        
    const email= document.getElementById("email").value
    console.log(email);
    const form = new FormData();
    form.append("email", email);
    form.append("password", result.value);
    var url = "../controllers/loginclient.php";
    fetch(url, {
        method: 'post',
        body: form
    })
    .then(data => data.json())
    .then(data =>{
      console.log(data);
      if (data === 'ok') {
        const monto= document.getElementById("monto").value
        if(monto === '' || monto === '0'){
          Swal.fire({
            title:'¡Ha ocurrido un error!',
            text:'Debes indicar el monto del préstamo.',
            icon:'error',
            showConfirmButton: false,
            timer:2500
          })
        }
        else{
          const plazo= document.getElementById("tiempo").value
          const form = new FormData();
          form.append("monto", monto);
          form.append("plazo", plazo);
          var url = "../controllers/generarPrestamo.php";
          fetch(url, {
              method: 'post',
              body: form
          }).then(data => data.json())
          .then(data_prestamo =>{
            console.log(data_prestamo);
            if(data_prestamo === 'ok_generado'){
              Swal.fire({
                title:'¡Préstamo confirmado!',
                text:'El monto de tu préstamo ha sido agregado a tu cuenta.',
                icon:'success',
                showConfirmButton: false,
                timer:2500
              }).then(function() {
                location.reload();
              });
            } 
            else if(data_prestamo === 'error'){
              Swal.fire({
                title:'¡Ha ocurrido un error!',
                text:'Si el problema persiste contacta a soporte técnico.',
                icon:'error',
                showConfirmButton: false,
                timer:2500
              })
            }
          })
        }
        }else{
          Swal.fire({
            title:'¡Oops, parece que no eres tú!',
            text:'Revisa que la información ingresada sea correcta.',
            icon:'error',
            showConfirmButton: false,
            timer:2500
          })
        }
  })
}else if(result.dismiss === Swal.DismissReason.cancel) {
    Swal.fire({
        icon:'error',
        title:'¡Cancelado!',
        text:'La operación fue cancelada con éxito.',
        showConfirmButton: false,
        timer:2500
      })
    }
})
})

// CONFIGURACION ALERTAS 
// ALERTA GUARDAR DATOS GENERALES 
$('#ActualizarDatosCliente').click(function() {
  Swal.fire({
    icon: 'warning',
    title: 'Oops...',
    text: 'Para modificar tus datos personales es necesario contactar con tu ejecutivo.',
    confirmButtonText: 'Entendido',
    confirmButtonColor:'#198754'
  })
})
// ALERTA GUARDAR NUEVA CONTRASEÑA 
$('#ActualizarCredencialesCliente').click(function() {
  const email = document.getElementById('email').value;
  const passOld = document.getElementById('passOld').value;
  const passNew = document.getElementById('passNew').value;
  const passValid = document.getElementById('passValid').value;
  if (passNew.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/)) {
    if(passNew == ''){
      Swal.fire({
        icon: 'warning',
        title: '¡Campos vacíos!',
        text:'Intenta rellenando los campos para continuar.',
        showConfirmButton: false,
        timer: 2500
      })
    }
    if(passOld == ''){
      Swal.fire({
        icon: 'warning',
        title: '¡Campos vacíos!',
        text:'Intenta rellenando los campos para continuar.',
        showConfirmButton: false,
        timer: 2500
      })
    }
    if(passValid == ''){
      Swal.fire({
        icon: 'warning',
        title: '¡Campos vacíos!',
        text:'Intenta rellenando los campos para continuar.',
        showConfirmButton: false,
        timer: 2500
      })
    }
    else if(passNew != passValid){
    Swal.fire({
      icon: 'warning',
      text: '¡Constraseñas no coiciden!',
      title: 'Ambas contraseñas deben ser iguales.',
      showConfirmButton: false,
      timer: 2500
    })
  }
  else{
    const form = new FormData();
    form.append("email", email);
    form.append("password", passOld);
    var url = "../controllers/loginclient.php";
    fetch(url, {
        method: 'post',
        body: form
    })
    .then(data => data.json())
    .then(data =>{
      if(data === 'ok'){
        const form_pass = new FormData();
        form_pass.append("passNew", passNew);
        var url = "../controllers/changePassword.php";
        fetch(url, {
          method: 'post',
          body: form_pass
      })
      .then(data_new => data_new.json())
      .then(data_new =>{
        if(data_new === 'ok'){
          Swal.fire({
            icon: 'success',
            title: '¡Actualización exitosa!',
            title: 'Tus cambios han sido realizados y almacenados con éxito.',
            showConfirmButton: false,
            timer: 2500
          })
        }else{
          Swal.fire({
            icon:'error',
            title:'¡Cancelado!',
            text:'La operación ha sido cancelada con éxito.',
            showConfirmButton: false,
            timer:2500
          })
  
        }
      })
  
      }else{
        Swal.fire({
          icon: 'warning',
          title:'¡Error de autenticación!',
          text: 'La contraseña actual no es correcta',
          showConfirmButton: false,
          timer: 2500
        })
      }
  
    })
  }
  }
  else{
    Swal.fire({
      icon: 'warning',
      title:'¡Constraseña no valida!',
      text: 'Debe contener al menos un número y una letra mayúscula y minúscula, y al menos 8 o más caractéres.',
      showConfirmButton: false,
      timer: 2500
    })

}
})

// ALERTA CERRAR CUENTA DESDE CLIENTE 
function baja() {
  Swal.fire({
    icon: 'warning',
    title: 'Oops...',
    text: 'Para dar de baja tu cuenta es necesario contactar con tu ejecutivo',
    confirmButtonText: 'Entendido',
    confirmButtonColor:'#198754'
  })
}
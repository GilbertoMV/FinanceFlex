var saldo = document.getElementById('saldo_actual');
var transacciones = document.getElementById('transaccion');
var transacciones_pagos = document.getElementById('pagos');
var deposito = document.getElementById('deposito');
var retiro = document.getElementById('retiro');
var cliente = document.getElementById('infoCliente');
var tabla_transacciones = document.getElementById('tabla-transacciones');
var tabla_pagos = document.getElementById('tabla-pagos');
var info_cliente = document.getElementById('change_genere')
var file = document.getElementById('file-1')
var __DIR__ = window.location.pathname.match('(.*\/).*')[1] + '';
if(saldo){
    async function getBalance(){

        try{
            let resp= await fetch(__DIR__+'../controllers/checkbalance.php');
            response = await resp.json();
            console.log(response);
            if(response === 0.00){
                saldo.innerHTML = `
                <p>$0.00</p>
        
                `
            }else{
                saldo.innerHTML = `
                <p>$${response[0].saldo}</p>
        
                `
            }
            console.log(json);
        }catch(err){
    
        }
    }
    getBalance();

    async function getDeposito(){

        try{
            let resp_depo= await fetch(__DIR__+'../controllers/ultimoDeposito.php');
            response_depo = await resp_depo.json();
            console.log(response_depo);
            if(response_depo === 'null'){
                deposito.innerHTML = `
                <p>Último Ingreso:</p>
                <h5 class="deposito">$0.00</h5>
        
                `
            }else{
                deposito.innerHTML = `
                <p>Último Ingreso:</p>
                <h5 class="deposito">$${response_depo[0].monto}</h5>
                `
            }
            console.log(json);
        }catch(err){
    
        }
    }
    getDeposito();

    async function getRetiro(){

        try{
            let resp_retiro= await fetch(__DIR__+'../controllers/ultimoRetiro.php');
            response_retiro = await resp_retiro.json();
            console.log(response_retiro);
            if(response_retiro === 'null'){
                retiro.innerHTML = `
                <p>Último Retiro</p>
                <h5 class="retiro">$0.00</h5>
        
                `
            }else{
                retiro.innerHTML = `
                <p>Último Retiro:</p>
                <h5 class="retiro">$${response_retiro[0].monto}</h5>
                `
            }
            console.log(json);
        }catch(err){
    
        }
    }
    getRetiro();



}
//MOVIMIENTOS DE DEPOSITOS Y RETIROS
if(tabla_transacciones){
    $(document).ready(function(){
        Tabla();
    });
    
    Tabla = () => {
    fetch(__DIR__+'../controllers/transactions.php')
    .then((res) => res.json())
        .then(response => {
          console.log(response);
          if(response === 'null'){

          }else{
          let html = '';
          for (let i in response) {
            html += `<tr>
                <td class="td">${response[i].tipo}</td>
                <td class="td">${response[i].fecha}</td>
                <td class="td">${response[i].hora}</td>
                <td class="warning td">$${response[i].monto}</td>
            </tr>`;
          }
          document.querySelector('#transaccion').innerHTML = html;  
          $('#tabla-transacciones').DataTable({
            paging: false,
            info:false,
            language: { search: "" }
          });
          $('#buscador').on( 'keyup', function () {
            table.search( this.value ).draw();
        });
    }
        }).catch(error => console.log(error));
    }
}
//PAGOS A PRESTAMO
if(tabla_pagos){
    $(document).ready(function(){
        TablaPagos();
    });
    TablaPagos = () => {
        const id_pr = document.getElementById('idprestamo').value;
        form = new FormData();
        form.append("id_prestamo", id_pr);
    fetch(__DIR__+'../controllers/getPagos.php',{
        method: 'POST',
        contentType: 'XMLHttpRequest',
        body: form
    })
    .then((res) => res.json())
        .then(response => {
          console.log(response);
          if(response === 'null'){

          }else{
            let html = '';
          for (let i in response) {
            html += `<tr>
                <td class="td">${response[i].id_prestamo}</td>
                <td class="td">${response[i].fecha}</td>
                <td class="td">${response[i].hora}</td>
                <td class="warning td">$${response[i].monto}</td>
            </tr>`;
          }
        
          document.querySelector('#pagos-detalles').innerHTML = html;  
          $('#tabla-pagos').DataTable({
            paging: false,
            info:false,
            language: { search: "" }
          });
          $('#buscador').on( 'keyup', function () {
            table.search( this.value ).draw();
        });
    }
        }).catch(error => console.log(error));
    }
}

//OBTENER NUMCTA, RFC, EJECUTIVO, SALDO, FOTO
if(cliente){
    async function getInfo(){
        try{
            let trs_info= await fetch(__DIR__+'../controllers/getInfo.php');
            info_usuario = await trs_info.json();
            console.log(info_usuario);
            if(info_usuario === 'null')
            {
                cliente.innerHTML = `
                <p>Información de Mi cuenta</p>
                <form action="">
                <label for="nCuenta">Número de Cuenta:</label>
                <input class="editInfo" name="nCuenta" type="text" value="" disabled>
                <label for="rfc">RFC:</label>
                <input class="editInfo" name="rfc" type="text" value="" disabled>

                <div class="colums1">
                    <div>
                        <label for="ejecutivoName">Ejecutivo Asignado:</label>
                        <input class="editInfo" name="ejecutivoName" type="text" value="" disabled>
                    </div>
                    <div>
                        <label for="ejecutivoName">Saldo de la Cuenta:</label>
                        <p class="editInfo"></p>
                    </div>
                    <button class="actuInfo" id="ActualizarDatosCliente">Quiero cambiar mis datos.</button>
                </div>
                </form>
                `
    
            }else{
                cliente.innerHTML = `
                <p>Información de Mi cuenta</p>
                <form action="">
                <label for="nCuenta">Número de Cuenta:</label>
                <p class="editInfo">${info_usuario.numCta}</p>
                <label for="rfc">RFC:</label>
                <p class="editInfo">${info_usuario.rfc}</p>

                <div class="colums1">
                    <div>
                        <label for="ejecutivoName">Ejecutivo Asignado:</label>
                        <p class="editInfo">${info_usuario.id_ejecutivo}</p>
                    </div>
                    <div>
                        <label for="ejecutivoName">Saldo de la Cuenta:</label>
                        <p class="editInfo">$ ${info_usuario.saldo}</p>
                    </div>
                </div>
                
                <button class="deleteCuenta" id="cerrarCuenta">Dar de Baja Mi Cuenta</button>
                </form>
                `
        
            }
    
        }catch(err){
            console.error(err);
        }
    }
    getInfo();


}

if(info_cliente){
    async function getInfoCliente(){
        try{
            let trs_info= await fetch(__DIR__+'../controllers/getInfoCliente.php');
            info_usuario = await trs_info.json();
            console.log(info_usuario);
            if(info_usuario === 'null')
            {
                info_cliente.innerHTML = `
                <input class="editInfo" type="text" placeholder="Nombres">
                <div class="colums">
                    <input class="editInfo" type="text" placeholder="Apellido Paterno">
                    <input class="editInfo" type="text" placeholder="Apellido Materno">
                </div>  
                <p class="editInfo">Hola</p>
                <div class="colums">
                <div> 
                    <p class="editInfo"></p>
                </div> 
                    <p class="editInfo"></p>
                </div>
                    <select class="editInfo">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option> 
                    </select>
                </div>
                `
    
            }else{
                info_cliente.innerHTML = `
                <div class="colums">
                    <div class="rRow">
                        <label>Nombre:</label>
                        <p class="editInfo" >${info_usuario.nom}</p>
                    </div>
                    <div class="rRow">
                        <label>Primer Apellido:</label>
                        <p class="editInfo">${info_usuario.apellidoP}</p>
                    </div>
                    <div class="rRow">
                        <label>Segundo Apellido:</label>
                        <p class="editInfo">${info_usuario.apellidoM}</p>
                    </div>
                </div>
                <label>CURP:</label>
                <p class="editInfo">${info_usuario.curp}</p>
                <div class="colums">
                    <div class="rRow">
                        <label>Teléfono:</label>
                        <p class="editInfo">${info_usuario.telefono}</p>
                    </div>
                    <div class="rRow">
                        <label>Fecha Nacimiento:</label>
                        <p class="editInfo">${info_usuario.fechaNac}</p>
                    </div>
                    <div class="rRow">
                        <label>Género:</label>
                        <p class="editInfo">${info_usuario.genero}</p>
                    </div>
                </div>
                `
        
            }
    
        }catch(err){
            console.error(err);
        }
    }
    getInfoCliente();


}
//INPUT IMAGENES
if(file){
    var inputs = document.querySelectorAll('.inputfile');
    Array.prototype.forEach.call(inputs, (input) => {
	var label = input.nextElementSibling, labelVal = label.innerHTML;
	input.addEventListener('change', (e) => {
		var fileName = '';
		if (this.files && this.files.length > 1)
			fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
		else
			fileName = e.target.value.split('\\').pop();

		if (fileName)
			label.querySelector('span').innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});
let formulario = document.getElementById("form")
formulario.addEventListener("submit", function name(ev) {
    ev.preventDefault()
    let fileN = document.getElementById('file-1')
    var formData = new FormData();
    formData.append("foto", fileN.files[0]);
    fetch(__DIR__ + '../controllers/subirFoto.php',{
        method: "POST",
        body: formData,
        }).then(response => response.json())
        .then(response => {
            console.log(response)
            if(response =='ok'){
                Swal.fire({
                    title:'¡Foto Actualizada!',
                    text:'Tu foto ha sido actualizada con éxito',
                    icon:'success',
                    showConfirmButton: false,
                    timer:3000
                  }).then(function() {
                    location.reload();
                  });
            }else if(response == 'larga'){
                Swal.fire({
                    title:'¡Oops, ha ocurrido un error!',
                    text:'La foto tiene medidas no permitidas, intenta con otra foto.',
                    icon:'error',
                    showConfirmButton: false,
                    timer:3000
                  })
            }
            else if(response == 'formato'){
                Swal.fire({
                    title:'¡Oops, ha ocurrido un error!',
                    text:'Formato de no permitido, intenta probar subiendo una imagen.',
                    icon:'error',
                    showConfirmButton: false,
                    timer:3000
                  })
            }else{
                Swal.fire({
                    title:'¡Oops, ha ocurrido un error!',
                    text:'Intentalo de nuevo más tarde',
                    icon:'error',
                    footer:'Si el problema persiste comunicate con el soporte',
                    showConfirmButton: false,
                    timer:3000
                  })
            }
            
        }).catch(error => console.log(error))
    })
}

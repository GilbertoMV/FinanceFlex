var saldo = document.getElementById('saldo_actual');
var transacciones = document.getElementById('transaccion');
var transacciones_pagos = document.getElementById('pagos');
var deposito = document.getElementById('deposito');
var retiro = document.getElementById('retiro');
var cliente = document.getElementById('infoCliente');
var tabla_transacciones = document.getElementById('tabla-transacciones');
var tabla_pagos = document.getElementById('tabla-pagos');
var info_cliente = document.getElementById('change_genere')
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
                <p>Ultimo Ingreso:</p>
                <h5>$0.00</h5>
        
                `
            }else{
                deposito.innerHTML = `
                <p>Ultimo Ingreso:</p>
                <h5>$${response_depo[0].monto}</h5>
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
                <p>Ultimo Retiro</p>
                <h5>$0.00</h5>
        
                `
            }else{
                retiro.innerHTML = `
                <p>Ultimo Retiro:</p>
                <h5>$${response_retiro[0].monto}</h5>
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
          let html = '';
          for (let i in response) {
            html += `<tr>
                <td class="td">${response[i].tipo}</td>
                <td class="td">${response[i].fecha}</td>
                <td class="td">${response[i].hora}</td>
                <td class="warning td">${response[i].monto}</td>
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
                <td class="warning td">${response[i].monto}</td>
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
                    <p class="editInfo"></p>
                    <p class="editInfo"></p>
                    <select class="editInfo">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option> 
                    </select>
                </div>
                `
    
            }else{
                info_cliente.innerHTML = `
                <p class="editInfo" >${info_usuario.nom}</p>
                <div class="colums">
                    <p class="editInfo" >${info_usuario.apellidoP}</p>
                    <p class="editInfo" >${info_usuario.apellidoM}</p>
                </div>  
                <p class="editInfo">${info_usuario.curp}</p>
                <div class="colums">
                    <p class="editInfo">${info_usuario.telefono}</p>
                    <p class="editInfo">${info_usuario.fechaNac}</p>
                    <p class="editInfo">${info_usuario.genero}</p>
                </div>
                `
        
            }
    
        }catch(err){
            console.error(err);
        }
    }
    getInfoCliente();


}


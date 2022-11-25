var saldo = document.getElementById('saldo_actual');
var transacciones = document.getElementById('transaccion');
var transacciones_pagos = document.getElementById('pagos');
var deposito = document.getElementById('deposito');
var retiro = document.getElementById('retiro');
var cliente = document.getElementById('infoCliente');
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
if(transacciones){
    async function getTransactions(){

        try{
            let trs= await fetch(__DIR__+'../controllers/transactions.php');
            transaction = await trs.json();
            console.log(transaction);
            if(transaction == 'null')
            {
                transacciones.innerHTML = `
                        <tr>
                            <td class="td">NULL</td>
                            <td class="td">NULL</td>
                            <td class="td">NULL</td>
                            <td class="td">NULL</td>
                            <td class="td">NULL</td>
                        </tr>
                `
            }else{
                let data = transaction;
                console.log(data);
                data.forEach((item) =>{
                    let newtrm = document.createElement("tr");
                    newtrm.innerHTML = `
                    <tr>
                        <td class="td">${item.tipo}</td>
                        <td class="td">${item.fecha}</td>
                        <td class="td">${item.hora}</td>
                        <td class="warning td">$${item.monto}</td>
                        <td class="td">
                        <button class="recibo">Recibo</button>
                        <button class="reciboResponsive"><i class="bi bi-receipt-cutoff"></i></button></td>`;
                        document.querySelector("#transaccion").appendChild(newtrm);
                });
    
            }
    
        }catch(err){
            console.error(err);
        }
    }
    getTransactions();
}

if(transacciones_pagos){
    async function getPagos(){
        try{
            let trs_pagos= await fetch(__DIR__+'../controllers/getPagos.php');
            transaction_pagos = await trs_pagos.json();
            console.log(transaction_pagos);
            if(transaction_pagos == 'null')
            {
                transacciones_pagos.innerHTML = `
                        <tr>
                            <td class="td">NULL</td>
                            <td class="td">NULL</td>
                            <td class="td">NULL</td>
                            <td class="td">NULL</td>
                            <td class="td">NULL</td>
                        </tr>
                `
            }else{
                let data_pagos = transaction_pagos;
                console.log(data_pagos);
                data_pagos.forEach((pagos) =>{
                    let newtr = document.createElement("tr");
                    newtr.innerHTML = `
                    <tr>
                        <td class="td">${pagos.id_prestamo}</td>
                        <td class="td">${pagos.fecha}</td>
                        <td class="td">${pagos.hora}</td>
                        <td class="warning td">$${pagos.monto}</td>
                        <td class="td">
                        <button class="recibo">Recibo</button>
                        <button class="reciboResponsive"><i class="bi bi-receipt-cutoff"></i></button></td>`;
                        document.querySelector("#pagos").appendChild(newtr);
                });
    
            }
    
        }catch(err){
            console.error(err);
        }
    }
    getPagos();


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

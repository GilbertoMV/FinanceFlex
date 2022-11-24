var tabla_pagos = document.getElementById('tabla-pagos');
if(tabla_pagos){
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
                        <td class="warning td">${pagos.monto}</td>
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
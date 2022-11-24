var tabla_pagos = document.getElementById('datos_cliente');
if(tabla_pagos){
    async function getPagos(){
        const id_cl = document.getElementById('id_cl').value;
        form = new FormData();
        form.append("id_cliente", id_cl)
        try{
            let trs_pagos= await fetch(__DIR__+'../controllers/getPagosPrest.php',{
                method: 'POST',
                contentType: 'XMLHttpRequest',
                body: form
            });
            transaction_pagos = await trs_pagos.json();
            console.log(transaction_pagos);
            if(transaction_pagos == 'null')
            {
                tabla_pagos.innerHTML = `
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
                    <td class="lista_clientes">${pagos.id_pago}</td>
                    <td class="lista_clientes">${pagos.monto}</td>
                    <td class="lista_clientes">${pagos.fecha}</td>
                    <td class="lista_clientes">${pagos.hora}</td>
                    <td class="lista_clientes">${pagos.id_prestamo}</td>
                    <td class="lista_clientes buttons_clientes">
                        <div class="aprobado"><i class="bi bi-shield-check"> Aprobado</i></div>
                    </td> `;
                        document.querySelector("#datos_cliente").appendChild(newtr);
                });
    
            }
    
        }catch(err){
            console.error(err);
        }
    }
    getPagos();


}
var saldo = document.getElementById('saldo');
var transacciones = document.getElementById('transaccion');
var __DIR__ = window.location.pathname.match('(.*\/).*')[1] + '';
async function getBalance(){

    try{
        let resp= await fetch(__DIR__+'../controllers/checkbalance.php');
        response = await resp.json();
        console.log(response);
        if(response === 'null'){
            saldo.innerHTML = `
            <div class="txt">
                <h6>$0.00</h6>
                <p>Saldo Actual</p>
            </div> 
    
            `
        }else{
            saldo.innerHTML = `
            <div class="txt">
                <h6>$${response[0].saldo}</h6>
                <p>Saldo Actual</p>
            </div> 
    
            `
        }
        console.log(json);
    }catch(err){

    }
}
getBalance();
async function getTransactions(){

    try{
        let trs= await fetch(__DIR__+'../controllers/transactions.php');
        transaction = await trs.json();
        console.log(transaction);
        if(transaction == 'null')
        {
            transacciones.innerHTML = `
                    <tr>
                        <td class="td">Deposito</td>
                        <td class="td">NULL</tdclass=>
                        <td class="td">NULL</tdlass=>
                        <td class="td">NULL</tdclass=>
                        <td class="td">NULL</td>
                    </tr>
            `
        }else{
            let data = transaction;
            console.log(data);
            data.forEach((item) =>{
                let newtr = document.createElement("tr");
                newtr.innerHTML = `
                <tr>
                    <td class="td">${item.tipo}</td>
                    <td class="td">${item.fecha_hora}</td>
                    <td class="td">${item.fecha_hora}</td>
                    <td class="warning td">${item.monto}</td>
                    <td class="td">
                    <button class="recibo">Recibo</button>
                    <button class="reciboResponsive"><i class="bi bi-receipt-cutoff"></i></button></td>`;
                    document.querySelector("#transaccion").appendChild(newtr);
            });

        }

    }catch(err){
        console.error(err);
    }
}
getTransactions();
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
                        <td>No cuentas con transacciones</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td class="warning">NULL</td>
                    </tr>
            `
        }else{
            let data = transaction;
            console.log(data);
            data.forEach((item) =>{
                let newtr = document.createElement("tr");
                newtr.innerHTML = `
                <tr>
                    <td>${item.tipo}</td>
                    <td>${item.fecha_hora}</td>
                    <td>${item.fecha_hora}</td>
                    <td class="warning">${item.monto}</td>`;
                    document.querySelector("#transaccion").appendChild(newtr);
            });

        }

    }catch(err){
        console.error(err);
    }
}
getTransactions();
async function getDepositos(){

    try{
        let trs= await fetch(__DIR__+'../controllers/transactions.php');
        transaction = await trs.json();
        console.log(transaction);
        if(transaction == 'null')
        {
            transacciones.innerHTML = `
                    <tr>
                        <td>No cuentas con transacciones</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td class="warning">NULL</td>
                    </tr>
            `
        }else{
            let data = transaction;
            console.log(data);
            data.forEach((item) =>{
                let newtr = document.createElement("tr");
                newtr.innerHTML = `
                <tr>
                    <td>${item.tipo}</td>
                    <td>${item.fecha_hora}</td>
                    <td>${item.fecha_hora}</td>
                    <td class="warning">${item.monto}</td>`;
                    document.querySelector("#transaccion").appendChild(newtr);
            });

        }

    }catch(err){
        console.error(err);
    }
}
getDepositos();
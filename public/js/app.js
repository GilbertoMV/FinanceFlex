//login
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
var respuesta = document.getElementById('InfoBanner');
var saldo = document.getElementById('saldo');
var respuesta_client = document.getElementById('InfoBannerClient');
var __DIR__ = window.location.pathname.match('(.*\/).*')[1] + '';

//REDIRECT LOGINS
if(sign_up_btn)
{
    sign_up_btn.addEventListener('click', () => {
        container.classList.add("sign-up-mode");
    });
}
if(sign_in_btn)
{
    sign_in_btn.addEventListener('click', () => {
        container.classList.remove("sign-up-mode");
    });
}



//AUTENTICACION ADMIN
var loginadmin = document.getElementById('loginadmin');
if(loginadmin)
{
    loginadmin.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('boton oprimido');
    
        var datos = new FormData(loginadmin);
        document.querySelector('.contenedor-loader').classList.add('visible');
    
        console.log(datos);
        console.log(datos.get('emailAdmin'));
        console.log(datos.get('passwordAdmin'));
    
        fetch(__DIR__+'controllers/loginadmin.php',{
            method: 'POST',
            body: datos
        })
        .then(res=>res.json())
        .then(data =>{
            console.log(data)
            document.querySelector('.contenedor-loader').classList.remove('visible');
            if(data === 'Datos incorrectos o vacio'){
                respuesta.innerHTML = `
    
                    <span class="error">
                        Datos incorrectos o vacío
                    </span> 
     
                `
            }else if(data === 'Datos vacios'){
                respuesta.innerHTML = `
                <span class="error">
                    Campos vacíos
                </span> 
                `
            }
            else if(data === 'ok'){
                window.location.replace(
                    __DIR__+'ejecutivo/index.php'
                  );
            }
        })
    })
}
//AUTENTICACION CLIENTES
var loginclient = document.getElementById('loginclient');
if(loginclient)
{
    loginclient.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('boton oprimido');
    
        var datos = new FormData(loginclient);
        document.querySelector('.contenedor-loader').classList.add('visible');
    
        console.log(datos);
        console.log(datos.get('email'));
        console.log(datos.get('password'));
    
        fetch(__DIR__+'controllers/loginclient.php',{
            method: 'POST',
            body: datos
        })
        .then(res=>res.json())
        .then(data =>{
            console.log(data)
            document.querySelector('.contenedor-loader').classList.remove('visible');
            if(data === 'Datos incorrectos o vacio'){
                respuesta_client.innerHTML = `
    
                    <span class="error">
                        Datos incorrectos o vacío
                    </span> 
     
                `
            }else if(data === 'Datos vacios'){
                respuesta_client.innerHTML = `
                <span class="error">
                    Campos vacíos
                </span> 
                `
            }
            else if(data === 'ok'){
                window.location.replace(
                    __DIR__+'usuario/index.php'
                  );
            }
        })
    })
}
//REGISTRO clientes
var registroclients = document.getElementById('registroclients');
if(registroclients){
    registroclients.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('boton oprimido');
    
        var datos = new FormData(registroclients);
        document.querySelector('.contenedor-loader').classList.add('visible');
    
        console.log(datos);
        console.log(datos.get('nombres'));
        console.log(datos.get('apellidoP'));
    
        fetch(__DIR__+'../controllers/registrocontroller.php',{
            method: 'POST',
            body: datos
        })
        .then(res=>res.json())
        .then(data =>{
            console.log(data)
            document.querySelector('.contenedor-loader').classList.remove('visible');
            if(data === 'email_exist'){
                respuesta.innerHTML = `
    
                    <span class="error">
                        Email ya registrado.
                    </span> 
     
                `
            }else if(data === 'rfc_exist'){
                respuesta.innerHTML = `
                <span class="error">
                    RFC ya registrada.
                </span> 
                `
            }
            else if(data === 'curp_exist'){
                respuesta.innerHTML = `
                <span class="error">
                    CURP ya registrada.
                </span> 
                `
            }
            else if(data === 'info_exist'){
                respuesta.innerHTML = `
                <span class="error">
                    Algunos de los datos ya existen, verifica la informacion.
                </span> 
                `
            }
            else if(data === 'ok'){
                respuesta.innerHTML = `
                <span class="success">
                    Cliente registrado correctamente.
                </span> 
                `
            }
            else if(data === 'error'){
                respuesta.innerHTML = `
                <span class="error">
                    Ha ocurrido un error registrando el cliente.
                </span> 
                `
            }
        })
    })
}
//OBTENER SALDO
fetch(__DIR__+'../controllers/checkbalance.php').then((res)=>res.json())
.then(response =>{
    console.log(response)
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
}).catch(error => console.log(error));
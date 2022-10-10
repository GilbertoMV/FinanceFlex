//login
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
var respuesta = document.getElementById('InfoBanner');
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



//AUTENTICACION
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

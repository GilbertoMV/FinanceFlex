const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
var respuesta = document.getElementById('InfoBanner');

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
        console.log(datos)
        document.querySelector('.contenedor-loader').classList.add('visible');
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
    //validacion de campos
    const inputs = document.querySelectorAll('#loginclient input')
    const expresiones = {
        email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    }
    const campos = {
        email: false
    }

    const validarFormulario = (e) =>{
        switch (e.target.name){
            case "email":
                validarCampo(expresiones.email, e.target, 'email');
            break;
        }
    }
    const validarCampo = (expresion, input, campo)=>{
        if(expresion.test(input.value)){
            document.getElementById(`input-${campo}`).classList.remove('input-incorrect');
            document.getElementById(`input-${campo}`).classList.add('input-correct');
            document.getElementById(`formulario-input-error`).classList.remove('formulario-input-error-activo');
            campos[campo] = true;
        }else{
            document.getElementById(`input-${campo}`).classList.add('input-incorrect');
            document.getElementById(`input-${campo}`).classList.remove('input-correct');
            document.getElementById(`formulario-input-error`).classList.add('formulario-input-error-activo');
            campos[campo] = false;
        }
    }
    inputs.forEach((input) => {
        input.addEventListener('keyup', validarFormulario);
        input.addEventListener('blur', validarFormulario);
    });
    loginclient.addEventListener('submit', function(e) {
        e.preventDefault();
        if(campos.email){
            console.log('boton oprimido');
            var datos = new FormData(loginclient);
            
            document.querySelector('.contenedor-loader').classList.add('visible');
    
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
        }else{
            document.getElementById('formulario-mensaje').classList.add('formulario-mensaje-activo');
        }
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

//CAPITALICACIÓN DE INPUTS DE REGISTRO
//Mayusculas y minusculas

// //instanciamos el elemento input
// var input = document.querySelector('.capitalizar');
// //función que capitaliza la primera letra
// function capitalizarPrimeraLetra() {
//   //almacenamos el valor del input
//   var palabra = input.value;
//   //Si el valor es nulo o undefined salimos
//   if(!input.value) return;
//   // almacenamos la mayuscula
//   var mayuscula = palabra.substring(0,1).toUpperCase();
//   //si la palabra tiene más de una letra almacenamos las minúsculas
//   if (palabra.length > 0) {
//     var minuscula = palabra.substring(1).toLowerCase();
//   }
//   //escribimos la palabra con la primera letra mayuscula
//   input.value = mayuscula.concat(minuscula);
// }

function mostrarPalabra() {
    //cuando vas a declarar variables que el valor va permencer sobre esa misma función, utilizas let en vez de var  -->
    var dato1 = document.getElementById('nombres').value;
    var dato2 = document.getElementById('apeP').value;
    var dato3 = document.getElementById('apeM').value;
    // Acá estás enviado caja_busqueda (así está nombrado en html no en javascript) -->
    //Datos es quién contiene el valor de caja búsqueda -->
    document.getElementById('nombres').value = convertir(dato1.toLowerCase());
    document.getElementById('apeP').value = convertir(dato2.toLowerCase());
    document.getElementById('apeM').value = convertir(dato3.toLowerCase());
    // Cuando realizas este console te dará por resultado undifined porque en efecto no existe -->
}

function convertir(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

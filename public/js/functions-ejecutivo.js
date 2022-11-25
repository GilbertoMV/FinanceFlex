var tabla_pago = document.getElementById('tabla-pagos');
if(tabla_pago){
    $(document).ready(function(){
        Tabla();
    });
    
    Tabla = () => {
        const id_cl = document.getElementById('id_cl').value;
        form = new FormData();
        form.append("id_cliente", id_cl);
    fetch(__DIR__+'../controllers/getPagosPrest.php',{
        method: 'POST',
        contentType: 'XMLHttpRequest',
        body: form
    }).then((res) => res.json())
        .then(response => {
          console.log(response);
          let html = '';
          for (let i in response) {
            html += `<tr>
              <td class="lista_clientes">${response[i].id_pago}</td>
              <td class="lista_clientes">${response[i].monto}</td>
              <td class="lista_clientes">${response[i].fecha}</td>
              <td class="lista_clientes">${response[i].hora}</td>
              <td class="lista_clientes">${response[i].id_prestamo}</td>
              <td class="lista_clientes buttons_clientes">
              <div class="aprobado"><i class="bi bi-shield-check"> Aprobado</i></div>
              </td>
            </tr>`;
          }
          document.querySelector('#datos_cliente').innerHTML = html;  
          $('#tabla-pagos').DataTable({
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

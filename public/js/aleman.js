const monto = document.getElementById('monto');
const tiempo = document.getElementById('tiempo');
const btnCalcular = document.getElementById('btnCalcular');
const alerta = document.getElementById('alert-error');
const llenarTabla = document.querySelector('#lista-tabla tbody')

if(btnCalcular){
btnCalcular.addEventListener('click', () => {

    if (monto.value === '' || tiempo.value === '') {
        alerta.hidden = false;
        setTimeout(() => {
            alerta.hidden = true;
        }, 2000);
    } else {
        calcularCronograma(monto.value, tiempo.value);
    }
})
}
function calcularCronograma(monto, tiempo) {

    while(llenarTabla.firstChild) {
        llenarTabla.removeChild(llenarTabla.firstChild);
    }
    let interes;
    if (tiempo == '6') {
        interes = 3;
    } else if(tiempo == '9') {
        interes = 5;
    }else if(tiempo == '12') {
        interes = 7;
    }
    let mesActual = dayjs().add(1, 'month');
    let amortizacionConstante, pagoInteres, cuota;
    amortizacionConstante = monto / tiempo;
    for (let i = 1; i <= tiempo; i++) {
        pagoInteres = monto * (interes / 100);
        cuota = amortizacionConstante + pagoInteres;
        monto = monto - amortizacionConstante;

        let fecha = mesActual.format('DD/MM/YYYY');
        mesActual = mesActual.add(1, 'month');

        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="thT">${fecha}</td>
            <td class="thT">$${amortizacionConstante.toFixed(2)}</td>
            <td class="thT">$${pagoInteres.toFixed(2)}</td>
            <td class="thT">$${cuota.toFixed(2)}</td>
            <td class="thT">$${monto.toFixed(2)}</td>
        `;
        llenarTabla.appendChild(row);
        
    }
}
const openModal = document.querySelector('.hero__cta');
const modal = document.querySelector('.modal1');
const closeModal = document.querySelector('.modal__close');
if(openModal){
    openModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.add('modal--show');
});
closeModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.remove('modal--show');
});
 }
function pdf() {
    const datos = document.querySelector("#datos_prestamo");
    console.log(datos);
    const generar_pdf = new FormData(datos);
    var url = "../controllers/pdfClient.php";
    fetch(url, {
        method: 'post',
        body: generar_pdf
    });

}

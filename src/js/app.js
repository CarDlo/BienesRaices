document.addEventListener('DOMContentLoaded', () => {
   eventListeners(); 
   darkMode();
})

function darkMode() {
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    if(prefersDarkScheme.matches) {
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }

    prefersDarkScheme.addEventListener('change', (event) => {
        if(event.matches) {
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    })



    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    })
    }   

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}
 function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
 }
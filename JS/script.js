let pregunta = document.querySelectorAll('.pregunta');
let btnDropdown = document.querySelectorAll('.pregunta .mas')
let respuesta = document.querySelectorAll('.respuesta');
let parrafo = document.querySelectorAll('.respuesta p');
let elements = document.querySelectorAll('.index');




for ( let i = 0; i < btnDropdown.length; i ++ ) {

    let altoParrafo = parrafo[i].clientHeight;
    let switchc = 0;

    btnDropdown[i].addEventListener('click', () => {

        if ( switchc == 0 ) {

            respuesta[i].style.height = `${altoParrafo}px`;
            pregunta[i].style.marginBottom = '10px';
            btnDropdown[i].innerHTML = '<i>-</i>';
            switchc ++;

        }

        else if ( switchc == 1 ) {

            respuesta[i].style.height = `0`;
            pregunta[i].style.marginBottom = '0';
            btnDropdown[i].innerHTML = '<i>+</i>';
            switchc --;

        }

    })

}









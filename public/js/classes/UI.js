import { onClickServicios , guardarCita } from "../app.js";

export class UI {

    static mostrarPagina(pagina){

        this.ocultarAnterior();

        const mostrarPagina = document.querySelector(`#paso-${pagina}`);
        const botonActual = document.getElementById(`${pagina}`);
 
        mostrarPagina.classList.add('mostrar');
        mostrarPagina.classList.remove('ocultar');

        botonActual.classList.remove('button');
        botonActual.classList.add('button_actual');

    }

    static ocultarAnterior(){
        const pagina=document.querySelector('.mostrar');
        const button=document.querySelector('.button_actual');

        pagina.classList.remove('mostrar');
        pagina.classList.add('ocultar');
    
        button.classList.add('button');
        button.classList.remove('button_actual');
    }

    static mostrarPaginador(pagina)
    {
        const anterior = document.getElementById('anterior');
        const siguiente = document.getElementById('siguiente');
    
        if(pagina === 1){
            anterior.classList.add('ocultarPaginador');
            siguiente.classList.remove('ocultarPaginador');
        } else if(pagina === 3){
            anterior.classList.remove('ocultarPaginador');
            siguiente.classList.add('ocultarPaginador');
        } else  {
            document.querySelector('.ocultarPaginador').classList.remove('ocultarPaginador');
        }
    }

    static mostrarResultado(json , etiqueta){
 
        json.forEach(elemnt => {
    
            const div = document.createElement('DIV');
            const p = document.createElement('P');
            const span = document.createElement('SPAN');
            const h4 = document.createElement('H4');
    
            div.className = 'cards';
            div.onclick = ()=>{
                onClickServicios(elemnt);
                this.selecionCards(div,p,elemnt);
            }
            p.textContent = `$ ${elemnt.precio}`;
            span.textContent = '|';
            h4.textContent = `${elemnt.nombre}`;
    
            div.appendChild(p);
            div.appendChild(span);
            div.appendChild(h4);
            etiqueta.appendChild(div);
        })
    }

    static selecionCards(div,p){
        if(div.classList.contains('seleccionado')){
            div.classList.remove('seleccionado');
            p.style.color = 'black';
        } else {
            div.classList.add('seleccionado');
            p.style.color = 'white';
        }
    }

    static mostrarError(mensaje){

        if(document .querySelector('.error-mensaje')){
            document.querySelector('.error-mensaje').remove();
        }

        const div = document.createElement('div');
        const p = document.createElement('p');
        div.className = 'seleccionado div_buttom error-mensaje';
        p.classList.add('seleccionado_p');
        p.textContent = `${mensaje}`;

        div.appendChild(p);
        document.querySelector('form').appendChild(div);
    }

    static mostrarResumen(object){

        const div = document.createElement('div');
        div.className = 'div_admin seleccionado padding div_buttom';

        const div_titulo = document.createElement('div');
        const titulo = document.createElement('h3');
        titulo.textContent = `${object.nombre}`;

        const div_p = document.createElement('div');
        const p = document.createElement('p');
        p.textContent = `Tienes turno para el dia ${object.fecha} a las ${object.hora}`;

        const div_ul = document.createElement('div');
        const ul = document.createElement('ul');

        object.servicios.forEach(servicio => {
            const li = document.createElement('li');
            li.classList.add('li')
            li.textContent = `$ ${servicio.precio} | ${servicio.nombre}`;

            ul.appendChild(li);
        });

        const boton = document.createElement('button');
        boton.className = 'buttom div_buttom centrar';
        boton.textContent = 'Guardar Turno';
        boton.dataset.id = `${object.cliente_id}`;
        boton.onclick = ()=>{
            guardarCita(object);
        }


        div_ul.appendChild(ul);

        div_p.appendChild(p);

        div_titulo.appendChild(titulo);

        div.appendChild(div_titulo);
        div.appendChild(div_p);
        div.appendChild(div_ul);

        document.querySelector('.mostrar').appendChild(div);
        document.querySelector('.mostrar').appendChild(boton);
    }
}
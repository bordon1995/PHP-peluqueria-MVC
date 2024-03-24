import { Index } from "./classes/Index.js";
import { UI } from "./classes/UI.js";

const cliente_id = document.querySelector('h2').dataset.id
const cliente_nombre = document.querySelector('h2').dataset.nombre
const botones = document.querySelectorAll('.tabs button');
const paginaServicio = document.getElementById('servicios');
const fecha = document.getElementById('date');
const time = document.getElementById('time');

const index = new Index();

document.addEventListener('DOMContentLoaded',() =>{
    iniciarApp();
    getCita();
});

async function iniciarApp(){
    index.setPagina(1);
    eventsbutton();
    eventsPaginador();
    const api = await index.all();
    UI.mostrarResultado(api , paginaServicio);
}

function eventsbutton(){
    botones.forEach(boton => {
        boton.addEventListener('click',(e)=>{
            
            index.setPagina(parseInt(e.target.dataset.paso));
  
            UI.mostrarPagina(index.getPagina());
            UI.mostrarPaginador(index.getPagina());
        });
    });
}

function eventsPaginador(){
    const paginador = document.querySelectorAll('.paginacion button')
    paginador.forEach(event => {
        event.addEventListener('click',(pagina)=>{
            if(pagina.target.attributes.id.value === 'siguiente'){
                let pagina = index.getPagina();
                ++pagina;
                index.setPagina(pagina);
                UI.mostrarPagina(index.getPagina());
                UI.mostrarPaginador(index.getPagina());
            } else {
                let pagina = index.getPagina();
                --pagina;
                index.setPagina(pagina);
                UI.mostrarPagina(index.getPagina());
                UI.mostrarPaginador(index.getPagina());
            };
        });
    });
}

function onClickServicios(object){
    if(index.servicios.some(servicio => servicio.id === object.id)){
       index.deleteServicio(object.id); 
    } else {
        const objectServicio = 
        {
            id : object.id,
            nombre : object.nombre,
            precio : object.precio
        }

        index.setServicios(objectServicio);
    }
}

function getCita(){
    document.querySelector('[data-paso = "4"]').addEventListener('click',()=>{
        const dia = new Date(fecha.value).getUTCDay();
        const hora = time.value.split(":")[0];
        
        if([6,0].includes(dia)){
            fecha.value = '';
        } else {
            index.fecha = fecha.value;
        };

        if(hora < 10 || hora > 18){
            time.value = ''; 
        } else {
            index.hora = time.value;
        };

        getResumen();
    });    
}

function getResumen(){

    index.cliente_id = cliente_id;
    index.nombre = cliente_nombre;

    if(Object.values(index).includes('')){
        UI.mostrarError('Ingrese una fecha u hora valido');
        return;
    };
    
    if(index.servicios.length === 0) {
        UI.mostrarError('Ingrese almenos un servicio para poder crear una cita');
        return;
    }; 

    index.setPagina(3);
    UI.mostrarPagina(index.getPagina());
    UI.mostrarPaginador(index.getPagina());

    UI.mostrarResumen(index);
}

function guardarCita(cita){
    index.save(cita);
}

export { onClickServicios , guardarCita };


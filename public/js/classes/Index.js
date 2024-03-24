export class Index 
{
    #pagina;
    constructor(cliente_id,nombre,fecha,hora)
    {
        this.cliente_id = cliente_id ?? '';
        this.nombre = nombre ?? '';
        this.fecha = fecha ?? '';
        this.hora = hora ?? '';
        this.servicios = Array();
    }

    setPagina(pagina)
    {
        this.#pagina=pagina;
    }

    getPagina()
    {
        return this.#pagina;
    }

    setServicios(object)
    {
        this.servicios.push(object);
    }

    deleteServicio(id){
        const upServicios = this.servicios.filter(element => element.id !== id);
        this.servicios = [...upServicios];
    }

    async all()
    {
        try {
            const resultado = await fetch(`${location.origin}/api/servicios`);
            const json = await resultado.json();
            return json;
        } catch (error) {
            console.log(error);
        } 
    }

    async save(object){
        const url = `${location.origin}/api/cita`;

        const servicios_id = object.servicios.map(servicio => servicio.id);

        try {
            const cita = new FormData();
            cita.append( 'nombre' , object.nombre);
            cita.append( 'fecha' , object.fecha);
            cita.append( 'hora' , object.hora);
            cita.append( 'cliente_id' , object.cliente_id);
            cita.append( 'servicios' , servicios_id);

            const req = await fetch(url, {
                method : 'POST',
                body : cita
            });
            window.location.reload();
        } catch (error) {
            console.log(error);
        }
    }
}
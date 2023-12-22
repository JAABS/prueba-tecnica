
const btn_obtener_Personas = document.getElementById("btn_mostrar_personas")
const btn_eliminar_datos = document.getElementById("btn_eliminar_datos_tabla")
const btn_guardar_persona = document.getElementById("btn_guardar")
const btn_cancelar_actualizar = document.getElementById("btn_cancelar_actualizar")
const btn_guardar_actualziar = document.getElementById("btn_guardar_actualizar")


const contenido_tabla = document.getElementById("contenido_tabla")
const contenido_actualizar = document.getElementById("contenido_form_modificar")

const form_agregar = document.getElementById("form_agregar")
const form_actualizar = document.getElementById("form_actualizar")
const id = document.getElementById("")

const inp_id_actualizar = document.getElementById("inp_id_actualizar")
const inp_nombre_actualziar = document.getElementById("inp_nombre_actualizar")
const inp_edad_actualziar = document.getElementById("inp_edad_actualizar")

    // llamadas a la api
 function obtener_personas(){
     fetch("http://localhost/php-apirest/api/v1/personas")
    .then(res => res.json())
    .then(datos => {
        let body = ""
        for(let x = 0; x < datos.length; x++){
            body += `<tr><td>${datos[x].persona_id}</td><td>${datos[x].nombre}</td><td>${datos[x].edad}</td>
            <td><button id="${datos[x].persona_id}" class="btn_modificar" onclick="mostrar_modificar_persona(${datos[x].persona_id})">Modificar</button>
            <button class="btn_eliminar" onclick="eliminar_persona(${datos[x].persona_id})">eliminar</button></td>
            </tr>`
        }
        contenido_tabla.innerHTML = body
    })
}

function obtener_persona(id){
    
    fetch(`http://localhost/php-apirest/api/v1/personas?id=${id}`)
    .then(res => res.json())
    .then(datos => {
        inp_id_actualizar.value = datos[0].persona_id
        inp_nombre_actualziar.value=datos[0].nombre
        inp_edad_actualziar.value=datos[0].edad
    })   
}

// Obtenemos los datos desde el formulario de agregar persona
// Pasamos los valores a un objeto para convertilo en json y mandarlo para la api
async function agregar_persona(){
    
    const form = new FormData(form_agregar)
    let datos = new Object()
    datos.nombre = form.get("nombre")
    datos.edad = form.get("edad")
    const json = JSON.stringify(datos)
    console.log(json)
    fetch("http://localhost/php-apirest/api/v1/personas", {
        method:"POST",
        body: json,
        headers:{
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .catch(error => console.log(error))
}

// Obtenemos los datos desde el formulario de agregar persona
// Pasamos los valores a un objeto para convertilo en json y mandarlo para la api
function actualizar_persona(){
    const form = new FormData(form_actualizar)
    let datos = new Object()
    datos.nombre = form.get("nombre")
    datos.edad = form.get("edad")
    const json = JSON.stringify(datos)
    const id = inp_id_actualizar.value
    fetch(`http://localhost/php-apirest/api/v1/personas?id=${id}`, {
        method:'PUT',
        body: json,
        headers:{
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .catch(error => console.log(error))
}

function eliminar_persona(id){
    fetch(`http://localhost/php-apirest/api/v1/personas?id=${id}`, {
        method: "DELETE"
    })
    .then(response => response.json())
    .catch(error => console.log(error))
    eliminar_datos_tabla()
    obtener_personas()
}

// Manipular la vista
function mostrar_modificar_persona(id){
    obtener_persona(id)
    contenido_actualizar.style.display = "block"
}

function cerrar_modificar_persona(){
    contenido_actualizar.style.display = "none"
}

function eliminar_datos_tabla(){
    while(contenido_tabla.firstChild){
        contenido_tabla.removeChild(contenido_tabla.firstChild)
    }
}

// eventos de la vista
btn_obtener_Personas.addEventListener("click", obtener_personas)
btn_eliminar_datos.addEventListener("click", eliminar_datos_tabla)
btn_cancelar_actualizar.addEventListener("click", cerrar_modificar_persona)
form_agregar.addEventListener("submit", (e) => {
    agregar_persona()
})
form_actualizar.addEventListener("submit", (e) =>{
    actualizar_persona()
})





$(document).ready(function(){
	
	MostrarGrilla();
});

function MostrarGrilla(){
	
    var pagina = "./clases/nexo.php";
    
    $.ajax({
    	type: 'POST',
    	url: pagina,
    	data: {queHago: "mostrarGrilla"},
    	dataType: 'html'
    })
    .done(function(datosrespuesta){
    	$("#divGrilla").html(datosrespuesta)
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}



function Borrar(usuario){

if(!confirm("Desea ELIMINAR el Usuario "+usuario.Nombre+"??")){
		return;
}

var pagina = "./clases/nexo.php";


$.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "eliminar",
			usuario : usuario
		},
        async: true
    })
	.done(function (objJson) {
		
		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		
		alert(objJson.Mensaje);
		MostrarGrilla();

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
	
}


function Modificar(){

var pagina = "./clases/nexo.php";


var nombre=document.getElementById("nombre").value
var clave=document.getElementById("clave").value
var id="NULL"

var usuario={id, nombre, clave}

$.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "modificar",
			usuario : usuario
		},
        async: true
    })
	.done(function (objJson) {

		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		
		alert(objJson.Mensaje);

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });   
}
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

function Modificar(usuario){

var pagina = "./clases/nexo.php";
var id;
var usuario;
var clave;

if(usuario=="NULL"){
	usuario.id=null;
	usuario.nombre=$("#nombre").val(usuario.Nombre);
	usuario.clave=$("#clave").val(usuario.Clave);
	usuario=json_encode(usuario);
}
else{
	$("#nombre").val(usuario.Nombre);
	$("#clave").val(usuario.Clave);
}

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
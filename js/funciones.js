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

function Datos(usuario){
	
    var pagina = "./clases/nexo.php";
    
    alert(usuario);
    $.ajax({
    	type: 'POST',
    	url: pagina,
    	data: {queHago: "datos",
    	usuario: usuario},
    	dataType: 'json'
    })
    .done(function(datosrespuesta){
    	alert(datosrespuesta.Mensaje);
    	$("#registro").html(datosrespuesta.Mensaje);
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
var nombre;
var clave;
var us={};

if(usuario=="NULL"){
	us.id=null;
	us.Nombre=$("#nombre").val(usuario.Nombre);
	us.Clave=$("#clave").val(usuario.Clave);
	usuario=json_encode(us);
}
else{
	$("#nombre").val(usuario.Nombre);
	$("#clave").val(usuario.Clave);
}

alert(usuario.Nombre);

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
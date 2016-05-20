<?php
require_once ("usuario.php");
require_once("AccesoDatos.php");

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

switch($queHago){

	case "mostrarGrilla":
		
		$arraysDeUsuario =usuario::TraerTodosLosUsuarios();

		$grilla = " <table class='table  '>
                        <thead>
                          <tr>
                            <th>Modificar</th>
                            <th>Borrar</th>
                            <th>Usuario</th>
                            <th>Clave</th>
                          </tr>
                        </thead>"; 	


		foreach ($arraysDeUsuario as $usu){
			$usuario = array();
			$usuario = json_encode($usu);

			$grilla .= "<tr>
	                        <td> <a class='btn btn-warning' onClick=Datos($usuario) href='registro.html'>Modificar</a></td>
	                        <td> <a class='btn btn-danger' onClick=Borrar($usuario)>Borrar</a></td>
	                        <td>$usu->Nombre</td>
	                        <td>$usu->Clave</td>
	                    </tr>";
		}
		
		$grilla .= '</table>';		
		
		echo $grilla;
		
		break;

	case "eliminar":
		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";
		$obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;

		if(!usuario::BorrarUsuario($obj->id)){
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Lamentablemente ocurrio un error y no se pudo borrar el usuario.";
		}
		else{
			$retorno["Mensaje"] = "USUARIO eliminado CORRECTAMENTE!!!";
		}
	
		echo json_encode($retorno);
		

		break;

	case "datos":

		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";

		

		$nom=" ";
		$cla=" ";

		if ($obj!="NULL") {
			$obj = json_decode(json_encode($_POST['usuario']));
			$nom=$obj->Nombre;
			$cla=$obj->Clave;
		}
		else{
			$obj="NULL";
		}
		
		$usu=json_encode($obj);

		$datos="
				<input type='text' name='nombre' id='nombre' placeholder='Nombre' value='$nom'>
                <input type='text' name='clave' id='clave' placeholder='Clave' value='$cla'><br>
                <input type='submit' name='Registrar' class='btn btn-info' onClick=Modificar($usu)>";

        $retorno["Mensaje"]=$datos;
        echo json_encode($retorno);

        break;


	case "modificar":
		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";

		$obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;
		
		$arraysDeUsuario =usuario::TraerTodosLosUsuarios();

		if($obj->id=="NULL"){
			foreach ($arraysDeUsuario as $usu){
				
				if($usu->Nombre==$obj->Nombre){
					$retorno["Exito"]=FALSE;
					$retorno["Mensaje"]="El usuario ya existe";		
				}
				else{
					usuario::Agregar($obj->Nombre, $obj->Clave);
					$retorno["Mensaje"] = "Usuario dado de alta!";
				}
			}
		}
		else{
			foreach ($arraysDeUsuario as $usu){
				
				if($usu->id==$obj->id){
					
					if(!usuario::Modificar($obj)){
						$retorno["Exito"] = FALSE;
						$retorno["Mensaje"] = "Error en la modificacion";
					}
					else{
						$retorno["Mensaje"] = "Modificacion realizada con exito!";
					}
				}
			}
		}
		echo json_encode($retorno);
		
		break;
		
	default:
		echo ":(";
}

?>
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
	                        <td> <a class='btn btn-warning' onClick=Modificar($usuario) href='registro.html'>Modificar</a></td>
	                        <td> <a class='btn btn-danger' onClick=Borrar($usuario)>Borrar</a></td>
	                        <td>$usu->Nombre</td>
	                        <td>$usu->Clave</td>
	                    </tr>";
		}
		
		$grilla .= '</table>';		
		
		echo $grilla;
		
		break;
		/*
	case "agregar":
		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";
		$obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;
		
		$p = new Producto($obj->id, $obj->nombre, $obj->clave);
		
		if(!Producto::Guardar($p)){
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "No se pudo cargar ese Usuario";
		}
		else{
				$retorno["Mensaje"] = "Usuario agregado correctamente!!!";
			}
		}
	
		echo json_encode($retorno);
		
		break;
*/
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
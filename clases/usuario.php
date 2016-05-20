<?php

class usuario
{
	public $id;
 	public $nombre;
  	public $clave;

  	public function __construct($id=NULL, $nombre=NULL, $clave=NULL)
	{
			$this->id = $id;
			$this->nombre = $nombre;
			$this->clave = $clave;		
	}

  	public function BorrarUsuario($ide)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuario 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$ide, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	}
	
	public function Modificar($usu)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set Nombre='$usu->Nombre',
				Clave='$usu->Clave',
				WHERE id='$usu->id'");
			return $consulta->execute();

	 }

  	public static function TraerTodosLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre as Nombre, clave as Clave from usuario");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

	public function Agregar()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				insert into usuario ('nombre', 'clave')
				values ('$this->nombre', '$this->clave'");
			return $consulta->execute();

	 }

}
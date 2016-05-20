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
				set nombre=:nom,
				clave=:cla
				WHERE id=:id");
			$consulta->bindValue(':id',$usu->id, PDO::PARAM_INT);
			$consulta->bindValue(':nom',$usu->Nombre, PDO::PARAM_STR);
			$consulta->bindValue(':cla',$usu->Clave, PDO::PARAM_STR);
			return $consulta->execute();

	 }

  	public static function TraerTodosLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre as Nombre, clave as Clave from usuario");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

	public function Agregar($nom, $cla)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				insert into usuario ('nombre', 'clave')
				values (:nom, :cla)");
			$consulta->bindValue(':nom',$nom, PDO::PARAM_STR);
			$consulta->bindValue(':cla',$cla, PDO::PARAM_STR);
			return $consulta->execute();

	 }

}
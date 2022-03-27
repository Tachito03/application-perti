<?php
namespace src;

class Respuesta{

	public $respuesta   = false;
	public $mensaje    = 'Ocurrio algo inesperado.';
	
	public function SetResponse($respuesta, $msj = '')
	{
		$this->respuesta = $respuesta;
		$this->mensaje = $msj;

		if(!$respuesta && $msj = '') 
			$this->respuesta = 'Ocurrio algo inesperado';
	}
}
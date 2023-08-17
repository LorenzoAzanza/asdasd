<?php

class controlador_generico{

	// Guardamos la hora que se inicio el proceso
	protected $horaInicio;
	// Guradamos la hora que se finalizo el proceso
	protected $horaFin;



	
	public function procesar(){

		$this->horaInicio = date("Y-m-d H:i:s");     // Guarda la hora actual como inicio

		sleep(5); // Espera 5 segundos 

		$this->horaFin = date("Y-m-d H:i:s"); // Guarda la hora actual como final
		
	}

	//Muestra las horas de inicio y fin
	public function resultados(){

		print_r("\nHora de inicio:".$this->horaInicio);
		print_r("\nHora Fin:".$this->horaFin);

	}


}

?>
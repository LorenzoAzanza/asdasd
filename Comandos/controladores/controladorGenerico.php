<?php

class controladorGenerico{

    protected $horaInicio;

    protected $horaFin;



    public function __construct($arrayDatos=array()){



    }

    public function procesar(){

        $this->horaInicio=date("Y-m-d H:i:s");

        sleep(5);

        $this->horaFin=date("Y-m-d H:i:s");


    }

    public function resultados(){

        print_r(" \n \n Hora de inicio: \n \n".$this->horaInicio);
        print_r(" \n \n Hora de fin: \n \n".$this->horaFin);



    }








}







?>
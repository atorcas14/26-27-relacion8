<?php
class RegistroTexto{
    //Variables
    private string $cadena;
    private DateTime $fechaHora;

    /**
     * Constructor
     *
     * @param string $cadena
     * @param [type] $fechaHora
     */
    public function __construct(string $cadena="", DateTime $fechaHora = new DateTime())
    {
        $this->cadena = $cadena;
        $this->fechaHora = $fechaHora;
    }

    //Metodos para obtener las propiedades
    public function getCadena():string{
        return $this->cadena;
    }

    public function getFechaHora():DateTime{
        return $this->fechaHora;
    }

    
}


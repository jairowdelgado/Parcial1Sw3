<?php
class Materia
{
    public $nombreMateria = null;
    public $semestre = 0;
    public $creditos = 0;
    public $codigo = 0;
    public $estado = 0;

    function __construct(string $nombreMateria, int $semestre, int $creditos, int $codigo, int $estado){
        $this->nombreMateria = $nombreMateria;
        $this->semestre = $semestre;
        $this->creditos = $creditos;
        $this->codigo = $codigo;
        $this->estado = $estado;

    }
    
    public static function createFromArray($arr)
    {
        $materias = new Materia( $arr["nombreMateria"],$arr["semestre"],$arr["creditos"],$arr["codigo"],$arr["estado"] );
    
        return $materias;
        
    }


    /**
     * Get the value of numero
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

   
    public function setEstado($estado)
    {
        $this->estadoM = $estado;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombreMateria()
    {
        return $this->nombreMateria;
    }

   
    
    public function getEstadoMaterias()
    {
        return $this->estado;
    }

    
    public function getSemestre()
    {
        return $this->semestre;
    }

    public function getCreditos()
    {
        return $this->creditos;
    }
    
    
}
?>
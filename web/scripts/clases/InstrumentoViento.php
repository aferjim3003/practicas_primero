<?php

class InstrumentoViento extends InstrumentoBase
{
    // El material queda disponible para las clases derivadas
    protected string $_material = "madera";

    public function __construct(string $material = "madera", int $edad = 15)
    {
        $material = trim($material);
        if ($material === "") {
            throw new InvalidArgumentException("El material no puede estar vacio");
        }

        $this->_material = $material;
        parent::__construct("instrumento de viento", $edad);
    }

    public function sonido(): string
    {
        return "El instrumento de viento produce un sonido";
    }

    final public function afinar(): string
    {
        return "Limpiar el instrumento, ajustar las piezas y comprobar el sonido";
    }

    public function __toString(): string
    {
        return parent::__toString() . ". Instrumento de material " . $this->_material;
    }
}

<?php

final class Flauta extends InstrumentoViento implements IFabricable
{
    // la creacion se realiza mediante el metodo estatico
    private function __construct(string $material = "madera", int $edad = 15)
    {
        parent::__construct($material, $edad);
    }

    public static function CrearDesdeArray(array $datos): self
    {
        $material = "madera";
        $edad = 15;

        if (array_key_exists("material", $datos)) {
            if (!is_string($datos["material"])) {
                throw new InvalidArgumentException("El material debe ser una cadena");
            }
            $material = $datos["material"];
        }

        if (array_key_exists("edad", $datos)) {
            if (!is_int($datos["edad"])) {
                throw new InvalidArgumentException("La edad debe ser un numero entero");
            }
            $edad = $datos["edad"];
        }

        return new self($material, $edad);
    }

    public function sonido(): string
    {
        return "La flauta suena al soplar por la embocadura";
    }

    public function metodoFabricacion(): string
    {
        return "Cortar el material, hacer los agujeros y montar las piezas";
    }

    public function metodoReciclado(): string
    {
        if ($this->_material === "madera") {
            return "Reutilizar la madera o llevarla al punto limpio";
        }

        if ($this->_material === "metal") {
            return "Llevar el metal al contenedor de reciclaje correspondiente";
        }

        return "Separar el material y llevarlo al punto de reciclaje correspondiente";
    }

    public function __clone(): void
    {
        parent::__clone();
        $this->_edad = 0;
    }
}

<?php

class Persona
{
    // los datos de la persona solo se modifican mediante sus metodos
    private string $_nombre;
    private string $_fecha_nacimiento;
    private string $_domicilio;
    private string $_localidad;
    private EstadoCivil $_estado;

    private function __construct()
    {
        $this->_nombre = "prueba";
        $this->_fecha_nacimiento = "01/01/2000";
        $this->_domicilio = "carrera 12";
        $this->_localidad = "antequera";
        $this->_estado = EstadoCivil::soltero;
    }

    public static function registrarPersona(
        string $nombre,
        string $fecha_nacimiento,
        string $domicilio,
        string $localidad,
        EstadoCivil $estado
    ): self {
        $persona = new self();
        $persona->setNombre($nombre);
        $persona->setFechaNacimiento($fecha_nacimiento);
        $persona->setDomicilio($domicilio);
        $persona->setLocalidad($localidad);
        $persona->setEstado($estado);

        return $persona;
    }

    public function getNombre(): string
    {
        return $this->_nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->_nombre = $this->validarTexto($nombre, "nombre");
    }

    public function getFechaNacimiento(): string
    {
        return $this->_fecha_nacimiento;
    }

    public function setFechaNacimiento(string $fecha_nacimiento): void
    {
        $this->_fecha_nacimiento = $this->validarTexto($fecha_nacimiento, "fecha de nacimiento");
    }

    public function getDomicilio(): string
    {
        return $this->_domicilio;
    }

    public function setDomicilio(string $domicilio): void
    {
        $this->_domicilio = $this->validarTexto($domicilio, "domicilio");
    }

    public function getLocalidad(): string
    {
        return $this->_localidad;
    }

    public function setLocalidad(string $localidad): void
    {
        $this->_localidad = $this->validarTexto($localidad, "localidad");
    }

    public function getEstado(): EstadoCivil
    {
        return $this->_estado;
    }

    public function setEstado(EstadoCivil $estado): void
    {
        $this->_estado = $estado;
    }

    public function toString(): string
    {
        return $this->_nombre . " es una persona " . $this->_estado->descripcion()
            . " nacida en " . $this->_fecha_nacimiento
            . " y que vive en " . $this->_localidad;
    }

    public function __get(string $nombre): mixed
    {
        throw new LogicException("La propiedad " . $nombre . " no es accesible");
    }

    public function __set(string $nombre, mixed $valor): void
    {
        throw new LogicException("La propiedad " . $nombre . " no es accesible");
    }

    public function __isset(string $nombre): bool
    {
        throw new LogicException("La propiedad " . $nombre . " no es accesible");
    }

    public function __unset(string $nombre): void
    {
        throw new LogicException("La propiedad " . $nombre . " no es accesible");
    }

    private function validarTexto(string $texto, string $campo): string
    {
        $texto = trim($texto);
        if ($texto === "") {
            throw new InvalidArgumentException("El campo " . $campo . " no puede estar vacio");
        }

        return $texto;
    }
}

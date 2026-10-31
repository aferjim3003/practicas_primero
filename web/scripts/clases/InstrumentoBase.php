<?php

abstract class InstrumentoBase
{
    // Guarda el total creado y el orden de cada instrumento
    protected static int $_total_instancias = 0;
    protected int $_numero_instancia;
    private string $_descripcion;
    protected int $_edad = 10;

    public function __construct(string $descripcion = "instrumento", int $edad = 10)
    {
        $this->setDescripcion($descripcion);
        $this->validarEdad($edad);
        $this->_edad = $edad;
        self::$_total_instancias++;
        $this->_numero_instancia = self::$_total_instancias;
    }

    public function getDescripcion(): string
    {
        return $this->_descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        if (trim($descripcion) === "") {
            throw new InvalidArgumentException("La descripcion no puede estar vacia");
        }

        $this->_descripcion = $descripcion;
    }

    public function getEdad(): int
    {
        return $this->_edad;
    }

    public function envejecer(): void
    {
        $this->_edad++;
    }

    abstract public function sonido(): string;

    abstract public function afinar(): string;

    public function __toString(): string
    {
        return "instrumento con descripción " . $this->_descripcion
            . ", instancia " . $this->_numero_instancia
            . " de un total de " . self::$_total_instancias
            . ". Tiene " . $this->_edad . " años. La clase es " . get_class($this);
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

    public function __clone(): void
    {
        self::$_total_instancias++;
        $this->_numero_instancia = self::$_total_instancias;
    }

    protected function validarEdad(int $edad): void
    {
        if ($edad < 0) {
            throw new InvalidArgumentException("La edad no puede ser negativa");
        }
    }
}

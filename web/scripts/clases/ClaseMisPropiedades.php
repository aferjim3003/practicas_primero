<?php

class ClaseMisPropiedades implements IteratorAggregate
{
    // las propiedades dinamicas se guardan en este array privado
    private array $_propiedades = [];
    public mixed $propPublica = null;
    private mixed $_propPrivada = 25;

    public function __set(string $nombre, mixed $valor): void
    {
        if ($nombre === "_propPrivada" || $nombre === "_propiedades" || $nombre === "") {
            throw new LogicException("No se puede asignar la propiedad " . $nombre);
        }

        $this->_propiedades[$nombre] = $valor;
    }

    public function __get(string $nombre): mixed
    {
        if ($nombre === "_propPrivada" || $nombre === "_propiedades") {
            throw new LogicException("La propiedad " . $nombre . " es privada");
        }

        if (!array_key_exists($nombre, $this->_propiedades)) {
            throw new OutOfBoundsException("La propiedad " . $nombre . " no existe");
        }

        return $this->_propiedades[$nombre];
    }

    public function __isset(string $nombre): bool
    {
        if ($nombre === "_propPrivada" || $nombre === "_propiedades") {
            return false;
        }

        return isset($this->_propiedades[$nombre]);
    }

    public function __unset(string $nombre): void
    {
        if ($nombre === "_propPrivada" || $nombre === "_propiedades") {
            throw new LogicException("No se puede eliminar la propiedad " . $nombre);
        }

        unset($this->_propiedades[$nombre]);
    }

    public function getIterator(): Traversable
    {
        foreach ($this->_propiedades as $nombre => $valor) {
            yield "oi_" . $nombre => $valor;
        }

        yield "oi_propPublica" => $this->propPublica;
        yield "oi__propPrivada" => $this->_propPrivada;
    }
}

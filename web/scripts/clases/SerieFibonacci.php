<?php

class SerieFibonacci implements Iterator
{
    // El limite indica cuantos valores se generan
    private int $_limite;
    private int $_claveActual = 0;

    public function __construct(int $limite)
    {
        if ($limite < 0) {
            throw new InvalidArgumentException("El limite no puede ser negativo");
        }

        $this->_limite = $limite;
    }

    public function current(): int
    {
        return $this->calcularValor($this->_claveActual);
    }

    public function key(): int
    {
        return $this->_claveActual;
    }

    public function next(): void
    {
        $this->_claveActual++;
    }

    public function rewind(): void
    {
        $this->_claveActual = 0;
    }

    public function valid(): bool
    {
        return $this->_claveActual < $this->_limite;
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

    public static function fFibonacci(int $ultimo): Generator
    {
        if ($ultimo < 0) {
            throw new InvalidArgumentException("La cantidad de valores no puede ser negativa");
        }

        $anterior = 0;
        $actual = 1;
        for ($indice = 0; $indice < $ultimo; $indice++) {
            yield $anterior;
            $siguiente = $anterior + $actual;
            $anterior = $actual;
            $actual = $siguiente;
        }
    }

    private function calcularValor(int $clave): int
    {
        $anterior = 0;
        $actual = 1;

        for ($indice = 0; $indice < $clave; $indice++) {
            $siguiente = $anterior + $actual;
            $anterior = $actual;
            $actual = $siguiente;
        }

        return $anterior;
    }
}

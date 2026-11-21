<?php

class Punto
{
    public const COLORES = [
        "black" => ["nombre" => "negro", "rgb" => [0, 0, 0]],
        "red" => ["nombre" => "rojo", "rgb" => [255, 0, 0]],
        "green" => ["nombre" => "verde", "rgb" => [0, 128, 0]],
        "blue" => ["nombre" => "azul", "rgb" => [0, 0, 255]],
    ];

    public const GROSORES = [
        1 => "fino",
        2 => "medio",
        3 => "grueso",
    ];

    private int $_x;
    private int $_y;
    private string $_color;
    private int $_grosor;

    public function __construct(int $x, int $y, string $color, int $grosor)
    {
        if (!$this->setX($x) || !$this->setY($y)
            || !$this->setColor($color) || !$this->setGrosor($grosor)) {
            throw new InvalidArgumentException("Los datos del punto no son validos");
        }
    }

    public function getX(): int
    {
        return $this->_x;
    }

    public function setX(int $x): bool
    {
        if ($x < 0 || $x > 20000) {
            return false;
        }

        $this->_x = $x;
        return true;
    }

    public function getY(): int
    {
        return $this->_y;
    }

    public function setY(int $y): bool
    {
        if ($y < 0 || $y > 20000) {
            return false;
        }

        $this->_y = $y;
        return true;
    }

    public function getColor(): string
    {
        return $this->_color;
    }

    public function setColor(string $color): bool
    {
        if (!isset(self::COLORES[$color])) {
            return false;
        }

        $this->_color = $color;
        return true;
    }

    public function getGrosor(): int
    {
        return $this->_grosor;
    }

    public function setGrosor(int $grosor): bool
    {
        if (!isset(self::GROSORES[$grosor])) {
            return false;
        }

        $this->_grosor = $grosor;
        return true;
    }

    public function __set(string $nombre, mixed $valor): void
    {
        throw new Error("No se puede crear la propiedad " . $nombre);
    }
}

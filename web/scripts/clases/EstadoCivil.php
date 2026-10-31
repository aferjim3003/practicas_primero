<?php

enum EstadoCivil: int
{
    // Cada caso conserva el valor numerico indicado
    case soltero = 10;
    case casado = 20;
    case pareja = 30;
    case viudo = 40;

    public function descripcion(): string
    {
        return $this->name;
    }

    public function valor(): int
    {
        return $this->value;
    }

    public static function casos(): array
    {
        return self::cases();
    }
}

<?php

interface IFabricable
{
    // indica los procesos de fabricacion y reciclado
    public function metodoFabricacion(): string;

    public function metodoReciclado(): string;
}

<?php

declare(strict_types=1);

namespace App\Modelos;

/**
 * Entidad base para los modelos del sistema.
 *
 * Define los atributos y comportamientos comunes
 * que pueden compartir las entidades del dominio.
 */
abstract class AbstractEntity
{
    public function __construct(
        protected string $name,
        protected string $description = ''
    ) {
    }

    // P: ¿Por que usar una interfaz y herencia? R: La herencia comparte estado y
    // comportamiento comun; la interfaz define capacidades sin imponer una clase padre.
    // Una nueva entidad puede extender esta clase sin modificar las existentes.
    abstract public function category(): string;

    public function summary(): string
    {
        return $this->description !== '' ? $this->description : 'Sin descripcion registrada';
    }
}
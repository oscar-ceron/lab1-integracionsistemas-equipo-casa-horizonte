<?php

declare(strict_types=1);

namespace App\Modelos;

/**
 * Modelo que representa una habitación del sistema.
 *
 * Extiende AbstractEntity para reutilizar los atributos
 * y comportamientos comunes de las entidades del dominio.
 */
final class Room extends AbstractEntity
{
    public function __construct(
        string $name,
        private readonly string $type,
        private readonly int $capacity,
        private readonly float $price,
        string $description = ''
    ) {
        parent::__construct($name, $description);
    }

    public function category(): string
    {
        // P: ¿Que metodo se sobrescribe? R: category() era abstracto en AbstractEntity;
        // aqui cambia su comportamiento para devolver el tipo de esta habitacion.
        return $this->type;
    }

    public function nightlyRate(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function capacityLabel(): string
    {
        return $this->capacity . ($this->capacity === 1 ? ' huesped' : ' huespedes');
    }
}

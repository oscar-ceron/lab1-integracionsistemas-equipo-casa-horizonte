<?php

declare(strict_types=1);

namespace App\Repositorios;

use App\Contratos\CrudRepository;
use App\Modelos\Room;
use PDO;

final class RoomRepository implements CrudRepository
{
    public function __construct(private readonly PDO $database)
    {
    }

    public function obtenerTodos(): array
    {
        $statement = $this->database->query(
            'SELECT id, number, type, capacity, price, description
             FROM rooms
             ORDER BY number'
        );

        return $statement->fetchAll();
    }

    public function obtenerPorId(int $id): ?array
    {
        $statement = $this->database->prepare(
            'SELECT id, number, type, capacity, price, description
             FROM rooms
             WHERE id = :id'
        );

        $statement->execute(['id' => $id]);

        $room = $statement->fetch();

        return $room ?: null;
    }

    public function crear(array $datos): bool
    {
        $statement = $this->database->prepare(
            'INSERT INTO rooms
                (number, type, capacity, price, description, created_at, updated_at)
             VALUES
                (:number, :type, :capacity, :price, :description, NOW(), NOW())'
        );

        return $statement->execute($datos);
    }

    public function actualizar(int $id, array $datos): bool
    {
        $datos['id'] = $id;

        $statement = $this->database->prepare(
            'UPDATE rooms
             SET number = :number,
                 type = :type,
                 capacity = :capacity,
                 price = :price,
                 description = :description,
                 updated_at = NOW()
             WHERE id = :id'
        );

        return $statement->execute($datos);
    }

    public function eliminar(int $id): bool
    {
        $statement = $this->database->prepare(
            'DELETE FROM rooms
             WHERE id = :id'
        );

        return $statement->execute(['id' => $id]);
    }

    public function toEntity(array $room): Room
    {
        return new Room(
            $room['number'],
            $room['type'] ?? 'Sin tipo',
            (int) $room['capacity'],
            (float) $room['price'],
            $room['description'] ?? ''
        );
    }
}
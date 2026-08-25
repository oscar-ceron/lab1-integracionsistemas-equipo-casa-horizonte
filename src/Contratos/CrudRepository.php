<?php

declare(strict_types=1);

namespace App\Contratos;

interface CrudRepository
{
    public function obtenerTodos(): array;

    public function obtenerPorId(int $id): ?array;

    public function crear(array $datos): bool;

    public function actualizar(int $id, array $datos): bool;

    public function eliminar(int $id): bool;
} 
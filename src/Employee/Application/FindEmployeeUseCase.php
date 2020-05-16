<?php

declare(strict_types=1);

namespace Src\Employee\Application;


use Src\Employee\Domain\Contracts\EmployeeRepository;
use Src\Employee\Domain\EmployeeEntity;
use Src\Employee\Domain\EmployeeId;

final class FindEmployeeUseCase
{
    private EmployeeRepository $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): ?EmployeeEntity
    {
        $response = $this->repository->search(new EmployeeId($id));
        $this->ensureExist($response);

        return EmployeeEntity::fromArray($response);
    }

    private function ensureExist(?array $datos): void
    {
        if (empty($datos)) {
            // Podría ejecutar excepción EmployeeNotExists o devolver []
        }
    }
}

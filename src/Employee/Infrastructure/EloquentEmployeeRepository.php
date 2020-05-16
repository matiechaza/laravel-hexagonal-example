<?php

declare(strict_types=1);

namespace Src\Employee\Infrastructure;


use App\Employee;
use Src\Employee\Domain\Contracts\EmployeeRepository;
use Src\Employee\Domain\EmployeeEntity;
use Src\Employee\Domain\EmployeeId;

final class EloquentEmployeeRepository implements EmployeeRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Employee();
    }

    public function search(EmployeeId $employeeId): array
    {
        return $this->model->findOrFail($employeeId->value())->toArray();
    }

    public function save(EmployeeEntity $employeeEntity): void
    {
        $this->model->fill($employeeEntity->toArray());
        $this->model->save();
    }
}
